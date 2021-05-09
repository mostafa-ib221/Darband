<?php

namespace App\Http\Controllers;

use App\Models\Dish;
use App\Models\Extra;
use App\Models\OpenTime;
use Illuminate\Http\Request;

class OpenTimeController extends Controller {
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
        $data['locate'] = 'open_time';
        $data['title'] = 'Open Time';

        $data['dishes'] = Dish::where('is_popular', 1)->with(['Extras'])->paginate($this->inPage);
        $data['extras'] = Extra::all();
        $data['url'] = url(STORAGE_PATH . Dish::$PicDir) . '/';

        $data['OpenTimes'] = OpenTime::orderBy('id', 'DESC')->paginate($this->inPage);
        //return $data;
        //return gettype($data['OpenTimes'][0]->mackDaysList(OpenTime::JSON, true));
        //return $data['OpenTimes'][0]->mackDaysList(OpenTime::STRING, true);
        return view('content.boss.open_time', $data);
    }

    public function store(Request $request, OpenTime $ot) {
        if($ot->id == null) $ot = new OpenTime();

        $ot->date_from = $request->date_from;
        $ot->MackDays($request->days);
        $ot->MackTimes($request->time_from, $request->time_to, $request->period);
        $ot->save();

        return Back();
    }
}
