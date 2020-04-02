<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Work_type;
use DB;
use Yajra\DataTables\DataTables;
use Redirect;

class WorktypeController extends Controller
{

  public function getWorkType() // get json table
  {
    $work_type = DB::table('tb_work_type')->get();
    return DataTables::of($work_type)
        ->make(true);
    // return view('work.work_type.work_type_show', compact("work_type"));
  }
  public function work_typeShow()
  {
    return view('work.work_type.work_type_show');
  }

  public function store(Request $req )
  {
    $work_type = new Work_type;
    $work_type->name = $req->work_type_name;
    $work_type->save();
    return "Амжилттай хадгаллаа.";

  }

  public function update(Request $req){
      $work_type = Work_type::find($req->id);
      $work_type->name = $req->work_type_name;
      $work_type->save();
      //return "Амжилттай заслаа.";
      return $req->id;
  }





}
