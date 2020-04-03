<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class plan extends Model
{
  protected $table = 'tb_plan';
  public $primaryKey = 'id';
  public $timestamps = false;
}
