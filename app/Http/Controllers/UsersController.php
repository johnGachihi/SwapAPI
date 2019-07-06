<?php namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

class UsersController extends Controller {

    const CODE_OK = 0;

    public function getUserGoods($userId) {
        $user = User::findOrFail($userId);
        return $user->goods()->get();
    }

    public function putFCMInstanceId(Request $request) {
        $this->validate($request, [
            "user_id" => 'required',
            "fcm_instance_id" => 'required'
        ]);

        $user = User::findOrFail($request->input("user_id"));

        $user->fcm_instance_id = $request->input("fcm_instance_id");
        $user->save();

        return response()->json([
            "message" => "Saved",
            "code" => self::CODE_OK
        ]);
    }

    public function removeFCMInstanceId($id) {
        $user = User::findOrFail($id);
        $user->fcm_instance_id = null;
        $user->save();

        return response()->json([
            "message" => "Saved",
            "code" => self::CODE_OK
        ]);
    }

}
