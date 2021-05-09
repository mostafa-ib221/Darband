<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Contact extends Model {
    protected $fillable = ['caption', 'value'];

    public static function getAllInArray() {
        $ret = [];
        $contacts = self::all();
        foreach($contacts as $contact) $ret[$contact->caption] = $contact->value;
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
