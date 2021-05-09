<?php

namespace App\Http\Controllers;

use App\Models\CoCat;
use App\Models\Company;
use App\Models\Customer;
use App\Models\Message;
use App\Models\User;
use App\Models\Msgcat;
use Illuminate\Http\Request;

class MessageController extends Controller {
    private $fileType = [
        'img' => [['fas fa-file-image',], ['jpg', 'jpeg', 'bmp', 'gif', 'tiff', 'exif', 'png', 'ppm', 'pgm', 'pmb', 'pnm', 'webp']],
        //'audio' => [['fas fa-file-audio',], ['m4a', 'm4b', 'mp3', 'ra', 'rm', 'raw', 'voc', 'vox', 'wav', 'wma', 'wv', 'webm']],
        'audio' => [['fas fa-file-audio',], ['mp3', 'ogg', 'wav', 'm4a']],
        'video' => [['fas fa-file-video',], ['webm', 'flv', 'vob', 'ogv', 'ts', 'wmv', 'rm', 'rmvb', 'amv', 'mpg', 'mpeg', 'mpv', '3gp', 'mp4']],
        'document' => [['fas fa-file',], ['doc', 'docx', 'djvu', 'xml', 'htm', 'html', 'odt', 'pdf']],
        'compress' => [['fas fa-file-archive',], ['zip', 'rar', 'winrar', '7z', 'htm', 'html', 'odt', 'pdf']],
        'file' => [['fas fa-file',], []],
    ];

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct() {
        $this->middleware('auth')->only(['UserList', 'UserCatList_form', 'UserCatList_save', 'UserChatList_form', 'UserChatList_save', 'save']);
        $this->middleware('auth:api')->only(['UserCatList_api', 'UserChatList_form_api', 'UserChatList_save_api']);
    }

    public function UserList() {
        $data['locate'] = 'Message';
        $data['title'] = 'لیست مشتریان به تفکیک شرکت';
        //$data['cats'] = CoCat::all();
        //$data['companies'] = Company::with('Cat')->get();
        //$data['customers'] = Customer::with(['User', 'Co'])->get();
        $data['companies'] = Company::with(['Customer', 'Customer.User'])->get()->toArray();
        //return $data['company'];

        foreach($data['companies'] as &$co) $co['customer'] = array_merge([[
            'id' => '20000-' . $co['id'],
            'name' => 'شرکت ' . $co['title'],
            'chat' => true
        ]], $co['customer']);

        $cats = CoCat::all();
        $customers = [];
        foreach($cats as $cat) $customers[] = [
            'id' => '10000-' . $cat->id,
            'name' => 'دسته ' . $cat->title,
            'chat' => true
        ];
        $catChats = [
            'id' => 0,
            'title' => 'دسته‌ها',
            'customer' => $customers
        ];
        $data['companies'] = array_merge([$catChats], $data['companies']);
        //return $data['companies'];

        return view('content.message.user_list', $data);
    }
    public function UserList2() {
        $data['locate'] = 'Message';
        $data['title'] = 'لیست مشتریان به تفکیک شرکت';
        //$data['cats'] = CoCat::all();
        //$data['companies'] = Company::with('Cat')->get();
        //$data['customers'] = Customer::with(['User', 'Co'])->get();
        $data['companies'] = Company::with(['Customer', 'Customer.User'])->get()->toArray();


        $cats = CoCat::all();
        $customers = [];
        foreach($cats as $cat) $customers[]['user'] = [
            'id' => '10000' . $cat->id,
            'name' => 'دسته ' . $cat->title,
            'chat' => true
        ];
        $catChats = [
            'id' => 0,
            'title' => 'دسته‌ها',
            'customer' => $customers
        ];
        $data['companies'] = array_merge([$catChats], $data['companies']);
        return $data;

        return view('content.message.user_list', $data);
    }
    public function form_show_13990404_1639() {
        $data['locate'] = 'Message';
        $data['title'] = 'پیام';
        //$data['cats'] = CoCat::all();
        //$data['companies'] = Company::with('Cat')->get();
        //$data['customers'] = Customer::with(['User', 'Co'])->get();
        //return $data['customers'];

        // ====================================================================================
        $data['isPM'] = false;
        $data['DelMsgIsShow'] = true;
        $data['ChatGrpPicPath'] = [];
        // ---------------------------------
        $data['to'] = [];//Messages::getToList();
        $data['msgs'] = [];//Messages::getMyMsg();
        $data['me'] = 0;//Auth::user()->person_id;

        $data['projects'] = [];//Projects::MadeByMe();
        //$data['groups'] = ChatGroups::getGroupList();
        $data['groups'] = [
            'GroupsIAmMemberOf' => [],
            'MadeByMe' => [],
        ];
        $data['ChatGrpPicPath'] = '';//$this->mackFilePath('chat_group') . '/';
        $data['iAmChattingIn'] = ['groups'=>[], 'users'=>[]];
        /*foreach($data['groups']['MadeByMe'] as $MadeByMe) {
            $data['iAmChattingIn']['groups'][] = $MadeByMe->id;
        }
        foreach($data['groups']['GroupsIAmMemberOf'] as $GroupsIAmMemberOf) {
            $data['iAmChattingIn']['groups'][] = $GroupsIAmMemberOf->id;
        }*/
        /*if($data['isPM']) {
            foreach ($data['users'] as $user) {
                $data['iAmChattingIn']['users'][] = $user['id'];
            }
        } else  {
            foreach ($data['users'] as $user) {
                if($user['haveMsg']) $data['iAmChattingIn']['users'][] = $user['id'];
            }
        }*/

        $data['DelMsgIsShow'] = 'false';//$this->getSettingChatDelMsgStatus($request) === 'true';
        // ====================================================================================
        $data['users'] = [];//User::getUsers(true, $data['me']);
        $customer = Customer::with('user')->get();
        foreach($customer as $c) {
            $data['users'][] = [
                'name' => $c->User->name,
                'id' => $c->User->id,
                'pic' => '',
                'unread' => 0
            ];
        }
        //return $data['users'][0];

        return view('content.message.show', $data);
    }

