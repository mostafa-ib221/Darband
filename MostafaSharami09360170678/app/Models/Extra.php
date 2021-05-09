<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Extra extends Model {
    protected $fillable = ['title', 'description', 'price'];

    /*public function Dishes() {
        return $this->belongsToMany('Dish','dish_extra', '', '');
    }*/
}
