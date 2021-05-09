<?php


namespace App\Http\Controllers\API;


use Illuminate\Http\Request;
use App\Http\Controllers\API\BaseController as BaseController;
use App\Models\News;
use Validator;


class ApiNewsController extends BaseController {
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        $news = News::all();
        return $this->sendResponse($news->toArray(), 'Products retrieved successfully.');
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id) {
        $news = News::find($id);
        if (is_null($news)) {return $this->sendError('Product not found.');}
        return $this->sendResponse($news->toArray(), 'Product retrieved successfully.');
    }
}