    public function UserCatList_form(User $user) {
        //return $user;
        $data['locate'] = 'Message';
        $data['title'] = 'لیست گروه‌های پیام مشتری: ' . $user->name;
        $data['user'] = $user->id;
        $data['cats'] = Msgcat::where('user', $user->id)->get();
        //return $data['cats'];

        return view('content.message.user_cat_list', $data);
    }
    public function UserCatList_api() {
        $user = User::where('id', auth()->user()->id)->with(['Customer', 'Customer.Co'])->first();
        //return $user;

        return [
            'status' => true,
            'message' => '',
            'data' => [
                'cats' => Msgcat::select(['id', 'title', 'unread_customer'])
                    ->whereIn('user', [$user->id, '20000-' . $user->Customer->Co->id, '10000-' . $user->Customer->Co->Cat->id])
                    ->get()->toArray(),
                'user' => $user
            ],
        ];
    }
    public function UserCatList_save(Request $request, $user) {
        //return $request;
        //return [$user, $request->title];
        /*$mc = new Msgcat();
        $mc->user = $user;
        $mc->title = $request->title;
        $mc->unread_admin = 0;
        $mc->unread_customer = 0;
        $mc->save();
        return $mc;*/
        Msgcat::create([
            'user' => $user,
            'title' => $request->title
        ]); return Back();
    }

