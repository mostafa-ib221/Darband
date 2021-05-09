<?php

namespace App\Http\Controllers;

use App\Library\CropPic;
use App\Models\About;
use Illuminate\Http\Request;

class AboutController extends Controller {
    private $PicDir = 'about';

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
        $data['locate'] = 'About';
        $data['title'] = 'About';
        $data['abouts'] = About::getAllInArray();
        // return $data['abouts'];
        return view('content.boss.about', $data);
    }

    public function store(Request $request) {
        //return $request->all();
        if($request->caption == 'img') {
            if($request->file('value') != null) {
                $CropPic = new CropPic($this->PicDir, 'value');
                $storage = $CropPic->ImgSaveToFile($request);
                //return $storage;
                $request->value = $storage['image'];
            }
        }
        About::set($request->caption, $request->value);
        return Back();
    }
}
