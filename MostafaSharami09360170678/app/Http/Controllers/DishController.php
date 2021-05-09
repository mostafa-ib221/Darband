<?php

namespace App\Http\Controllers;

use App\Library\CropPic;
use App\Models\About;
use App\Models\Dish;
use App\Models\Extra;
use Illuminate\Http\Request;

class DishController extends Controller {
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

    public function popular_index() {
        $data['locate'] = 'Popular';
        $data['title'] = 'Most Popular Dishes: <small>Kale Pache</small>';
        $data['dishes'] = Dish::where('is_popular', 1)->with(['Extras'])->paginate($this->inPage);
        $data['extras'] = Extra::all();
        $data['url'] = url(STORAGE_PATH . Dish::$PicDir) . '/';
        //return $data;
        return view('content.boss.dish', $data);
    }

    public function popular_store(Request $request, Dish $dish) {
        if($dish->id == null) $dish = new Dish();

        $dish->is_popular = true;
        $dish->title = $request->title;
        $dish->description = $request->description;
        $dish->price = $request->price;
        if($request->file('pic') != null) {
            $CropPic = new CropPic(Dish::$PicDir);
            $storage = $CropPic->ImgSaveToFile($request);
            if($storage['statusBool']) $dish->pic = $storage['image'];
        } else {if(empty($dish->pic)) $dish->pic = '';} $dish->save();

        return Back();
    }

    public function popular_extras(Request $request, Dish $kp) {
        $extras = [];
        if(isset($request->extras))
            foreach($request->extras as $id => $val)
                $extras[] = $id;
        //return [$kp, $extras];
        $kp->Extras()->sync($extras);
        return Back();
    }

    public function other_index() {
        $data['locate'] = 'Other';
        $data['title'] = 'Other Signature Dishes';
        $data['dishes'] = Dish::where('is_popular', 0)->paginate($this->inPage);
        $data['url'] = url(STORAGE_PATH . Dish::$PicDir) . '/';
        // return $data['dishes'];
        return view('content.boss.dish', $data);
    }

    public function other_store(Request $request, Dish $dish) {
        //return $request->all();
        if($dish->id == null) $dish = new Dish();

        $dish->is_popular = false;
        $dish->title = $request->title;
        $dish->description = $request->description;
        $dish->price = $request->price;
        if($request->file('pic') != null) {
            $CropPic = new CropPic(Dish::$PicDir);
            $storage = $CropPic->ImgSaveToFile($request);
            if($storage['statusBool']) $dish->pic = $storage['image'];
        } else {if(empty($dish->pic)) $dish->pic = 'ggg';} $dish->save();

        return Back();
    }

    public function delete(Dish $dish) {$dish->delete(); return Back();}
}
