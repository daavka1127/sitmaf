<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class HesegController extends Controller
{
  public static function getHeseg(){
    $hesegs = DB::table("tb_heseg")
      ->get();
    return $hesegs;
  }

}
