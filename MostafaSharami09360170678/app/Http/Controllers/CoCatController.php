<?php

namespace App\Http\Controllers;

use App\Models\CoCat;
use App\Models\Msgcat;
use Illuminate\Http\Request;

class CoCatController extends Controller {
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct() {
        $this->middleware('auth')->only(['form', 'save', 'delete']);
    }

    public function form() {
        $data['locate'] = 'CoCat';
        $data['title'] = 'دسته‌بندی شرکت';
        //$data['cats'] = CoCat::all();
        $data['cats'] = CoCat::with('Co')->get();
        //$data['upload'] = $this->PicPath . $this->PicDir . '/';
        //return $data;
        return view('content.customer.co_cat_form', $data);
    }

    public function save(Request $request, CoCat $CoCat) {
        //return $request;
        if($CoCat->id == null) {$CoCat = new CoCat();}

        $CoCat->title = $request->title;
        $CoCat->des = ($request->des == null) ? '' : $request->des;
        $CoCat->save();
        if(isset($CoCat->id)) {
            Msgcat::create([
                'user' => '10000-' . $CoCat->id,
                'title' => 'دسته ' . $CoCat->title,
                'unread_admin' => 0,
                'unread_customer' => 0,
            ]);
        }
        return Back();
    }

    public function delete($CoCat) {
        $CoCat = CoCat::where('id', $CoCat)->with('Co')->first();
        //return count($CoCat->Co);
        //return empty($CoCat) ? 'empty' : 'full';;
        //return $CoCat->Co == [] ? 'empty' : 'full';
        if(!empty($CoCat))
            if(count($CoCat->Co) == 0)
                $CoCat->delete();
        return Back();
    }
}
