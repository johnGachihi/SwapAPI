<?php namespace App\Http\Controllers;

namespace App\Http\Controllers;

use App\Good;
use Illuminate\Http\Request;

class GoodsController extends Controller {

    public function all() {
        return Good::all();
    }

    public function allPaged(Request $request, String $category = null) {
        $category = $request->input('category');
        if($category) {
            return Good::with('user')->where('category', '=', $category)->paginate();
        }
        return Good::with('user')->paginate();
    }

}
