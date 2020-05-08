<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Controllers\planController;
use Illuminate\Support\Facades\Auth;
use App\execution;
use DB;
use App\Http\Controllers\logsController;
use Yajra\DataTables\DataTables;


class ExecutionContoller extends Controller
{

  public function __construct()
  {
      $this->middleware('auth');
  }
    public function executionShow(){

        if(Auth::user()->heseg_id >= 1 && Auth::user()->heseg_id <= 3 ){
          $hesegID = Auth::user()->heseg_id;
          $companies = DB::table('tb_companies')
              ->join('tb_heseg', 'tb_companies.heseg_id', '=', 'tb_heseg.id')
              ->select('tb_companies.*', 'tb_heseg.name')
              ->where("tb_companies.heseg_id", "=", $hesegID)
              ->orderBy('tb_companies.heseg_id', 'asc')
              ->orderBy('tb_companies.companyName', 'asc')
              ->get();
        return view('guitsetgel.guitsetgelShow', compact('companies'));
        }else{
          $companies = DB::table('tb_companies')
              ->join('tb_heseg', 'tb_companies.heseg_id', '=', 'tb_heseg.id')
              ->select('tb_companies.*', 'tb_heseg.name')
              ->orderBy('tb_companies.heseg_id', 'asc')
              ->orderBy('tb_companies.companyName', 'asc')
              ->get();
          return view('guitsetgel.guitsetgelShow', compact('companies'));
        }
    }

    public static function previousReportExecutionByComIdWorkID($comID, $workID){
        $allExecution = DB::table("tb_companies")
            ->select(
                DB::raw("(SELECT SUM(`execution`) FROM `tb_execution` WHERE `companyID` = $comID AND `work_id` = $workID AND
                `date` LIKE '2020%') as allExecution"),
                DB::raw("(SELECT SUM(`execution`) FROM `tb_execution` WHERE `companyID` = $comID AND `work_id` = $workID AND
                `date` BETWEEN (SELECT `startDate` FROM `tb_reporttime` WHERE `id`=1) AND (SELECT `endDate` FROM `tb_reporttime` WHERE `id`=1))
                as lastExecution")
            )
            ->where('id', '=', $comID)
            ->first();
            return $allExecution->allExecution - $allExecution->lastExecution;
    }

    public static function getLastExecByComIdWorkID($comID, $workID){
        $lastExec = DB::table("tb_companies")
            ->select(
                DB::raw("(SELECT SUM(`execution`) FROM `tb_execution` WHERE `companyID` = $comID AND `work_id` = $workID AND
                `date` BETWEEN (SELECT `startDate` FROM `tb_reporttime` WHERE `id`=1) AND (SELECT `endDate` FROM `tb_reporttime` WHERE `id`=1)) as lastExecution")
            )
            ->where('id', '=', $comID)
            ->first();
        return $lastExec->lastExecution;
    }

    public static function previousReportExecutionByComId($comID){
        $allExecution = DB::table("tb_companies")
            ->select(
                DB::raw("(SELECT SUM(`execution`) FROM `tb_execution` WHERE `companyID` = $comID) as allExecution"),
                DB::raw("(SELECT SUM(`execution`) FROM `tb_execution` WHERE `companyID` = $comID AND
                `date` BETWEEN (SELECT `startDate` FROM `tb_reporttime` WHERE `id`=1) AND (SELECT `endDate` FROM `tb_reporttime` WHERE `id`=1)) as lastExecution")
            )
            ->where('id', '=', $comID)
            ->first();
            return $allExecution->allExecution - $allExecution->lastExecution;
    }

