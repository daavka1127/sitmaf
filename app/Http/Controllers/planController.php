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
        $plans = DB::table('tb_plan')
            ->where('tb_plan.companyID', '=', $companiesID)
            ->where('tb_plan.work_type_id', '=', $workTypeID)
            ->sum('quantity');
        return $plans;
    }

    public static function getCompanyPlanCountByWorkType($companyID, $workTypeID){
        $planCount = DB::table('tb_plan')
            ->where('companyID', '=', $companyID)
            ->where('work_type_id', '=', $workTypeID)
            ->get();
        return $planCount->count();
    }

    public function getPlanByCompany(Request $req){
        $plans = DB::table('tb_plan')
            ->where('tb_plan.companyID', '=', $req->companyID)
            ->get();
        // return $plans;
        return Response::json($plans);
    }

    public function getPlanWorkTypeByCompany(Request $req){ //
        $plans = DB::table('tb_plan')
            ->join('tb_work_type', "tb_plan.work_type_id", "=", "tb_work_type.id")
            ->select('tb_plan.work_type_id', "tb_work_type.name")
            ->where('tb_plan.companyID', '=', $req->companyID)
            ->groupBy('tb_plan.work_type_id', "tb_work_type.name")
            ->get();
        // return $plans;
        return Response::json($plans);
    }

    public function getPlanWorksByWorkTypeID(Request $req){
        $works = DB::table('tb_plan')
          ->join('tb_work', "tb_plan.work_id", "=", "tb_work.id")
          ->select('tb_plan.work_id', "tb_work.name", "tb_work.hemjih_negj", "tb_plan.quantity")
          ->where('tb_plan.companyID', "=", $req->companyID)
          ->where("tb_plan.work_type_id", "=", $req->work_type_id)
          ->get();
          return Response::json($works);
    }


}
