<?php

namespace App\Http\Controllers;

use App\Library\CropPic;
use App\Models\Dish;
use Illuminate\Http\Request;

class FoodController extends Controller {
    private $inPage = 10;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct() {
        //$this->middleware('auth')->only(['form', 'save', 'delete']);
        $this->middleware('auth');
    }

    public function index() {
        $data['locate'] = 'Other';
        $data['title'] = 'Other Signature Dishes';
        $data['dishes'] = Dish::where('is_popular', 0)->paginate($this->inPage);
        $data['url'] = url(STORAGE_PATH . Dish::$PicDir) . '/';
        // return $data['dishes'];
        return view('content.boss.food', $data);
    }

    public function store(Request $request, Dish $food) {
        //return $request->all();
        if($food->id == null) $food = new Dish();

        $food->is_popular = false;
        $food->title = $request->title;
        $food->description = $request->description;
        $food->price = $request->price;
        $food->extend = $request->category;
        if($request->file('pic') != null) {
            $CropPic = new CropPic(Dish::$PicDir);
            $storage = $CropPic->ImgSaveToFile($request);
            if($storage['statusBool']) $food->pic = $storage['image'];
        } else {if(empty($food->pic)) $food->pic = 'ggg';} $food->save();

        return Back();
    }

    public function delete(Dish $food) {$food->delete(); return Back();}
}
