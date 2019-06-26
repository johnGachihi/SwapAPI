<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
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
        $myuser = new User();
        // $myuser->first_name = $request->input('firstname');
        // $myuser->last_name = $request->input('lastname');
        // $myuser->email = $request->input('email');
        // $myuser->password = $request->input('password');
        $myuser->first_name = 'ble';
        $myuser->last_name = 'ble';
        $myuser->email = 'ble';
        $myuser->password = 'ble';
        $myuser->save();

        // return $myuser->with('message','Account successfully created');
        return response()->json([
            'error' => false,
            'user' => $myuser
        ]);

    }

    //
}
