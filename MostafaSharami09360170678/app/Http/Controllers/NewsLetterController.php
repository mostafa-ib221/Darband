<?php

namespace App\Http\Controllers;

use App\Http\Requests\NewsLetterRequest;
use App\Models\Catering;
use App\Models\NewsLetter;
use App\Models\Setting;

class NewsLetterController extends Controller {
    private $inPage = 10;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct() {
        $this->middleware('auth')->only(['index', 'destroy']);
        //$this->middleware('auth:api')->only(['showList', 'showOne']);
    }

    public function index() {
        $data['locate'] = 'Newsletter';
        $data['title'] = 'Newsletter';
        $data['newsletters'] = NewsLetter::orderBy('id', 'DESC')->paginate($this->inPage);
        //return $data['newsletters'];
        return view('content.boss.newsletter', $data);
    }

    public function store(NewsLetterRequest $request) {
        //return $request->except(['_token']);
        $email = NewsLetter::create($request->except(['_token']));
        return isset($email->id) ? 'success' : 'error';
    }

    public function destroy(NewsLetter $newsLetter) {
        $newsLetter->delete();
        return Back();
    }
}
