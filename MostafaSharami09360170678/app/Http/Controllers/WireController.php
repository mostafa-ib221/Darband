<?php

namespace App\Http\Controllers;

use App\Library\CropPic;
use App\Models\Wire;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class WireController extends Controller {
    /*private $PicPath = [
        'upload' => '/MostafaSharami09360170678/storage/app/',
        'SlideShow' => 'SlideShows',
        'ServicesAndProducts' => 'SvrPrd',
        'News' => 'News',
        'resume' => 'resume',
        'StaticContents' => 'StaticContents',
        'OneStatusFile' => 'LanguageSelector'
    ];*/

    private $UrlBase = 'https://app.aliaj-joosh.com';
    private $PicDir = 'Wire';
    private $inPage = 10;
    private $titles = [
        'آلیاژهای سخت کار',
        'فولادهای مارتنزیتی',
        'فولادهای ابزاری',
        'فولادهای کم آلیاژ',
        'فولادهای ضد سایش',
    ];

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct() {
        $this->middleware('auth')->only(['form', 'save', 'delete']);
    }

    public function form($cat) {
        $data['locate'] = 'Wire';
        $data['cat'] = $cat;
        $data['title'] = $this->titles[$cat - 1];
        //$data['Wires'] = Wire::all();
        $data['Wires'] = Wire::where('cat', $cat)->get();
        //foreach($data['Wires'] as &$wire) $wire->tables = json_encode(unserialize($wire->tables));
        $data['Tables'] = [];
        foreach($data['Wires'] as $wire) $data['Tables'][$wire->id] = unserialize($wire->tables);
        $data['Tables'] = \GuzzleHttp\json_encode($data['Tables']);
        $data['url'] = url(STORAGE_PATH . $this->PicDir) . '/';
        //return $data['Tables'];
        //return $data['Wires'];
        //return $data['Wires'][0]->tables;
        //return unserialize($data['Wires'][0]->tables);
        return view('content.wire.list', $data);
    }

    public function save(Request $request, Wire $wire) {
        $isNew = false;
        if($wire->id == null) {$wire = new Wire(); $isNew = true;}
        if($isNew) $wire->code = md5(time());
        //return ['request'=>$request->all(), 'wire'=>$wire, $isNew];

        $wire->cat = $request->cat;
        $wire->title = $request->title;
        $wire->des = ($request->des == null) ? '' : $request->des;
        $wire->tables = isset($request->tbl) ? serialize($request->tbl) : '';
        if($request->file('pic') != null) {
            $CropPic = new CropPic($this->PicDir);
            $storage = $CropPic->ImgSaveToFile($request, $wire->code);
            if($storage['statusBool']) $wire->pic = $storage['image'];
        } else {$wire->pic = '';}
        if($request->file('pic_top') != null) {
            $CropPic = new CropPic($this->PicDir, 'pic_top');
            $storage = $CropPic->ImgSaveToFile($request, $wire->code . '_top');
            if($storage['statusBool']) $wire->pic_top = $storage['image'];
        } else {$wire->pic_top = '';}
        $wire->is_rtl = isset($request->is_rtl) ? 1 : 0;
        if($isNew) $wire->save(); else $wire->update(); return Back();
    }

    public function delete(Wire $wire) {
        if(!empty($wire->pic)) {
            //return $wire->pic;
            $pic = explode('/MostafaSharami09360170678', __DIR__)[0] . STORAGE_PATH . $this->PicDir . '/' . $wire->pic;
            //return $pic;
            if(File::exists($pic)) File::delete($pic);
        }
        $wire->delete();
        return Back();
    }

    public function showList($cat = 0, $page = 0) {
        //$url = $this->UrlBase . STORAGE_PATH . $this->PicDir . '/';
        //$url = url(STORAGE_PATH . $this->PicDir) . '/';
        $fields = ['id', 'cat', 'title', 'des', 'updated_at'];
        $date = [
            'status' => true,
            'message' => '',
            'data' => [
                'page' => [
                    'current' => 1,
                    'all' => 1
                ],
                //'url' => $this->UrlBase . STORAGE_PATH . $this->PicDir . '/',
                'wire' => [],
            ]
        ];
        if($page == 0) {
            $date['message'] = 'صحیح';
            $date['data']['wire'] = Wire::select($fields);
            if($cat > 0) {$date['data']['wire'] = $date['data']['wire']->where('cat', $cat);}
            $date['data']['wire'] = $date['data']['wire']->get()->toArray();
        } else {
            $count = ($cat > 0) ? Wire::where('cat', $cat)->count() : Wire::count();
            if($this->inPage >= $count) {
                if($page > 1) {
                    $date['status'] = 0;
                    $date['message'] = 'صفحه مورد نظر وجود ندارد';
                } else {
                    $date['message'] = 'صحیح';
                    $date['data']['wire'] = Wire::select($fields)->orderBy('updated_at', 'desc');
                    if($cat > 0) {$date['data']['wire'] = $date['data']['wire']->where('cat', $cat);}
                    $date['data']['wire'] = $date['data']['wire']->skip(($page - 1) * $this->inPage)->take($this->inPage)->get()->toArray();
                }
            } else {
                $date['message'] = 'صحیح';
                $date['data']['page']['current'] = $page;
                $date['data']['page']['all'] = $count / $page;
                $date['data']['wire'] = Wire::select($fields)->orderBy('updated_at', 'desc');
                if($cat > 0) {$date['data']['wire'] = $date['data']['wire']->where('cat', $cat);}
                $date['data']['wire'] = $date['data']['wire']->skip(($page - 1) * $this->inPage)->take($this->inPage)->get()->toArray();
            }
        }
        return json_encode($date);
        return $date;
    }

    public function showOne($id) {
        $date = [
            'status' => true,
            'message' => '',
            'data' => [
                //'url' => $this->UrlBase . STORAGE_PATH . $this->PicDir . '/',
                'News' => [],
            ]
        ];
        try {
            $wire = Wire::find($id);
            if (is_null($wire)) {
                $date['status'] = 0;
                $date['message'] = 'خبر مورد نظر وجود ندارد';
            } else {
                $wire->tables = unserialize($wire->tables);
                if($wire->pic !== '') {
                    $wire->pic = url(STORAGE_PATH . $this->PicDir) . '/' . $wire->pic;
                }
                if($wire->pic_top !== '') {
                    $wire->pic_top = url(STORAGE_PATH . $this->PicDir) . '/' . $wire->pic_top;
                }
                //return $wire;
                return view('content.wire.api_show', ['wire'=>$wire]);
            }
        } catch(\ErrorException $e) {
            $date['status'] = 0;
            $date['data']['News'] = [];
            $date['message'] = 'خبر مورد نظر وجود ندارد';
        }
        return json_encode($date);
        return $date;
    }
    public function showOne2($id) {
        $date = [
            'status' => true,
            'message' => '',
            'data' => [
                //'url' => $this->UrlBase . STORAGE_PATH . $this->PicDir . '/',
                'News' => [],
            ]
        ];
        try {
            $wire = Wire::find($id);
            //return $wire;
            if (is_null($wire)) {
                $date['status'] = 0;
                $date['message'] = 'خبر مورد نظر وجود ندارد';
            } else {
                $wire->tables = unserialize($wire->tables);
                if($wire->pic !== '') {
                    $wire->pic = url(STORAGE_PATH . $this->PicDir) . '/' . $wire->pic;
                }
                if($wire->pic_top !== '') {
                    $wire->pic_top = url(STORAGE_PATH . $this->PicDir) . '/' . $wire->pic_top;
                }
                //return $wire;
                return view('content.wire.api_show', ['wire'=>$wire, 'os'=>'android']);
            }
        } catch(\ErrorException $e) {
            $date['status'] = 0;
            $date['data']['News'] = [];
            $date['message'] = 'خبر مورد نظر وجود ندارد';
        }
        return json_encode($date);
        return $date;
    }
}
