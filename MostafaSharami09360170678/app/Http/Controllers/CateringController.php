<?php

namespace App\Http\Controllers;

use App\Models\Catering;
use App\Models\Setting;
use Illuminate\Http\Request;

class CateringController extends Controller {
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
        $data['locate'] = 'Catering';
        $data['title'] = 'Catering';
        $set = Setting::get('catering-hidden', false);
        $set = (($set == null) || ($set == 'show')) ? true : false;
        $data['show'] = $set;
        $catering = Catering::orderBy('id', 'DESC');
        if(!$set) $catering = $catering->where('read', false);
        $data['caterings'] = $catering->paginate($this->inPage);
        //return $data['caterings'];
        return view('content.boss.catering', $data);
    }

    public function read(Catering $catering) {
        $catering->update(['read' => true]);
        return Back();

    }

    public function delete(Catering $catering) {
        $catering->delete();
        return Back();
    }

    public function readingShow() {Setting::set('catering-hidden', 'show', false); return Back();}
    public function readingHide() {Setting::set('catering-hidden', 'hide', false); return Back();}
}
