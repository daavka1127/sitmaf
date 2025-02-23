<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Work;
use DB;
use Yajra\DataTables\DataTables;
use Redirect;

class WorkController extends Controller
{

  public function __construct()
  {
      $this->middleware('auth');
  }
    public function getWorkType() // get json table
    {
      $work_type = DB::table('tb_work')
        ->join("tb_work_type",  "tb_work.work_type_id", "=", "tb_work_type.id")
        ->select("tb_work.id", "tb_work_type.name as work_type_id", "tb_work.work_type_id as workTypeID","tb_work.name", "tb_work.hemjih_negj")
        ->get();
      return DataTables::of($work_type)
          ->make(true);
      // return view('work.work_type.work_type_show', compact("work_type"));
    }
    public function work_typeShow()
    {
      $work_type = DB::table('tb_work_type')
        ->get();
      return view('work.work.work_show', compact('work_type'));
    }

    public function store(Request $req )
    {
      $work_type = new Work;
      $work_type->work_type_id = $req->Work_TypeID;
      $work_type->name = $req->work_type_name;
      $work_type->hemjih_negj = $req->work_hemjih_negj;
      $work_type->save();
      return "Амжилттай хадгаллаа.";

    }

    public function update(Request $req){

        $work_type = Work::find($req->id);
        $work_type->work_type_id = $req->Work_TypeID;
        $work_type->name = $req->work_type_name;
        $work_type->hemjih_negj = $req->work_hemjih_negj;
        $work_type->save();
        return "Амжилттай заслаа.";
        //return $req->id;
    }
    public function delete(Request $req){
        $exec = DB::table('tb_execution')
            ->where('work_id', '=', $req->id);
        $exec->delete();
        $plan = DB::table('tb_plan')
            ->where('work_id', '=', $req->id);
        $plan->delete();
        $work_type = Work::find($req->id);
        $work_type->delete();
        return "Амжилттай устгалаа.";
    }

    public static function getCompactWorks($worktype)
    {
      $works = DB::table('tb_work')

          ->where("work_type_id", "=", $worktype)
          ->orderBy('daraalal', 'ASC')
          ->get();
      return $works;
    }

    public static function getWorksAll($workTypeID){
      $works = DB::table('tb_work')
          ->where('tb_work.work_type_id', '=', $workTypeID)
          ->get();
      return $works;
    }
}
