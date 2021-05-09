<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class About extends Model {
    protected $fillable = ['caption', 'value'];
    public static $PicBase = '/MostafaSharami09360170678/storage/app/';
    public static $PicDir = 'about';

    public static function getAllInArray() {
        $ret = [];
        $contacts = self::all();
        foreach($contacts as $contact)
            if($contact->caption == 'img')
                $ret[$contact->caption] = self::$PicBase . self::$PicDir . '/' . $contact->value;
            else
                $ret[$contact->caption] = $contact->value;
        return $ret;
    }

    public static function get($caption) {
        $contact = self::where('caption', $caption)->first();
        return $contact;
    }

    public static function set($caption, $value) {
        $contact = self::get($caption);
        if($contact != null) return $contact->update(['value' => $value]);
        $contact = self::create(['caption' => $caption, 'value' => $value]);
        return $contact;
    }
}
