<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class Notice extends Model {

    public $timestamps = false;

    public function member() {
        return $this->belongsTo(Member::class);
    }

}
