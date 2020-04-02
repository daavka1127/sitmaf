<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Work_type extends Model
{
  protected $table = 'tb_work_type';
  public $primaryKey = 'id';
  public $timestamps = false;
}
