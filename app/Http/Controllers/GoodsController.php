<?php namespace App\Http\Controllers;

namespace App\Http\Controllers;

use App\Good;

class GoodsController extends Controller {

    public function all() {
        return Good::all();
    }

    public function allPaged() {
        return Good::with('user')->paginate();
    }

}
