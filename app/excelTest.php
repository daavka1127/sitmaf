<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class excelTest extends Model
{
  protected $table = 'testexcel';
  public $primaryKey = 'id';
  public $timestamps = false;
  protected $fillable = ['name', 'exec', 'date'];
}
