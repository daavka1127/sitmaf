<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\execution;
use DB;
use Yajra\DataTables\DataTables;

class ExecutionContoller extends Controller
{





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
      ->select("tb_execution.execution", "tb_execution.date","tb_work.name","tb_work_type.name")
      ->where("companyID", "=", $req->comID)
      ->get();
      return DataTables::of($exec)
          ->make(true);
  }

}
