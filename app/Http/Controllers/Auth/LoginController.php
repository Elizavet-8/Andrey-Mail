<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\UserInfo;
use App\UserTokens;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Laravel\Socialite\Facades\Socialite;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/';
    protected $redirectAfterLogout = '/login';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function yandex(){
        return view('auth/yandex');
    }

    public function yandexLogin(Request $request){
        $user = User::where('email', $request->email)->where('admin', 0)->first();
        if (isset($user->email)){
            if ($user->name !== $request->username){
                $user->name = $request->username;
                $user->update();
            }

            $info = UserInfo::where('user_id', $user->id)->first();
            if (!empty($info)){
                if ($info->img !== $request->img){
                    $info->img = $request->img;
                    $info->update();
                }
            } else {
                $info = new UserInfo();
                $info->user_id = $user->id;
                $info->img = $request->img;
                $info->total_sequences = 0;
                $info->save();
            }

            $token = $request->token;
            $userToken = UserTokens::where('user_id', $user->id)->first();
            if (isset($userToken->token)){
                $userToken->token = $token;
                $userToken->save();
            } else {
                $tokenModel = new UserTokens();
                $tokenModel->user_id = $user->id;
                $tokenModel->token = $token;
                $tokenModel->save();
            }

            Auth::login($user, true);

            if (!Auth::guest()){
                return 1;
            } else {
                return 2;
            }
        } else {
            return 0;
        }
    }

    public function redirectToProvider()
    {
        return Socialite::driver('google')->redirect();
    }

    public function handleProviderCallback()
    {
        $auth = Socialite::driver('google')->user();
        $user = User::where('email', $auth->getEmail())->first();
        if (isset($user->email)){
            if ($user->name !== $auth->name){
                $user->name = $auth->name;
                $user->update();
            }

            $info = UserInfo::where('user_id', $user->id)->first();
            if (!empty($info)){
                if ($info->img !== $auth->getAvatar()){
                    $info->img = $auth->getAvatar();
                    $info->update();
                }
            } else {
                $info = new UserInfo();
                $info->user_id = $user->id;
                $info->img = $auth->getAvatar();
                $info->total_sequences = 0;
                $info->save();
            }

            $token = $auth->token;
            $userToken = UserTokens::where('user_id', $user->id)->first();
            if (isset($userToken->token)){
                $userToken->token = $token;
                $userToken->save();
            } else {
                $tokenModel = new UserTokens();
                $tokenModel->user_id = $user->id;
                $tokenModel->token = $token;
                $tokenModel->save();
            }

            Auth::login($user, true);
            if (!Auth::guest()) {
                return redirect('/');
            }
        } else {
            if (Auth::guest()) {
                return redirect('/login');
            }
        }
    }
}
