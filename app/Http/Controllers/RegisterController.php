<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Log;

class RegisterController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
      
    }

    public function register(Request $request)
    {
        $this->validate($request, [
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required|unique:users,email',
            'phone_number' => 'required',
            'password' => 'required'
        ]);
        $user = new User();
        $user->first_name = $request->input('first_name');
        $user->last_name = $request->input('last_name');
        $user->email = $request->input('email');
        $user->password = $request->input('password');
        Log::error("Phone number". $request->phone_number);
        $user->phone_number = $request->input('phone_number');
        $user->save();

        // return $myuser->with('message','Account successfully created');
        return response()->json([
            'error' => false,
            'user' => $user
        ]);

    }

    //
}
