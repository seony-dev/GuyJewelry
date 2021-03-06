<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class Member extends Model {

    public $timestamps = false;

    public function notice() {
        return $this->hasMany(Notice::class);
    }
}
