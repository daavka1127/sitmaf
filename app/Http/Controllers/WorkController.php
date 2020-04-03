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

    public function getWorkType() // get json table
    {
      $work_type = DB::table('tb_work')->get();
      return DataTables::of($work_type)
          ->make(true);
      // return view('work.work_type.work_type_show', compact("work_type"));
    }
    public function work_typeShow()
    {
      $work_type = DB::table('tb_work_type')->get();
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
        $work_type = Work::find($req->id);
        $work_type->delete();
        return "Амжилттай устгалаа.";
    }
    public static function getCompactWorks($worktype)
    {
      $works = DB::table('tb_work')
          ->where("work_type_id", "=", $worktype)
          ->get();
      return $works;

    }
}
