<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;

class SocialAuthController extends Controller
{
    public function callBack(Request $request){

        try {
            //code...
            $user = Socialite::driver('facebook')->user();
            $email = $user->email;

            $dbUser = User::updateOrCreate([
                'email' => $email
            ],[
                'name'              => $user->name,
                'avatar'            => $user->avatar,
                'avatar_original'   => $user->avatar_original,
                'profileUrl'        => $user->profileUrl,
            ]);
            
            dump($user);
            dd($dbUser);

        } catch (Exception $e) {
            //throw $th;
            //
            dd($e->getMessage());
        }
        
    }

    public function redirectToFB(){
        return Socialite::driver('facebook')->redirect();
    }
}
