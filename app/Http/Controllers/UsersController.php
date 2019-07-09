<?php namespace App\Http\Controllers;

use App\Good;
use App\Offer;
use App\OfferedGood;
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

    /*THERE MUST BE A SIMPLER AND CLEANER WAY TO ACHIEVE ABOVE RESULT*/
    public function getUserOffers($id) {
        $user = User::find($id);
        $offers = $user->goods()
            ->join('offers', 'goods.id', '=', 'offers.good_offered_for')
            ->select('offers.*')
            ->get();

        $offers->transform(function($offer) {
            $offer['good_offered_for'] = Good::find($offer['good_offered_for']);
            $offered_goods = OfferedGood::where('offer_id', $offer->id)->get();
            $offer['offered_goods'] = $offered_goods->map(function ($offeredGood) {
                return $offeredGood->good;
            });
            $good = Good::find($offered_goods->first()['good_id']);
            $offer['bidder'] = null;
            if($good) {
                $offer['bidder'] = Good::find($offered_goods->first()['good_id'])->User;
            }
            return $offer;
        });

        return $offers;
    }
}
