<?php

namespace App\Http\Controllers;
use App\User;
class UserController extends Controller
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

    public function myAccount($id){
        $myaccount = User::all()->where('id','=',$id);
        return $myaccount;
    }
    //

    public function getUserGoods($id){
        $paginated = User::findOrFail($id)->goods()->paginate();
        $paginated->getCollection()->transform(function($good) {
            $good['supplementary_good_images'] = $good->supplementaryGoodImages()->pluck('image_filename');
            $good['user'] = $good->user;
            return $good;
        });
        return $paginated;
        // Good::with('user')
        //         ->where('category', '=', $category)
        //         ->paginate();
        // return User::find($id)->goods;

    }
}
