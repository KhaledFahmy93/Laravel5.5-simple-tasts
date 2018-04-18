<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Socialite;
use App\Usersocial; 
use Illuminate\Contracts\Auth\Authenticatable;

class SocialLoginController extends Controller
{
      /**
     * Redirect the user to the GitHub authentication page.
     *
     * @return \Illuminate\Http\Response
     */
    public function redirectToProvider()
    {
        return Socialite::driver('github')->redirect();
    }

    /**
     * Obtain the user information from GitHub.
     *
     * @return \Illuminate\Http\Response
     */
    public function handleProviderCallback()
    {
        $user = Socialite::driver('github')->user();
       
        $nickname=$user->nickname;
        $email = $user->email;
        $avatar = $user->avatar;

        $userSocail = Usersocial::where('email', $email)->first();
        if($userSocail){
            $userSocail->nickname = $nickname;
            $userSocail->avatar = $avatar; 
        }else{
            Usersocial::create([
                'nickname'=> $nickname,
                'email' => $email,
                'avatar' => $avatar
            ]);
        }
        //Auth::login($userSocail, true);
        //return Redirect::to('home');

        auth()->login($userSocail);
        return redirect()->to('/home');
    }  


}
