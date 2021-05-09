<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model {
    public function Co() {return $this->hasOne(Company::class, 'id', 'co');}
    public function User() {return $this->hasOne(User::class, 'id', 'user');}
}
