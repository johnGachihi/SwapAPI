<?php namespace App\Http\Controllers;

use App\Jobs\SendOfferNotificationJob;
use App\Offer;
use Illuminate\Http\Request;

class OffersController extends Controller {

    public function add(Request $request) {
        $this->validate($request, [
            'good_offered_for' => 'required',
            'offered_goods' => 'required'
        ]);

        $offer = new Offer();
        $offer->good_offered_for = $request->input('good_offered_for');
        $offer->save();

        foreach ($request->input('offered_goods') as $offered_good) {
            $offer->offered_goods()->create([
                'good_id' => $offered_good
            ]);
        }
//        SendOfferNotificationJob::dispatch($offer);
        dispatch(new SendOfferNotificationJob($offer));
        return $offer;
    }
}
