<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Illuminate\Support\Facades\Auth;

class HesegController extends Controller
{
  public static function getHeseg(){
    $hesegs = DB::table("tb_heseg")
      ->get();
    return $hesegs;
  }

  public static function getHesegByAdmin(){
    if(Auth::user()->heseg_id > 0 && Auth::user()->heseg_id < 4){
      $hesegs = DB::table("tb_heseg")
        ->where('id', '=', Auth::user()->heseg_id)
        ->get();
      return $hesegs;
    }
    else{
      $hesegs = DB::table("tb_heseg")
        ->get();
      return $hesegs;
    }
  }

}
