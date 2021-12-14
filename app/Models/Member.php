<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class Member extends Model {
    protected $connection = 'guy_jewelry';
    protected $table = 'members';
    public $timestamps = false;
}
