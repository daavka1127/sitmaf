<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Controllers\planController;
use App\execution;
use DB;
use Yajra\DataTables\DataTables;

class ExecutionContoller extends Controller
{

    public function executionShow(){
        $companies = DB::table('tb_companies')
            ->join('tb_heseg', 'tb_companies.heseg_id', '=', 'tb_heseg.id')
            ->select('tb_companies.*', 'tb_heseg.name')
            ->orderBy('tb_companies.heseg_id', 'asc')
            ->orderBy('tb_companies.companyName', 'asc')
            ->get();
        return view('guitsetgel.guitsetgelShow', compact('companies'));
    }

    public function getCompanies(){
      $companies = DB::table('tb_companies')
          ->join('tb_heseg', 'tb_companies.heseg_id', '=', 'tb_heseg.id')
          ->select('tb_companies.*', 'tb_heseg.name')
          ->orderBy('tb_companies.heseg_id', 'asc')
          ->orderBy('tb_companies.companyName', 'asc')
          ->get();
      return DataTables::of($companies)
            ->make(true);
    }

    public static function getExecutionPercentByWorkID2019($companyID, $workID){
        $executions = DB::table('tb_execution')
            ->where('companyID', '=', $companyID)
            ->where('work_id', '=', $workID)
            ->where('date', 'LIKE', '2019' . '%')
            ->get();
        $exec = 0;
        foreach ($executions as $execution) {
            $exec = $execution->percent;
        }
        return $exec;
    }

    public static function getExecution2019($companyID, $workID){
        $executions = DB::table('tb_execution')
            ->where('companyID', '=', $companyID)
            ->where('work_id', '=', $workID)
            ->where('date', 'LIKE', '2019' . '%')
            ->get();
        $exec = 0;
        foreach ($executions as $execution) {
            $exec = $execution->execution;
        }
        return $exec;
    }

    public static function getExecutionWorkTypePercentAvg2019($companyID, $workTypeID){
        $executions = DB::table('tb_execution')
            ->where('companyID', '=', $companyID)
            ->where('work_type_id', '=', $workTypeID)
            ->where('date', 'LIKE', '2019' . '%')
            ->get();
        $sumPercent = 0;
        $plan = new planController;
        foreach ($executions as $execution) {
            $sumPercent = $sumPercent + $execution->percent;
        }
        $planCount = $plan->getCompanyPlanCountByWorkType($companyID, $workTypeID);
        if($sumPercent == 0){
            return 0;
        }
        else{
            return $sumPercent/$planCount;
        }
    }

    public static function getSumExecution2019($companiesID, $workTypeID){
        $sumExecution = DB::table('tb_execution')
            ->where('companyID', '=', $companiesID)
            ->where('work_type_id', '=', $workTypeID)
            ->where('date', 'LIKE', '2019' . '%')
            ->sum('execution');
        return $sumExecution;
    }

    public static function getExecutionAllCompanyIDworkID($companiesID, $workID){
        $sumAllExecution = DB::table('tb_plan')
            ->select(
              DB::raw("(SELECT `quantity` FROM `tb_plan` WHERE `companyID`=$companiesID AND `work_id`=$workID) as planQuantity"),
              DB::raw("(SELECT `percent` FROM `tb_execution` WHERE `companyID`=$companiesID AND `work_id`=$workID AND
                  date=(SELECT MAX(date) FROM `tb_execution` WHERE `companyID`=$companiesID AND `work_id`=$workID AND
                  date LIKE '2019%' )) as percent2019"),
              DB::raw("(SELECT SUM(`execution`) FROM `tb_execution` WHERE `companyID`=$companiesID AND `work_id`=$workID AND
                  date LIKE '2019%') as totalExec2019"),
              DB::raw("(SELECT SUM(`execution`) FROM `tb_execution` WHERE `companyID`=$companiesID AND `work_id`=$workID) as totalExecAll"),
              DB::raw("(SELECT SUM(`execution`) FROM `tb_execution`
                  WHERE `companyID`=$companiesID AND `work_id`=$workID AND `date`= ( SELECT MAX(`date`) FROM `tb_execution` ))
                  AS lastExec"),
              DB::raw("(SELECT SUM(`execution`) FROM `tb_execution` WHERE `companyID`=$companiesID AND `work_id`=$workID AND
                  `date` LIKE '2020%') as lastexec2020"),
              DB::raw("(SELECT `percent` FROM `tb_execution`  WHERE `companyID`=$companiesID AND `work_id`=$workID  AND `date`= ( SELECT MAX(`date`) FROM `tb_execution` )) as totalPercent")
            )
            ->where('companyID', '=', $companiesID)
            ->where('work_id', '=', $workID)
            ->get();
        return $sumAllExecution;

    }

