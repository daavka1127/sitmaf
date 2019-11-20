<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class company extends Model
{
    protected $table = 'tb_companies';
    public $primaryKey = 'id';
    public $timestamps = false;
}
