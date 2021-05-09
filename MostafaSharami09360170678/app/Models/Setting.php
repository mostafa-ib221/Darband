<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Setting extends Model {
    protected $fillable = ['key', 'value'];

    public static function set($key, $value, $encodeJsonValue=true) {
        if($encodeJsonValue) $value = json_encode($value);
        $setting = self::where('key', $key)->first();
        if(empty($setting)) {
            $setting = new Setting();
            $setting->key = $key;
            $setting->value = $value;
            $setting->save();
            return isset($setting->id);
        } else {
            if($setting->update(['value' => $value])) return true;
        }
        return false;
    }

    public static function get($key, $decodeJsonValue=true) {
        $setting = self::where('key', $key)->first();
        //if(empty($setting)) return $decodeJsonValue ? [] : '';
        if(empty($setting)) return null;
        return $decodeJsonValue ? json_decode($setting->value) : $setting->value;
    }
}
