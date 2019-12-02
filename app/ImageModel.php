<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ImageModel extends Model
{
  protected $table = 'tb_images';
  public $primaryKey = 'id';
  public $timestamps = false;
}
