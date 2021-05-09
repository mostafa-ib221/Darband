<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Msgcat extends Model {
    //protected $table = 'msgcats';
    protected $fillable = ['user', 'title', 'read_admin', 'read_customer'];
}
