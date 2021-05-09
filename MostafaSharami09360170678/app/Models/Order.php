<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model {
    protected $fillable = ['code', 'order', 'date_time', 'address', 'pey_type', 'pey_status', 'order_no', 'status'];

    public static function Live($inPage=10) {
        /*$today = date('Y-m-d');
        $lives = self::where('date_time', '>=', $today)->orderBy('date_time')->paginate($inPage);*/
        $lives = self::where('order', 'LIKE', '%priceAll%')->where('status', 0)->orderBy('date_time')->paginate($inPage);
        foreach($lives as &$live) {
            $live->order = json_decode($live->order);
            $live->address = json_decode($live->address);
        }

        return $lives;
    }
    public static function History($inPage=10) {
        /*$today = date('Y-m-d');
        $lives = self::where('date_time', '>=', $today)->orderBy('date_time')->paginate($inPage);*/
        $lives = self::where('order', 'LIKE', '%priceAll%')->where('status', '>', 0)->orderBy('date_time')->paginate($inPage);
        foreach($lives as &$live) {
            $live->order = json_decode($live->order);
            $live->address = json_decode($live->address);
        }

        return $lives;
    }

    public static function countNew($lastId) {return self::where('id', '>', $lastId)->get()->count();}

    public static function getByOrderNo($order_no) {
        $order = self::where('order_no', $order_no)->first();
        if(!empty($order)) {
            $order->order = json_decode($order->order);
            $order->address = json_decode($order->address);
        }
        return $order;
    }

    public static function getOrderNo($order_no) {
        $order = self::where('order_no', $order_no)->first();
        if(empty($order)) return 'order';
        if(strtolower($order->pey_type) == 'online')
            if(empty($order->pey_status))
                return '/payment/details/';
        return $order->order_no;
    }

    public static function MackNo() {
        $last = self::orderBy('id', 'DESC')->first();
        if(!empty($last) && ($last->order_no > 9998)) {
            $to = 9999 - $last->order_no;
            if($to > 200) $to = $to / 2;
            return 1010 + random_int(1, $to);
        }
        return 1010 + random_int(1, 990);
    }

    public static function getLastId() {
        $last = self::orderBy('id', 'DESC')->first();
        if(empty($last)) return 0;
        return $last->id;
    }

    public static function isValidOrder(Order $order) {
        if(empty($order)) return 'false-1';
        if(!isset($order->order)) return 'false-2';
        if(!isset($order->order->priceAll)) return 'false-3';
        //if(is_numeric($order->order->priceAll)) return 'false-4';
        if($order->order->priceAll <= 0) return 'false-5';
        return true;
    }
    public function amIValid() {
        if(empty($this)) return 'false-1';
        if(!isset($this->order)) return 'false-2';
        if(!isset($this->order->priceAll)) return 'false-3';
        //if(is_double($this->order->priceAll)) return 'false-4';
        if($this->order->priceAll <= 0) return 'false-5';
        return true;
    }

    public static function UpdatePeyStatus($order, $chargeId) {
        $updateOptions = ['pey_status' => $chargeId];
        if(gettype($order->order) == 'object') $updateOptions['order'] = json_encode($order->order);
        if(gettype($order->address) == 'object') $updateOptions['address'] = json_encode($order->address);

        return $order->update($updateOptions);
    }

    public function confirm() {
        $this->status = 1;
        return $this->update();
    }
    public function cancel() {
        $this->status = 2;
        return $this->update();
    }
}
