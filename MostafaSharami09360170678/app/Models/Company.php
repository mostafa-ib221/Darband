<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Company extends Model {
    public function Cat() {return $this->hasOne(CoCat::class, 'id', 'cat');}
    public function Customer() {return $this->hasMany(Customer::class, 'co', 'id');}
}
