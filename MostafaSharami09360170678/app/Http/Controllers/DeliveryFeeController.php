<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use Illuminate\Http\Request;

class DeliveryFeeController extends Controller {

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
        $data['locate'] = 'delivery_fee';
        $data['title'] = 'Delivery Fee';
        $data['df'] = Setting::get('delivery_fee');
        //return $data['df'];
        return view('content.boss.delivery_fee', $data);
    }

    public function store(Request $request) {
        Setting::set('delivery_fee', [
            'price' => $request->price,
            'delivery_fee' => $request->delivery_fee,
        ]);

        return Back();
    }
}
