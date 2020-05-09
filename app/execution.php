<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class execution extends Model
{
  protected $table = 'tb_execution';
  public $primaryKey = 'id';
  public $timestamps = false;
  protected $fillable = ['companyID', 'work_type_id', 'work_id', 'execution', 'date', 'percent'];
}
