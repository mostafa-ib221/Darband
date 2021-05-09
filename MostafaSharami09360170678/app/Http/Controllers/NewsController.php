<?php


namespace App\Http\Controllers;


use App\Library\CropPic;
use Illuminate\Http\Request;
use App\Models\News;
use Illuminate\Support\Facades\File;


class NewsController extends Controller {
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
    private $PicDir = 'News';
    private $inPage = 10;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct() {
        $this->middleware('auth')->only(['form', 'save', 'delete', 'LOCK']);
        //$this->middleware('auth:api')->only(['showList', 'showOne']);
    }

    public function LOCK() {
        $data['locate'] = 'lock';
        $data['title'] = 'صفحه قفل';
        return view('content.lock', $data);
    }

    public function form() {
        $data['locate'] = 'News';
        $data['title'] = 'News';
        $data['News'] = News::orderBy('updated_at', 'desc')->get();
        //$data['upload'] = $this->PicPath . $this->PicDir . '/';
        //return $data;
        return view('content.boss.news.form', $data);
    }

    public function save(Request $request, News $news) {
        $isNew = false;
        if($news->id == null) {$news = new News(); $isNew = true;}
        if($isNew) $news->code = md5(time());

        $news->title = $request->title;
        $news->summery = ($request->summery == null) ? '' : $request->summery;
        $news->url = ($request->url == null) ? '' : $request->url;
        if($request->file('pic') != null) {
            $CropPic = new CropPic($this->PicDir);
            $storage = $CropPic->ImgSaveToFile($request);
            if($storage['statusBool']) $news->pic = $storage['image'];
        } else {if(empty($news->pic)) $news->pic = '';}
        $news->save(); return Back();
    }

    public function delete(News $news) {
        //return $news;
        if(!empty($news->pic)) {
            //return $wire->pic;
            $pic = explode('/MostafaSharami09360170678', __DIR__)[0] . STORAGE_PATH . $this->PicDir . '/' . $news->pic;
            //return $pic;
            if(File::exists($pic)) File::delete($pic);
        }
        $news->delete();
        return Back();
    }

    public function showList($page = 0) {
        //$url = $this->UrlBase . STORAGE_PATH . $this->PicDir . '/';
        $url = url(STORAGE_PATH . $this->PicDir) . '/';
        $fields = ['id', 'title', 'summery', 'des', 'pic', 'updated_at'];
        $date = [
            'status' => true,
            'message' => '',
            'data' => [
                'page' => [
                    'current' => 1,
                    'all' => 1
                ],
                //'url' => $this->UrlBase . STORAGE_PATH . $this->PicDir . '/',
                'News' => [],
            ]
        ];
        if($page == 0) {
            $date['message'] = 'صحیح';
            $date['data']['News'] = News::select($fields)->orderBy('updated_at', 'desc')->get()->toArray();
            for($i=0; $i<count($date['data']['News']); $i++) {
                if($date['data']['News'][$i]['pic'] !== '') {$date['data']['News'][$i]['pic'] = $url . $date['data']['News'][$i]['pic'];}
            }
        } else {
            $count = News::count();
            if($this->inPage >= $count) {
                if($page > 1) {
                    $date['status'] = 0;
                    $date['message'] = 'صفحه مورد نظر وجود ندارد';
                } else {
                    $date['message'] = 'صحیح';
                    $date['data']['News'] = News::select($fields)->orderBy('updated_at', 'desc')->skip(($page - 1) * $this->inPage)->take($this->inPage)->get()->toArray();
                    for($i=0; $i<count($date['data']['News']); $i++) {
                        if($date['data']['News'][$i]['pic'] !== '') {$date['data']['News'][$i]['pic'] = $url . $date['data']['News'][$i]['pic'];}
                    }
                }
            } else {
                $date['message'] = 'صحیح';
                $date['data']['page']['current'] = $page;
                $date['data']['page']['all'] = $count / $page;
                $date['data']['News'] = News::select($fields)->orderBy('updated_at', 'desc')->skip(($page - 1) * $this->inPage)->take($this->inPage)->get()->toArray();
                for($i=0; $i<count($date['data']['News']); $i++) {
                    if($date['data']['News'][$i]['pic'] !== '') {$date['data']['News'][$i]['pic'] = $url . $date['data']['News'][$i]['pic'];}
                }
            }
        }
        return json_encode($date);
        return $date;
    }

    public function showOne($id) {
        //$url = $this->UrlBase . STORAGE_PATH . $this->PicDir . '/';
        $url = url(STORAGE_PATH . $this->PicDir) . '/';
        $fields = ['title', 'summery', 'des', 'pic', 'updated_at'];
        $date = [
            'status' => true,
            'message' => '',
            'data' => [
                //'url' => $this->UrlBase . STORAGE_PATH . $this->PicDir . '/',
                'News' => [],
            ]
        ];
        try {
            $news = News::where('id', $id)->select($fields)->get()->toArray();
            if (is_null($news)) {
                $date['status'] = 0;
                $date['message'] = 'خبر مورد نظر وجود ندارد';
            } else {
                $date['message'] = 'صحیح';
                if($news[0]['pic'] !== '') {$news[0]['pic'] = $url . $news[0]['pic'];}
                $date['data']['News'] = $news[0];
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
