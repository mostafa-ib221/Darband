<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Dish extends Model {
    public static $PicDir = 'dish';
    protected $fillable = ['is_popular', 'title', 'description', 'pic', 'price', 'sell', 'extend'];

    public function Extras() {
        return $this->belongsToMany(Extra::class);
    }

    public static function Both($otherOption=[]) {
        return [
            'populars' => self::Popular(),
            'others' => self::Other($otherOption)
        ];
    }

    public static function Popular($count=0, $order='') {
        $dishes = self::where('is_popular', true);
        if($order !== '') $dishes = $dishes->orderBy($order, 'DESC');
        if($count > 0) $dishes = $dishes->take($count);
        $dishes = $dishes->with('Extras')->get();
        foreach ($dishes as &$dish) $dish->pic = url(STORAGE_PATH . self::$PicDir) . '/' . $dish->pic;
        return $dishes;
    }
    public static function Other($option=[]) {
        $dishes = self::where('is_popular', false);
        if(!empty($option)) {
            if(isset($option['extend'])) {
                $relation = isset($option['relation']) ? $option['relation'] : '=';
                $dishes = $dishes->where('extend', $relation, $option['extend']);
            }
        }
        $dishes = $dishes->get();
        foreach ($dishes as &$dish) $dish->pic = url(STORAGE_PATH . self::$PicDir) . '/' . $dish->pic;
        return $dishes;
    }

    public function mackExtraIdJsonList($return=false) {
        $list = [];
        if(isset($this->Extras))
            foreach($this->Extras as $extra)
                $list[] = $extra->id;
        $this->list = json_encode($list);
        if($return) return $this->list;
    }

    public static function getOtherByCat($option=['relation'=>'!=', 'extend'=>'Explore']) {
        $others = [];
        $dishes = self::where('is_popular', false);
        if(!empty($option)) {
            if(isset($option['extend'])) {
                $relation = isset($option['relation']) ? $option['relation'] : '=';
                $dishes = $dishes->where('extend', $relation, $option['extend']);
            }
        }
        $dishes = $dishes->get();
        foreach ($dishes as $dish) {
            $dish->pic = url(STORAGE_PATH . self::$PicDir) . '/' . $dish->pic;
            $others[$dish->extend][] = $dish;
        }

        return $others;
    }
}