    public function UserChatList_form(User $user, Msgcat $cat) {
        $data['locate'] = 'Message';
        $data['title'] = 'گروه پیام «' . $cat->title . '» مشتری «' . $user->name . '»';
        $data['user'] = $user->id;
        $data['cat'] = $cat->id;
        $data['messages'] = Message::where('cat', $cat->id)->get();
        $filePath = url('/MostafaSharami09360170678/storage/app/Messages/' . $user->id . '/' . $cat->id) . '/';
        foreach($data['messages'] as $message) {
            if (!empty($message->file)) {
                $type = explode('.', $message->file)[1];
                $message->type = 'file';
                foreach ($this->fileType as $key => $value) {
                    if (in_array($type, $value[1])) {
                        $message->type = $key;
                        break;
                    }
                }
                $message->fileName = $message->file;
                $message->file = $filePath . $message->file;
                $message->text = '';
            } else {
                $message->file = '';
                $message->fileName = '';

            }
        }
        //return $data['messages'];

        return view('content.message.user_chat_list', $data);
    }
    public function UserChatList_formByUser($pre, $id) {
        $data['locate'] = 'Message';

        if($pre == 20000) {
            $data['title'] = 'شرکت ' . Company::find($id)->title;
        } else {
            $data['title'] = 'دسته ' . CoCat::find($id)->title;
        }
        $data['user'] = $pre . '-' . $id;

        $cat = Msgcat::where('user', $data['user'])->first();
        //return $cat->id;
        //return [$pre, $id, $cat];
        $data['messages'] = Message::where('cat', $cat->id)->get();
        //return $data['messages'];
        $filePath = url('/MostafaSharami09360170678/storage/app/Messages/' . $data['user'] . '/' . $cat->id) . '/';
        foreach($data['messages'] as $message) {
            if (!empty($message->file)) {
                $type = explode('.', $message->file)[1];
                $message->type = 'file';
                foreach ($this->fileType as $key => $value) {
                    if (in_array($type, $value[1])) {
                        $message->type = $key;
                        break;
                    }
                }
                $message->fileName = $message->file;
                $message->file = $filePath . $message->file;
                $message->text = '';
            } else {
                $message->file = '';
                $message->fileName = '';

            }
        }

        //$data['messages'] = [];

        return view('content.message.user_chat_list', $data);
    }
    public function UserChatList_deleteByUser($pre, $id) {
        $cat = Msgcat::where('user', $pre . '-' . $id)->first();
        $cat->delete();
        return redirect(url('message'));
        return $cat;
    }
    public function UserChatList_delete($user, Msgcat $cat) {
        $cat->delete();
        return redirect(url('message'));
        return $cat;
    }
    public function UserChatList_form_api(Request $request, $cat) {
        $cat = Msgcat::find($cat);
        //return ['$cat' => $cat, 'con'=> ($cat === null)];
        if($cat !== null) {
            $user = auth()->user();
            $valid = $cat->user == $user->id;
            if(!$valid) {
                $customer = Customer::where('user', $user->id)->first();
                $id = explode('-', $cat->user)[1];
                $valid = $customer->co == $id;
                if(!$valid) {
                    $co = Company::find($customer->co);
                    $valid = $co->cat == $id;
                    //return [$id, $cat, $user, $customer, $co];
                }
            }
            if($valid) {
                $cat->unread_customer = 0;
                $cat->save();
                $messages = Message::select(['text', 'file', 'is_customer'])->where('cat', $cat->id)->get()->toArray();
                $filePath = url('/MostafaSharami09360170678/storage/app/Messages/' . $user->id . '/' . $cat->id) . '/';
                for ($i = 0; $i < count($messages); $i++) {
                    if (!empty($messages[$i]['file'])) {
                        $type = explode('.', $messages[$i]['file'])[1];
                        $messages[$i]['type'] = 'file';
                        foreach ($this->fileType as $key => $value) {
                            if (in_array($type, $value[1])) {
                                $messages[$i]['type'] = $key;
                                break;
                            }
                        }
                        $messages[$i]['fileName'] = $messages[$i]['file'];
                        $messages[$i]['file'] = $filePath . $messages[$i]['file'];
                        $messages[$i]['text'] = '';
                    } else {
                        $messages[$i]['file'] = '';
                        $messages[$i]['fileName'] = '';
                        $messages[$i]['type'] = 'text';
                    }
                }
                return ['status' => true, 'message' => '', 'data' => ['messages' => $messages]];
            }
        }

        return ['status'=>false, 'message'=>'گروه پیام مورد نظر برای شما پیدا نشد', 'data'=>isset($request->os) ? ['error'=>'not found'] : []];
    }
    public function UserChatList_save(Request $request, $user, Msgcat $cat) {
        $msg = new Message();
        $msg->cat = $cat->id;
        $file = $request->file('attach');
        if(empty($file)) {
            if(empty($request->msg)) return Back();
            $msg->text = $request->msg;
        } else {
            $type = explode('.', $file->getClientOriginalName());
            $type = strtolower($type[count($type) - 1]);
            $msg->file = md5(time()) . '.' . $type;
            $file->storeAs('Messages/'.$user.'/'.$cat->id, $msg->file);
        }
        $msg->is_customer = false;
        $isSave = $msg->save();
        if(isset($msg->id)) {
            $cat->unread_customer = $cat->unread_customer + 1;
            $isChange = $cat->save();
            if(!$isChange) {$msg->delete(); $isSave=false;}
        }
        if($isSave) $this->sendNotifToAUserByUsrId($user);

        return Back();
    }
    public function  UserChatList_saveByUser(Request $request, $pre, $id) {
        $user = $pre.'-'.$id;
        $cat = Msgcat::where('user', $user)->first();
        $msg = new Message();
        $msg->cat = $cat->id;
        $file = $request->file('attach');
        if(empty($file)) {
            if(empty($request->msg)) return Back();
            $msg->text = $request->msg;
        } else {
            $type = explode('.', $file->getClientOriginalName());
            $type = strtolower($type[count($type) - 1]);
            $msg->file = md5(time()) . '.' . $type;
            $file->storeAs('Messages/'.$user.'/'.$cat->id, $msg->file);
        }
        $msg->is_customer = false;
        $isSave = $msg->save();
        if(isset($msg->id)) {
            $cat->unread_customer = $cat->unread_customer + 1;
            $isChange = $cat->save();
            if(!$isChange) {$msg->delete(); $isSave=false;}
        }
        if($isSave) $this->sendNotifToGroup($pre, $id);

        return Back();
    }
    public function UserChatList_save_api(Request $request, Msgcat $cat) {
        $user = auth()->user();
        $msg = new Message();
        //return $msg;
        $msg->cat = $cat->id;
        $file = $request->file('attach');
        $fu = ''; $fileName = '';
        if(empty($file)) {
            if(empty($request->msg)) return Back();
            $msg->text = $request->msg;
            $msg->file = '';
        } else {
            $msg->text = '';
            $type = explode('.', $file->getClientOriginalName());
            $type = strtolower($type[count($type) - 1]);
            $msg->file = md5(time()) . '.' . $type;
            $storePath = 'Messages/' . $user->id .'/'. $cat->id;
            $fu = $file->storeAs($storePath, $msg->file);
            $fileName = $msg->file;
            if(gettype($fu) !== 'string') return ['status' => false, 'message' => 'فایل شما ذخیره نشد', 'data' => ['type'=>gettype($fu), 'ret'=>$fu, 'path'=>$storePath]];
        }
        $msg->is_customer = true;
        $msg->save();
        if(isset($msg->id)) {
            $cat->unread_admin = $cat->unread_admin + 1;
            $isChange = $cat->save();
            //return var_dump($isChange);
            if(!$isChange) $msg->delete();
        }
        return ['status' => true, 'message' => 'پیام شما ذخیره شد', 'data' => $fileName];
    }
    public function FirebaseToken_api(Request $request) {
        $user = auth()->user();
        $customer = Customer::where('user', $user->id)->first();
        $customer->firebase = $request->firebaseToken;
        if($customer->save()) {
            return ['status' => true, 'message' => 'توکن فایربیس ذخیره شد', 'data' => isset($request->os) ? '' : []];
        }
        return ['status' => false, 'message' => 'ذخیره توکن فایربیس با خطا مواجه شد', 'data' => isset($request->os) ? '' : []];
    }

