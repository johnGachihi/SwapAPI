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
        $paginator = null;

        if($category) {
            $paginator = Good::with('user')
                ->where('category', '=', $category)
                ->paginate();
        } else {
            $paginator = Good::with('user')
                ->paginate();
        }

        $paginator->getCollection()->transform(function ($good) {
            $good['supplementary_good_images'] = $good->supplementaryGoodImages()->pluck('image_filename');
            return $good;
        });

        return $paginator;
    }

    public function findGoods(Request $request) {
        /*$this->validate($request, [
            'query' => 'required'
        ]);*/

        $searchQuery = $request->input('query');
        $category = $request->input('category');

        Log::info("------------->" . $category);

        if($category) {
            return Good::with(['user', 'supplementaryGoodImages'])
                ->where('category', '=', $category)
                ->where(function ($query) use ($searchQuery) {
                    $query->where('name', 'like', "%$searchQuery%")
                        ->orWhere('description', 'like', "%$searchQuery%");
                })

                ->paginate();
        } else {
            return Good::with(['user', 'supplementaryGoodImages'])
                ->where('name', 'like', "%$searchQuery%")
                ->orWhere('description', 'like', "%$searchQuery%")
                ->paginate();
        }

    }

    public function add(Request $request) {
        // $request->validate([
        //     'category' => 'required',
        //     'name' => 'required',
        //     'description' => 'required',
        //     'location' => 'required',
        //     'price_estimate' => 'required'
        // ]);

        return response()->json(['name' => 'Mizzy']);

        $category = $request->input('category');
        $name = $request->input('name');
        $description = $request->input('description');
        $location = $request->input('location');
        $price_estimate = $request->input('price_estimate');
    }

}
