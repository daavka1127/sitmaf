<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\plan;
use DB;
use Yajra\DataTables\DataTables;

class planController extends Controller
{
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
}
