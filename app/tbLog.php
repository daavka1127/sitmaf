<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class tbLog extends Model
{
  protected $table = 'tb_log';
  public $primaryKey = 'id';
  public $timestamps = false;
}
