<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller {
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
        $data['locate'] = 'Orders';
        $data['title'] = 'Live Orders List';
        $data['lives'] = Order::Live();
        //return $data['lives'];
        $data['LastId'] = Order::getLastId();
        return view('content.boss.live', $data);
    }

    public function store(Request $request, Order $order) {
        if($order->id == null) $order = new Order();

        $order->title = $request->title;
        $order->description = $request->description;
        $order->price = $request->price;
        $order->save();

        return Back();
    }

    public function delete(Order $order) {$order->delete(); return Back();}

    public function getNewCount($lastId) {
        return Order::countNew($lastId);
    }

    public function Confirm(Order $order) {
        $order->confirm();
        return Back();
    }
    public function Cancel(Order $order) {
        $order->cancel();
        return Back();
    }

    public function History() {
        $data['locate'] = 'Orders';
        $data['title'] = 'Orders History List';
        //$data['lives'] = Order::History();
        $data['histories'] = Order::History();
        $data['LastId'] = Order::getLastId();
        //return $data['lives'];
        return view('content.boss.history', $data);
    }
}