    public static function getLastExecByComId($comID){
        $lastExec = DB::table("tb_companies")
            ->select(
                DB::raw("(SELECT SUM(`execution`) FROM `tb_execution` WHERE `companyID` = $comID AND
                `date`= ( SELECT MAX(`date`) FROM `tb_execution`)) as lastExecution")
            )
            ->where('id', '=', $comID)
            ->first();
        return $lastExec->lastExecution;
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

    public static function getExecutionPercentByCompany2019($comID, $workTypeID){
        $sumPlan = DB::table("tb_plan")
            ->where('companyID', '=', $comID)
            ->where('work_type_id', '=', $workTypeID)
            ->sum('quantity');
        $sumExecution = DB::table("tb_execution")
            ->where('companyID', '=', $comID)
            ->where('work_type_id', '=', $workTypeID)
            ->where('date', 'like', '2019%')
            ->sum('execution');
        if($sumPlan == 0)
          return "";
        else
          return round($sumExecution*100/$sumPlan, 2);
    }

    public static function getSumExecutionByCompany2020($comID, $workTypeID){
        $sumPlan = DB::table("tb_plan")
            ->where('companyID', '=', $comID)
            ->where('work_type_id', '=', $workTypeID)
            ->sum('quantity');
        $sumExecution = DB::table("tb_execution")
            ->where('companyID', '=', $comID)
            ->where('work_type_id', '=', $workTypeID)
            ->where('date', 'like', '2019%')
            ->sum('execution');
        return $sumPlan - $sumExecution;
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
              DB::raw("((SELECT SUM(`execution`) FROM `tb_execution` WHERE `companyID`=$companiesID AND `work_id`=$workID AND
                  date LIKE '2019%')*100/(SELECT `quantity` FROM `tb_plan` WHERE `companyID`=$companiesID AND `work_id`=$workID))
                  as percent2019"),
              DB::raw("(SELECT SUM(`execution`) FROM `tb_execution` WHERE `companyID`=$companiesID AND `work_id`=$workID AND
                  date LIKE '2019%') as totalExec2019"),
              DB::raw("(SELECT SUM(`execution`) FROM `tb_execution` WHERE `companyID`=$companiesID AND `work_id`=$workID) as totalExecAll"),
              DB::raw("(SELECT SUM(`execution`) FROM `tb_execution`
                  WHERE `companyID`=$companiesID AND `work_id`=$workID AND
                  `date` BETWEEN (SELECT startDate FROM `tb_reporttime` WHERE id=1) AND (SELECT endDate FROM `tb_reporttime` WHERE id=1))
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
                    AND `date` BETWEEN (SELECT startDate FROM `tb_reporttime` WHERE id=1) AND (SELECT endDate FROM `tb_reporttime` WHERE id=1))
                    as lastSumExect"),
                DB::raw("(SELECT SUM(`execution`) FROM tb_execution WHERE `companyID`=$companyID AND `work_type_id`=$workTypeID
                    AND `date` LIKE '2020%') as sumExec2020")
            )
            ->where('id', '=', $companyID)
            ->get();
        return $sums;
    }






  public function store(Request $req){
    $res = "";
    foreach ($req->json as $key => $value) {
      $check = DB::table("tb_execution")
        ->where("companyID", "=", $req->companyID)
        ->where("work_type_id","=",$value['workTypeID'])
        ->where("work_id","=",$value['workID'])
        ->where("date","=",$req->createDate)
        ->get();

        if($check->count() == 0){
          $execution = new execution;
          $execution->companyID = $req->companyID;
          $execution->work_type_id = $value['workTypeID'];
          $execution->work_id = $value['workID'];
          $execution->execution = $value['value'];
          $execution->date = $req->createDate;
          $execution->percent = $this->getPercent($value['value'], $req->companyID, $value['workID']);
          $execution->save();
          $res = "Амжилттай хадгаллаа";


          $log = new logsController;
          $log->insertTableLog($req->ip(), Auth::user()->name, "Өгөгдөл оруулсан", "Гүйцэтгэл",
            explode("м3",$value['workName'])[0]." : ".$value['value'], "".$this->getCompanyName($req->companyID)."  огноо: ".$req->createDate);
        }
        else {
          $res = "Тухайн өдрийн ажлын гүйцэтгэл бүртгэгдсэн байна.";
        }
    }
    return $res;
  }

  public function getCompanyName($comID)
  {
    $company = DB::table('tb_companies')
      ->where('id','=',$comID)
    ->first();
    return $company->companyName;
  }



  public function execDelete(Request $req){
      $exec = execution::find($req->id);
      $exec->delete();

      $log = new logsController;
      $log->insertTableLog($req->ip(), Auth::user()->name, "Өгөгдөл устгав", "Гүйцэтгэл",
        $req->workName." : ".$req->execution , "".$req->comName);

      return "Амжилттай устгалаа.";
  }

  public function execDeleteByCompany($comID){
      $exec = DB::table("tb_execution")
        ->where('companyID', '=', $comID);
      $exec->delete();
      return "Амжилттай устгалаа.";
  }

  public function execUpdate(Request $req){
      $exec = execution::find($req->execRowID);
      $exec->execution = $req->editExec;
      $exec->save();

      $log = new logsController;
      $log->insertTableLog($req->ip(), Auth::user()->name, "Өгөгдөл засав", "Гүйцэтгэл",
        $req->workName." : ".$req->editExec , "".$req->comName." огноо: ".$req->editDate);

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
      ->select("tb_execution.id","tb_execution.execution", "tb_execution.date","tb_work.name as workName","tb_work_type.name as workTypeName", "tb_execution.work_id")
      ->where("companyID", "=", $req->comID)
      ->get();
      return DataTables::of($exec)
          ->make(true);
  }

  public static function getLastExecutionByHeseg($hesegID, $workID){
    $lastExecs = DB::table("tb_execution")
        ->join('tb_companies', 'tb_execution.companyID', '=', 'tb_companies.id')
        ->select(DB::raw("SUM(tb_execution.execution) as lastExec"))
        ->where('tb_companies.heseg_id', '=', $hesegID)
        ->where('tb_execution.work_id', '=', $workID)
        ->whereBetween('tb_execution.date', [DB::raw('(SELECT `startDate` FROM `tb_reporttime` WHERE id=1)'), DB::raw('(SELECT `endDate` FROM `tb_reporttime` WHERE id=1)')])
        ->get();
    foreach ($lastExecs as $lastExec) {
      $lastExec1 = $lastExec->lastExec;
    }
    return $lastExec1;
  }

  public static function getAllExecution2020ByHeseg($hesegID, $workID){
    $lastExecs = DB::table("tb_execution")
        ->join('tb_companies', 'tb_execution.companyID', '=', 'tb_companies.id')
        ->select(DB::raw("SUM(tb_execution.execution) as lastExec"))
        ->where('tb_companies.heseg_id', '=', $hesegID)
        ->where('tb_execution.work_id', '=', $workID)
        ->where('tb_execution.date', 'like', '2020%')
        ->get();
    foreach ($lastExecs as $lastExec) {
      $lastExec1 = $lastExec->lastExec;
    }
    return $lastExec1;
  }

  public static function getAllExec2020ByHeseg($hesegID, $workTypeID){
      $allHesegExecs = DB::table('tb_execution')
          ->join('tb_companies', 'tb_execution.companyID', '=', 'tb_companies.id')
          ->select(DB::raw("SUM(tb_execution.execution) as allExec"))
          ->where('tb_companies.heseg_id', '=', $hesegID)
          ->where('tb_execution.work_type_id', '=', $workTypeID)
          ->where('tb_execution.date', 'like', '2020%')
          ->get();
      foreach ($allHesegExecs as $allHesegExec) {
        $allExecHeseg = $allHesegExec->allExec;
      }
      return $allExecHeseg;
  }

  public static function getAllExecPercent($workTypeID){
      $sumPlan = DB::table('tb_plan')
          ->where('work_type_id', '=', $workTypeID)
          ->sum('quantity');
      $sumExec = DB::table('tb_execution')
          ->where('work_type_id', '=', $workTypeID)
          ->sum('execution');
      return $sumExec*100/$sumPlan;
  }

  public static function getAllExecByCompany($comID, $workTypeID){
      $allExecCompany = DB::table('tb_execution')
          ->where('companyID', '=', $comID)
          ->where('work_type_id', '=', $workTypeID)
          ->sum('execution');
      return $allExecCompany;
  }

  public static function getAllExec2020ByCompany($comID, $workTypeID){
      $allExecCompany = DB::table('tb_execution')
          ->where('companyID', '=', $comID)
          ->where('work_type_id', '=', $workTypeID)
          ->where('date', 'LIKE', '2020%')
          ->sum('execution');
      return $allExecCompany;
  }

  public static function getAllExecByWorkTypeID($workTypeID){
      $allExecCompany = DB::table('tb_execution')
          ->where('companyID', '=', $comID)
          ->where('work_type_id', '=', $workTypeID)
          ->sum('execution');
      return $allExecCompany;
  }

  public static function getAllExecByReportTime($companyID, $workTypeID){
      $reportTimeExecs = DB::table('tb_execution')
          ->select(DB::raw("SUM(tb_execution.execution) as lastExec"))
          ->where('companyID', '=', $companyID)
          ->where('work_type_id', '=', $workTypeID)
          ->whereBetween('tb_execution.date', [DB::raw('(SELECT `startDate` FROM `tb_reporttime` WHERE id=1)'), DB::raw('(SELECT `endDate` FROM `tb_reporttime` WHERE id=1)')])
          ->get();
      $reportTimeExec1 = 0;
      foreach($reportTimeExecs as $reportTimeExec){
          $reportTimeExec1 = $reportTimeExec->lastExec;
      }
      return $reportTimeExec1;
  }

  public static function getAllExecByHesegReportTime($hesegID, $workTypeID){
      $execs = DB::table("tb_execution")
          ->join('tb_companies', 'tb_execution.companyID', '=', 'tb_companies.id')
          ->select(DB::raw("SUM(tb_execution.execution) as lastExec"))
          ->where('tb_companies.heseg_id', '=', $hesegID)
          ->where('tb_execution.work_type_id', '=', $workTypeID)
          ->whereBetween('tb_execution.date', [DB::raw('(SELECT `startDate` FROM `tb_reporttime` WHERE id=1)'), DB::raw('(SELECT `endDate` FROM `tb_reporttime` WHERE id=1)')])
          ->get();
      foreach($execs as $exec){
          $exec1 = $exec->lastExec;
      }
      return $exec1;
  }

  public static function getAllExecPercent2020($companyID, $workTypeID){
      $exec2020 = DB::table("tb_execution")
          ->where("companyID", '=', $companyID)
          ->where('work_type_id', '=', $workTypeID)
          ->where('date', 'like', '2020%')
          ->sum("execution");
      $exec2019 = DB::table("tb_execution")
          ->where("companyID", '=', $companyID)
          ->where('work_type_id', '=', $workTypeID)
          ->where('date', 'like', '2019%')
          ->sum("execution");
      $plan = DB::table("tb_plan")
          ->where("companyID", '=', $companyID)
          ->where('work_type_id', '=', $workTypeID)
          ->sum("quantity");
      $plan2020 = $plan - $exec2019;
      if($plan2020 <= 0){
          return 0;
      }
      else{
          return $exec2020*100/$plan2020;
      }
  }

  public static function getAllHesegExecPercent2020($hesegID, $workTypeID){
      $exec2020 = DB::table("tb_execution")
          ->join('tb_companies', 'tb_execution.companyID', '=', 'tb_companies.id')
          ->where("tb_companies.heseg_id", '=', $hesegID)
          ->where('tb_execution.work_type_id', '=', $workTypeID)
          ->where('tb_execution.date', 'like', '2020%')
          ->sum("tb_execution.execution");
      $exec2019 = DB::table("tb_execution")
          ->join('tb_companies', 'tb_execution.companyID', '=', 'tb_companies.id')
          ->where("tb_companies.heseg_id", '=', $hesegID)
          ->where('tb_execution.work_type_id', '=', $workTypeID)
          ->where('tb_execution.date', 'like', '2019%')
          ->sum("tb_execution.execution");
      $plan = DB::table("tb_plan")
          ->join('tb_companies', 'tb_plan.companyID', '=', 'tb_companies.id')
          ->where("tb_companies.heseg_id", '=', $hesegID)
          ->where('tb_plan.work_type_id', '=', $workTypeID)
          ->sum("tb_plan.quantity");
      $plan2020 = $plan - $exec2019;
      if($plan2020 <= 0){
          return 0;
      }
      else{
          return $exec2020*100/$plan2020;
      }
  }

  public static function getAllExecByHeseg($hesegID, $workTypeID){
      $allExec = DB::table("tb_execution")
          ->join('tb_companies', 'tb_execution.companyID', '=', 'tb_companies.id')
          ->where('tb_companies.heseg_id', '=', $hesegID)
          ->where('tb_execution.work_type_id', '=', $workTypeID)
          ->sum("execution");

      return $allExec;
  }

  public static function getSumExec2020ByCompany($companyID, $workTypeID){
    $prevExec = DB::table("tb_execution")
        ->where('companyID', '=', $companyID)
        ->where('work_type_id', '=', $workTypeID)
        ->where('date', 'LIKE', '2020%')
        ->sum('execution');
    return $prevExec;
  }

  public static function getAllHesegExec2020Percent($workTypeID){
      $plan = DB::table("tb_plan")
          ->where('work_type_id', '=', $workTypeID)
          ->sum("quantity");
      $exec2019 = DB::table('tb_execution')
          ->where('work_type_id', '=', $workTypeID)
          ->where('date', 'LIKE', '2019%')
          ->sum('execution');
      $exec2020 = DB::table('tb_execution')
          ->where('work_type_id', '=', $workTypeID)
          ->where('date', 'LIKE', '2020%')
          ->sum('execution');
      $plan2020 = $plan - $exec2019;
      if($plan2020 <= 0){
          return 0;
      }
      else{
          return $exec2020*100/$plan2020;
      }
  }

  public static function getAllHesegExecPercent($workTypeID){
      $plan = DB::table("tb_plan")
          ->where('work_type_id', '=', $workTypeID)
          ->sum("quantity");
      $exec = DB::table('tb_execution')
          ->where('work_type_id', '=', $workTypeID)
          ->sum('execution');
      if($plan <= 0){
          return 0;
      }
      else{
          return $exec*100/$plan;
      }
  }

  public function getOtherExec(Request $req){
      $execs = DB::table('tb_execution')
          ->where('id', '!=', $req->id)
          ->where('companyID', '=', $req->companyID)
          ->where('work_id', '=', $req->workID)
          ->sum('execution');
      $plans = DB::table('tb_plan')
          ->where('companyID', '=', $req->companyID)
          ->where('work_id', '=', $req->workID)
          ->get();
      $plan1 = 0;
      foreach($plans as $plan){
         $plan1 = $plan->quantity;
      }
      $array = array(
          'plan' => $plan1,
          'exec' => $execs
      );
      return json_encode($array);
  }
}