    public static function getSumAndAvgExecPlan($companyID, $workTypeID){
        $sums = DB::table("tb_companies")
            ->select(
                DB::raw("(SELECT SUM(`quantity`) FROM tb_plan WHERE `companyID`=$companyID AND `work_type_id`=$workTypeID)
                    as sumPlanQuantity"),
                DB::raw("(SELECT SUM(`execution`) FROM tb_execution WHERE `companyID`=$companyID AND `work_type_id`=$workTypeID)
                    as totalSumExec"),
                DB::raw("(SELECT SUM(`execution`) FROM tb_execution WHERE `companyID`=$companyID AND `work_type_id`=$workTypeID
                    AND date LIKE '2019%') as totalSumExec2019"),
                DB::raw("(SELECT SUM(`execution`) FROM tb_execution WHERE `companyID`=$companyID AND `work_type_id`=$workTypeID
                    AND `date`= ( SELECT MAX(`date`) FROM `tb_execution` )) as lastSumExect"),
                DB::raw("(SELECT SUM(`execution`) FROM tb_execution WHERE `companyID`=$companyID AND `work_type_id`=$workTypeID
                    AND `date` LIKE '2020%') as sumExec2020"),
            )
            ->where('id', '=', $companyID)
            ->get();
        return $sums;
    }






  public function store(Request $req){

    foreach ($req->json as $key => $value) {
      $execution = new execution;
      $execution->companyID = $req->companyID;
      $execution->work_type_id = $value['workTypeID'];
      $execution->work_id = $value['workID'];
      $execution->execution = $value['value'];
      $execution->date = $req->createDate;
      $execution->percent = $this->getPercent($value['value'], $req->companyID, $value['workID']);
      $execution->save();
    }
    return "Амжилттай хадгаллаа";

  }

  public function execDelete(Request $req){
      $exec = execution::find($req->id);
      $exec->delete();
      return "Амжилттай устгалаа.";
  }

  public function execUpdate(Request $req){
      $exec = execution::find($req->execRowID);
      $exec->execution = $req->editExec;
      $exec->save();
      return "Амжилттай хадгаллаа.";
  }

  public function getPercent($val, $comID, $workID){
    $getPlan = DB::table("tb_plan")
      ->where("companyID", "=", $comID)
      ->where("work_id", "=", $workID)
      ->first();

    $quantity = $getPlan->quantity;

    $getExecution = DB::table("tb_execution")
      ->where("companyID", "=", $comID)
      ->where("work_id", "=", $workID)
      ->sum("execution");


    return ($getExecution + $val)*100/$quantity;

  }

  public function getExecByCompany(Request $req) {
    $exec = DB::table("tb_execution")
      ->join("tb_work", "tb_execution.work_id", "=","tb_work.id")
      ->join("tb_work_type", "tb_execution.work_type_id", "=", "tb_work_type.id")
      ->select("tb_execution.id","tb_execution.execution", "tb_execution.date","tb_work.name as workName","tb_work_type.name as workTypeName")
      ->where("companyID", "=", $req->comID)
      ->get();
      return DataTables::of($exec)
          ->make(true);
  }

}
