<?php

namespace App\Http\Controllers;

use App\Library\CropPic;
use App\Models\Option;
use Illuminate\Http\Request;

class OptionController extends Controller {
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
        $data['locate'] = 'Options';
        $data['title'] = 'Options List';
        $data['options'] = Option::getAll($this->inPage);
        return view('content.boss.options', $data);
    }

    public function store(Request $request, Option $option) {
        if($option->id == null) $option = new Option();

        $option->title = $request->title;
        $option->description = $request->description;
        $option->price = $request->price;
        if($request->file('pic') != null) {
            $CropPic = new CropPic(Option::$PicDir);
            $storage = $CropPic->ImgSaveToFile($request);
            if($storage['statusBool']) $option->pic = $storage['image'];
        } else {if(empty($option->pic)) $option->pic = '';}
        $option->save();

        return Back();
    }

    public function delete(Option $option) {$option->delete(); return Back();}
}
