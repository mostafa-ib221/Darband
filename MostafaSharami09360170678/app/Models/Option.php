<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Option extends Model {
    public static $PicDir = 'Option';
    protected $fillable = ['title', 'description', 'price'];

    public static function getAll($inPage=0) {
        $opts = ($inPage == 0) ? self::all() : self::paginate($inPage);
        foreach ($opts as &$opt)
            if(($opt->pic != null) && !empty($opt->pic))
                $opt->pic = url(STORAGE_PATH . self::$PicDir) . '/' . $opt->pic;
        return $opts;
    }

    public static function get($id) {
        $opt = self::find($id);
        if(!empty($opt)) $opt->pic = url(STORAGE_PATH . self::$PicDir) . '/' . $opt->pic;
        return $opt;
    }
}
