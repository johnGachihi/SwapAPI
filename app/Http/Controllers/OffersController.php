<?php namespace App\Http\Controllers;

use Illuminate\Http\Request;

class OffersController extends Controller {

    public function addOffer(Request $request) {
        $this->validate($request, [
            'good_offered_for' => 'required',
            'offered_goods'
        ]);
    }
}
