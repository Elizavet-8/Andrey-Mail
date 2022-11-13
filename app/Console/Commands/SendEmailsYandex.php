<?php

namespace App\Console\Commands;

use App\User;
use App\UserTokens;
use App\Sequences;

use Illuminate\Console\Command;

class SendEmailsYandex extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'email:yandex';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send email on yandex';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $users = User::where('type', 'Yandex')->with('token')->get();
        foreach ($users as $user){
            $sequences = Sequences::where('user_id', $user->id)->where('archive', 0)->with('recepients')->with('stages')->get();
            if (count($sequences) !== 0){
                foreach ($sequences as $sequence){
                    echo "Переход к секвенции $sequence->title\r\n";
                    echo "Список получателей:\r\n";
                    $i = 0;
                    $stageCount = count($sequence->stages);
                    $checkList = [];
                    $sendList = [];
                    foreach ($sequence->recepients as $recepient){
                        $i++;
                        if ($recepient->sent !== 1) {
                            echo $i.'. '.$recepient->name . " - не отправлено\r\n";
                            array_push($sendList, $recepient);
                        } else {
                            if ($recepient->exited !== 1) {
                                echo $i.'. '.$recepient->name . " - отправлено, не завершено\r\n";
                                array_push($checkList, $recepient);
                            } else if ($recepient->exited === 1) {
                                echo $i.'. '.$recepient->name . " - завершено\r\n";
                            }
                        }
                    }
                    if ($stageCount < 2){
                        $endTime = date('d-m-Y h:i:s', strtotime('+1 week'));
                        foreach ($checkList as $recepient){
                            if (strtotime($recepient->updated_at) >= strtotime($endTime)){
                                $recepient->exited = 1;
                                $recepient->active = 0;
                                $recepient->save();
                            }
                        }
                    } else {
                        foreach ($checkList as $recepient){
                            $endTime = date('d M Y H:I:s', strtotime('+' . $sequence->stages[$recepient->stage]->time . ' ' . $sequence->stages[$recepient->stage]->type_time));
                            if (strtotime($recepient->updated_at) <= strtotime($endTime)){
                                array_push($sendList, $recepient);
                            }
                        }
                    }

                    $countSend = count($sendList);
                    echo "Пользователей в секвенции $sequence->title на отправку ". $countSend ." человек\r\n";

                    $i = 0;
                    foreach ($sendList as $recepient){
                        $i++;
                        echo "Отправка письма $i из $countSend\r\n";
                        $email = $user->email;
                        $name = $user->name;
                        $subject = $sequence->stages[0]->subject;
                        $content = $sequence->stages[$recepient->stage]->content;

                        $content = str_replace('{{name}}', $recepient->name, $content);

                        $mail = $this->composeEmail($email, $name, $recepient, $subject, $content);

                        if ($mail === 1){
                            if (count($sequence->stages) > 1 && $recepient->stage !== count($sequence->stages) - 1){
                                $recepient->stage ++;
                            } else if (count($sequence->stages) > 1 && $recepient->stage === count($sequence->stages) - 1 && $recepient->replied === 0){
                                $recepient->active = 0;
                                $recepient->exited = 1;
                            } else if ($recepient->replied === 1) {
                                $recepient->active = 0;
                                $recepient->exited = 1;
                            }

                            $recepient->sent = 1;
                            $recepient->save();
                            echo "Письмо пользователю $recepient->name($recepient->email) успешно отправлено\r\n";
                        } else {
                            echo "При отправке письма пользователю $recepient->name($recepient->email) произошла ошибка\r\n";
                        }
                    }
                }
            } else {
                echo 'Секвенций пользователя '.$user->name.' не найдено'."\r\n";
            }
        }
        echo "Все письма отправлены\r\n";
    }

    public function composeEmail($email, $name, $recepient, $subject, $content)
    {
        $email = explode('@', $email);
        $email = $email[0].'@dsa-nexus.ru';

        $headers = array(
            'Content-type' => 'text/html',
            'From' => $email,
            'X-Mailer' =>  "PHP/" . phpversion()
        );
        $result = mail($recepient->email, $subject, $content, $headers);

        if($result)
        {
            return 1;
        }
        else
        {
            return 0;
        }
    }
}
