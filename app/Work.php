<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Work extends Model
{
  protected $table = 'tb_work';
  public $primaryKey = 'id';
  public $timestamps = false;
}
