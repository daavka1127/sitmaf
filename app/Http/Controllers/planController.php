<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\plan;
use DB;
use Yajra\DataTables\DataTables;
use Response;

class planController extends Controller
{
    public function storePlanByWorkID($json, $comID)
    {
      foreach ($json as $key => $value) {

          $plan = new plan;
          $plan->companyID = $comID;
          $plan->work_type_id = $value['workTypeID'];
          $plan->work_id = $value['workID'];
          $plan->quantity = $value['value'];
          $plan->save();
      }
    }

    public function deletePlanByWorkTypeAndCompany($workTypeID, $comID)
    {
        $plans = DB::table("tb_plan")
            ->where('companyID', '=', $comID)
            ->where('work_type_id', '=', $workTypeID);
        $plans->delete();
    }

    public function deletePlanByCompany($comID)
    {
      $plans = DB::table("tb_plan")
          ->where('companyID', '=', $comID);
      $plans->delete();
    }

    public static function getPlanByWorkID($companiesID, $workID){
        $plans = DB::table('tb_plan')
            ->where('tb_plan.companyID', '=', $companiesID)
            ->where('tb_plan.work_id', '=', $workID)
            ->get();
        $quantity = 0;
        foreach ($plans as $plan) {
          $quantity = $plan->quantity;
        }
        return $quantity;
    }

    public static function getSumPlanQuantity($companiesID, $workTypeID){
        // $plans =
    }

    public function getPlanByCompany(Request $req){
        $plans = DB::table('tb_plan')
            ->where('tb_plan.companyID', '=', $req->companyID)
            ->get();
        // return $plans;
        return Response::json($plans);
    }
}
