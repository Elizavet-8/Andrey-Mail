<?php

namespace App\Http\Controllers;

use App\Sequences;
use App\User;
use App\UserInfo;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }

    public function sequences()
    {
        return view('sequences');
    }

    public function getUser(){
        return User::where('id', Auth::id())->with('info')->first();
    }

    public function getStat(){
        $sequences = Sequences::where('user_id', Auth::id())->with('recepients')->get();
        $total = 0;
        $sent = 0;
        $opened = 0;
        $replied = 0;
        foreach ($sequences as $sequence){
            $total += $sequence->total_recepients;
            foreach ($sequence->recepients as $recepient){
                if ($recepient->sent === 1){
                    $sent++;
                }
                if ($recepient->opened === 1){
                    $opened++;
                }
                if ($recepient->replied === 1){
                    $replied++;
                }
            }
        }
        return array('total' => $total, 'sent' => $sent, 'opened' => $opened, 'replied' => $replied);
    }

    public function getRecepients(){
        $sequences = Sequences::where('user_id', Auth::id())->with('recepients')->with('stages')->get();
        $recepients = array();
        foreach ($sequences as $sequence){
            foreach ($sequence->recepients as $recepient) {
                foreach ($sequence->stages as $stage){
                    $recepient->subject = $stage->subject;
                    array_push($recepients, $recepient);
                }
            }
        }

        return $recepients;
    }
}