    public function save(Request $request, Customer $customer) {
        //return $request;
        $user = [];
        if($customer->id == null) {
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => bcrypt($request->password),
                'is_admin' => false,

            ]);
            //return $user;
            $customer = new Customer();
        } else {
            //
        }

        $customer->co = $request->co;
        $customer->user = $user->id;
        $customer->mobile = $request->mobile;
        $customer->save();
        return Back();
    }

    public function notif(Request $request) {
        /*$cat = CoCat::where('id', 6)->with(['Co.Customer'])->get();
        return $cat;*/
        // -----------------------------------
        $moblie = isset($request->mobile) ? $request->mobile : '09001231234';
        //$customer = Customer::where('mobile', '09101231234')->first();
        $customer = Customer::where('mobile', $moblie)->first();
        $to = $customer->firebase;
        $data = ['body' => 'test new msg: ' . $customer->mobile . ' | ' . date('Y/m/d h:i:s')];
        if(isset($request->group)) {
            $customer = [];
            $customer[] = Customer::where('mobile', '09001231234')->first();
            $customer[] = Customer::where('mobile', '09101231234')->first();
            $to = [$customer[0]->firebase, $customer[1]->firebase];
        }
        //return [$to, $data];
        $res = $this->sendPushNotification($to, $data);
        return [
            '$customer' => $customer,
            'data' => $data,
            'res' => $res,
            'success_type' => gettype($res['success'])
        ];
    }
    private function sendNotifToAUserByUsrId($usrId) {
        $customer = Customer::where('user', $usrId)->first();
        return $this->sendNotifToAUser($customer->firebase);
    }
    private function sendNotifToGroup($pre, $id) {
        if($pre == '10000') { // Co Cat
            $cat = CoCat::where('id', $id)->with(['Co.Customer'])->get();
            foreach ($cat->Co as $co) {
                foreach ($co->Customer as $customer) {
                    if(!$this->sendNotifToAUser($customer->firebase)) {
                        return false;
                    }
                }
            }
        } else { // Co
            $customers = Customer::where('co', $id)->get();
            foreach($customers as $customer) {
                if(!$this->sendNotifToAUser($customer->firebase)) {
                    return false;
                }
            }
        }
    }
    private function sendNotifToAUser($FirebaseToken) {
        $res = $this->sendPushNotification($FirebaseToken, ['body' => 'شما یک پیام جدید دارید']);
        return ($res['success'] == 1);
    }
    private function sendPushNotification($to = '', $data = array()) {
        //$apiKey = 'AIzaSyCyucwX5d5MbddvT0lpjjYoZcNqFs0R5gs';
        $apiKey = 'AAAA7-eMIZ0:APA91bFWa7Z-fuGliST6sq5akWrbJU_lj0dCzScK2_Mi2I7nKerZh_rAWNQXiOcgfXtSDeDuF63j_nBXt2mdO_p6JpcyDRDj2qOawJ_PQDVyNnCpuswmTMfi9mz9OkzimyVQ4L0-AwlV';
        $fields = array('to'=>$to, 'notification'=>$data);
        /*$fields = array(
            'registration_ids' => $to , //must to be array !
            'dry_run'       => false,
            'notification'  => $data,
            'data' => array("page" => "notif"),
        );*/
        //$headers = array('Authorization: key=' . $apiKey, 'Content-type: application/json');
        $headers = array(
            'Content-Type: application/json',
            'Authorization: key=' . $apiKey,
        );
        //$url = 'http://fcm.googleapis.com/fcm/send';
        $url = 'https://fcm.googleapis.com/fcm/send';

        /*$ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fields));
        $resualt = curl_exec($ch);
        curl_close($ch);
        return json_decode($resualt, true);*/

        /*return [
            'apiKey' => $apiKey,
            'fields' => $fields,
            'headers' => $headers,
            'url' => $url,
        ];*/

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL,$url);
        curl_setopt($ch, CURLOPT_POST,true);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fields));
        //var_dump($ch); exit();

        $result = curl_exec($ch);
        //var_dump($result); exit();
        curl_close($ch);
        /*$resultJson = json_decode($result);
        return $resultJson;*/
        return json_decode($result, true);
    }

}
