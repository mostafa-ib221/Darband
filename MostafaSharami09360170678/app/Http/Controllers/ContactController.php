<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use App\Models\News;
use Illuminate\Http\Request;

class ContactController extends Controller {
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct() {
        //$this->middleware('auth')->only(['form', 'save', 'delete']);
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index() {
        $data['locate'] = 'Contact';
        $data['title'] = 'Contact';
        $data['contacts'] = Contact::getAllInArray();
        //return $data['contacts'];
        return view('content.boss.contact', $data);
    }

    public function store(Request $request) {
        Contact::set($request->caption, $request->value);
        return Back();
    }
}
