<?php namespace App\Http\Controllers;

namespace App\Http\Controllers;

use App\Good;
use App\SupplementaryGoodImage;
use Dotenv\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\UploadedFile;
use App\User;

class GoodsController extends Controller {

    const IMAGES_PATH = 'Good-images';

    public function all() {
        return Good::all();
    }

    public function allPaged(Request $request) {
        $category = $request->input('category');
        $paginator = null;

        if($category) {
            $paginator = Good::with('user')
                ->orderBy('id'  , 'desc')
                ->where('category', '=', $category)
                ->paginate();
        } else {
            $paginator = Good::with('user')
                ->orderBy('id', 'desc')
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

    public function add(Request $request)
    {
        $this->validate($request, [
//            'name' => 'required',
            /*'category' => 'required',
            'description' => 'required',
            'location' => 'required',
            'price_estimate' => 'required',
            'main_image' => 'required'*/
        ]);

        $good = new Good();

        $good->name = $request->input('name');
        $good->description = $request->input('description');
        $good->category = $request->input('category');
        $good->price_estimate = $request->input('price_estimate');
//        $good->location = $request->input('location');  TO BE ADDED!!!
        $good->user_id = $request->input('user_id');
        $good->image_file_name = $this->storeImage($request->file('main_image'));
        $good->save();

        if($request->has('sup_images')) {
            foreach ($request->sup_images as $image) {
                $image_name = $this->storeImage($image);
                $good->supplementaryGoodImages()->create([
                    "image_filename" => $image_name
                ]);
            }
        }

        return $good;
    }

    private function storeImage(UploadedFile $uploadedFile): string {
        $imageName = $uploadedFile->hashName();
        $uploadedFile->store(self::IMAGES_PATH);

        return $imageName;
    }

    public function get($id){
        return User::find($id)->goods;
    }

}
