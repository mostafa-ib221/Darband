<?php

namespace App\Http\Controllers;

use App\Models\Extra;
use Illuminate\Http\Request;

class ExtraController extends Controller {
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
        $data['locate'] = 'Extras';
        $data['title'] = 'Extras List';
        $data['extras'] = Extra::paginate($this->inPage);
        return view('content.boss.extras', $data);
    }

    public function store(Request $request, Extra $extra) {
        if($extra->id == null) $extra = new Extra();

        $extra->title = $request->title;
        $extra->description = $request->description;
        $extra->price = $request->price;
        $extra->save();

        return Back();
    }

    public function delete(Extra $extra) {$extra->delete(); return Back();}
}
