<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Catering extends Model {
    protected $fillable = ['name', 'email', 'number', 'date', 'comment', 'read'];
}
