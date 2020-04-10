<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class userLog extends Model
{
  protected $table = 'tb_userlog';
  public $primaryKey = 'id';
  public $timestamps = false;
}
