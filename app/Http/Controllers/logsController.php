<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\tbLog;
use App\userLog;
use DB;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Redirect;

class logsController extends Controller
{
  public function __construct()
  {
      $this->middleware('auth');
  }

  public function insertTableLog($ip, $userName, $actionName, $tbName, $value, $comment)
  {
    $log = new tbLog;
    $log->ipAddress = $ip;
    $log->userName = $userName;
    $log->actionName = $actionName;
    $log->tableName = $tbName;
    $log->value = $value;
    $log->comment = $comment;
    $log->dateTime = Carbon::now();
    $log->save();
    return "Амжилттай хадгаллаа.";
  }

  public function insertUserLog($ip)
  {
    $userLog = new userLog;
    $userLog->ipAddress = $ip;
    $userLog->userName = Auth::user()->name;
    $userLog->dateTime = Carbon::now();
    $userLog->save();
  }
  public function index()
  {
    return view('logView.tableLogView');
  }

  public function getTableLog()
  {
    $tableLog = DB::table("tb_log")
    ->orderBy('dateTime', 'desc')->get();

    return DataTables::of($tableLog)
          ->make(true);
  }
  public function userTableLog()
  {
    $tableLog = DB::table("tb_userlog")
    ->orderBy('dateTime', 'desc')->get();

    return DataTables::of($tableLog)
          ->make(true);
  }

  public function getIpTest(Request $req){
    return $req->ip();
  }

}
