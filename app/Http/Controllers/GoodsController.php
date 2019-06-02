<?php namespace App\Http\Controllers;

namespace App\Http\Controllers;

use App\Good;
use Dotenv\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class GoodsController extends Controller {

    public function all() {
        return Good::all();
    }

    public function allPaged(Request $request) {
        $category = $request->input('category');
        if($category) {
            return Good::with('user')
                ->where('category', '=', $category)->paginate();
        }
        return Good::with('user')->paginate();
    }

    public function findGoods(Request $request) {
        /*$this->validate($request, [
            'query' => 'required'
        ]);*/

        $searchQuery = $request->input('query');
        $category = $request->input('category');

        Log::info("------------->" . $category);

        if($category) {
            return Good::with('user')
                ->where('category', '=', $category)
                ->where(function ($query) use ($searchQuery) {
                    $query->where('name', 'like', "%$searchQuery%")
                        ->orWhere('description', 'like', "%$searchQuery%");
                })

                ->paginate();
        } else {
            return Good::with('user')
                ->where('name', 'like', "%$searchQuery%")
                ->orWhere('description', 'like', "%$searchQuery%")
                ->paginate();
        }

    }

}
