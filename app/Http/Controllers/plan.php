<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\plan;
use DB;
use Yajra\DataTables\DataTables;

class plan extends Controller
{
  public static function getPlanByWorkID($companiesID, $workID){
      $plans = DB::table('tb_plan')
      ->where('tb_plan.companyID', '=', $companiesID)
      ->where('tb_plan.work_id', '=', $workID)
      ->first();
      return $plans->quantity;
  }
}
