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
    //
    public static function getCompactWorks($worktype)
    {
      $works = DB::table('tb_work')
          ->where("work_type_id", "=", $worktype)
          ->get();
      return $works;
    }
}
