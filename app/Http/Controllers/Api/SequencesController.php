<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Sequences;
use App\SequencesRecipients;
use App\SequencesStages;
use App\User;
use App\UserInfo;

class SequencesController extends Controller
{
    public function create(Request $request){
        $sequence = new Sequences();
        $sequence->user_id = Auth::id();
        $sequence->title = $request->title;
        $sequence->total_recepients = 0;
        if ($sequence->save()){
            $info = UserInfo::where('user_id', Auth::id())->first();
            $info->total_sequences ++;
            $info->save();

            return $sequence->id;
        }
    }

    public function save(Request $request){
        $sequence = Sequences::with('recepients')->find($request->id);
        $sequence->title = $request->title;
        $i = 0;
        foreach ($request->recipients as $recipients){
            if ($recipients['name'] !== null && $recipients['email'] !== null) {
                $i++;
                if (isset($recipients->id)) {
                    $rec = SequencesRecipients::find($recipients->id);
                } else {
                    $rec = new SequencesRecipients();
                }

                $rec->sequence_id = $sequence->id;
                $rec->name = $recipients['name'];
                $rec->email = $recipients['email'];
                $rec->save();
            }
        }

        $sequence->total_recepients = $i;

        if (isset($request->stages)) {
            $i = 0;
            $subject = $request->stages[0][0]['subject'];
            foreach ($request->stages as $stage) {
                $model = new SequencesStages();
                $model->sequence_id = $sequence->id;
                $model->stage = $i;

                if ($i !== 0) {
                    $model->type_time = $stage[0]['action'];
                    $model->time = $stage[0]['actionTime'];
                }

                if ($stage[0]['content'] !== null) {
                    $model->content = $stage[0]['content'];
                }

                if ($subject !== null) {
                    $model->subject = $subject;
                }

                $model->save();
                $i++;
            }
        }

        if ($sequence->save()) {
            return 1;
        }
    }

    public function getAll(){
        return Sequences::where('user_id', Auth::id())->with('recepients')->orderBy('id', 'desc')->get();
    }

    public function delete(Request $request){
        $sequence = Sequences::where('id', $request->id)->first();
        $sequence->archive = 1;
        $sequence->save();
    }

    public function checked($recepient_id){
        $image = imagecreatetruecolor(1,1);
        imagefill($image, 0, 0, 0xFFFFFF);
        header('Content-type: image/png');
        imagepng($image);
        imagedestroy($image);

        $recipient = SequencesRecipients::find($recepient_id);
        $recipient->opened = 1;
        $recipient->save();
    }

    public function extension(Request $request)
    {
        $user = User::find($request->userId);

        $email = explode('@', $user->email);
        $email = $email[0].'@dsa-nexus.ru';

        $headers = array(
            'Content-type' => 'text/html',
            'From' => $email,
            'X-Mailer' =>  "PHP/" . phpversion()
        );

        $result = mail($request->to, $request->subject, $request->content, $headers);

        if ($result){
            return "Email sent successfully.";
        } else {
            return "Error. Try again.";
        }
        
    }

    public function extensionLogin(Request $request)
    {
        $from = User::where('email', $request->email)->first();

        if (isset($from->id)){
            return $from->id;
        } else {
            return 0;
        }
    }

    public function extensionGetSequences(Request $request){
        return Sequences::where('user_id', $request->userId)->with('recepients')->orderBy('id', 'desc')->get();
    }

    public function addRecepient(Request $request)
    {
        $recepient = new SequencesRecipients();
        $recepient->sequence_id = $request->sequence;
        $recepient->name = $request->name;
        $recepient->email = $request->email;
        return $recepient->save();
    }

    public function sendMyself(Request $request)
    {
        $user = Auth::user();

        $email = explode('@', $user->email);
        $email = $email[0].'@dsa-nexus.ru';

        $headers = array(
            'Content-type' => 'text/html',
            'From' => $email,
            'X-Mailer' =>  "PHP/" . phpversion()
        );

        $subject = $request->stage[0]['subject'];

        $content = $request->stage[0]['content'];
        $content = str_replace('{{name}}', $user->name, $content);
        
        $result = mail($user->email, $subject, $content, $headers);
        return $result;
    }
}
