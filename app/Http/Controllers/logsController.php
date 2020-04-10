<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\tbLog;
use App\userLog;
use DB;
use Yajra\DataTables\DataTables;
use Redirect;

class logsController extends Controller
{
  public function __construct()
  {
      $this->middleware('auth');
  }

  public function insertTableLog(Req $req)
  {

  }

  public function insertUserLog(Req $req)
  {

  }
  public function index()
  {
    return view('logView.tableLogView');
  }

  public function getTableLog()
  {
    $tableLog = DB::table("tb_log")->get();

    return DataTables::of($tableLog)
          ->make(true);
  }
  public function getUserLog()
  {

  }

}
