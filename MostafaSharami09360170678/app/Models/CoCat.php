<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CoCat extends Model {
    protected $table = 'co_cats';
    public function Co() {return $this->hasMany(Company::class, 'cat', 'id');}
}
