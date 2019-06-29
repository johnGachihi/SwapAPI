<?php

namespace App\Http\Controllers;

//require_once 'vendor/autoload.php';

use App\User;
use Google_Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class LoginController extends Controller
{

    public function __construct()
    {
        //
    }

    public function login_with_swap(Request $request) {
        $this->validate($request, [
            'email' => 'required',
            'password' => 'required'
        ]);

        $user = User::where('email', $request->input('email'))
            ->where('password', $request->input('password'))
            ->first();

        if($user) {
            return $user;
        } else {
            return response()->json([
                'login' => ['Invalid credentials']
            ], 422);
        }
    }

    public function login_with_google_signin(Request $request) {
        $this->validate($request, [
            'idToken' => 'required'
        ]);

        $idToken = $request->input('idToken');

        $client = new Google_Client();
        $payload = $client->verifyIdToken($idToken);

        if($payload) {
            $user = User::where('email', $payload['email'])->first();
            if(!$user) { /*If user does not exist*/
                $user = $this->createUser($payload);
            }
            return $user;
        } else { /*idToken is invalid*/
            return response("Invalid idToken", 401);
        }
    }

    private function createUser($payload): User{
        $user = new User();
        $user->first_name = $payload['given_name'];
        $user->last_name = $payload['family_name'];
        $user->email = $payload['email'];
        $user->save();

        return $user;
    }
}
