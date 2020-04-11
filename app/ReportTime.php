<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ReportTime extends Model
{
  protected $table = 'tb_reporttime';
  public $primaryKey = 'id';
  public $timestamps = false;
}
