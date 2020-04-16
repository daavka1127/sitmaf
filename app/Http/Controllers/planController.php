<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\plan;
use DB;
use App\Http\Controllers\logsController;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Response;

class planController extends Controller
{
  public function __construct()
  {
      $this->middleware('auth');
  }
    public function storePlanByWorkID($json, $comID, $ip, $type)
    {

      foreach ($json as $key => $value) {

          $plan = new plan;
          $plan->companyID = $comID;
          $plan->work_type_id = $value['workTypeID'];
          $plan->work_id = $value['workID'];
          $plan->quantity = $value['value'];
          $plan->save();

          $log = new logsController;
          if($type == "add")
            $log->insertTableLog($ip, Auth::user()->name, "Өгөгдөл оруулсан", "Төлөвлөгөө", $value['workName']." : ".$value['value'], "");
          else
            $log->insertTableLog($ip, Auth::user()->name, "Өгөгдөл зассан", "Төлөвлөгөө", $value['workName']." : ".$value['value'], "");

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

    public static function getSumPlanCompany($comID, $workTypeID){
        $sumPlan = DB::table('tb_plan')
            ->where('companyID', '=', $comID)
            ->where('work_type_id', '=', $workTypeID)
            ->sum('quantity');
        return $sumPlan;
    }

    public static function getPlanSections($hesegID, $workTypeID){
      $plans = DB::table("tb_plan")
          ->join('tb_companies', 'tb_plan.companyID', '=', 'tb_companies.id')
          ->select(DB::raw("SUM(tb_plan.quantity) as quantity"))
          ->where('tb_companies.heseg_id','=', $hesegID)
          ->where('tb_plan.work_type_id','=', $workTypeID)
          ->get();
      foreach ($plans as $plan) {
        $plan1 = $plan->quantity;
      }
      return $plan1;
    }

    public static function getExecPercent2019($hesegID, $workTypeID){
        $execution2019 = DB::table("tb_execution")
            ->join("tb_companies", 'tb_execution.companyID', '=', 'tb_companies.id')
            ->select(DB::raw("SUM(tb_execution.execution) as execution2019"))
            ->where('tb_execution.date', 'LIKE', "2019%")
            ->where('tb_companies.heseg_id', '=', $hesegID)
            ->where('tb_execution.work_type_id', '=', $workTypeID)
            ->get();
        foreach ($execution2019 as $pizda) {
          $execution2019P = $pizda->execution2019;
        }
        // return $plan;
        return $execution2019P;
    }




}
