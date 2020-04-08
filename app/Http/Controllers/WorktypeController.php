<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Work_type;
use App\Work;
use DB;
use Yajra\DataTables\DataTables;
use Redirect;

class WorktypeController extends Controller
{

  public function __construct()
  {
      $this->middleware('auth');
  }

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
      return "Амжилттай заслаа.";
      //return $req->id;
  }
  public function delete(Request $req){
      $work_type = Work_type::find($req->id);
      $work_type->delete();
      return "Амжилттай устгалаа.";
  }

  public static function getCompactWorkType()
  {
    $work_type = DB::table('tb_work_type')
        ->where("name", "!=", null)
        ->get();
    return $work_type;
  }

  public function visibleShowBlade()
    {
      return view('report.visible');
    }

  public function ChangeWorkTypeVisible(Request $req)
    {
      $workTypes=DB::table('tb_work_type')->update(['visible' => 0]);
      foreach($req->input('visibleWorkType') as $value){
          $changeVisible = Work_type::find($value);
          $changeVisible->visible = 1;
          $changeVisible->save();
      }

         return "Амжилттай өөрчиллөө";
    }

  public function getWorkTypeVisible(Request $req){
    $workTypeVisible = DB::table('tb_work')
        ->where("work_type_id", "=", $req->workTypeID)
        ->get();
    return $workTypeVisible;
    // return $req->workTypeID;
  }

  public function ChangeWorksVisible(Request $req)
    {
      $works=DB::table('tb_work')->update(['visible' => 0]);
      foreach($req->input('visibleWorkName') as $value){
          $changeVisible = Work::find($value);
          $changeVisible->visible = 1;
          $changeVisible->save();
      }

         return "Амжилттай өөрчиллөө";
    }






}
