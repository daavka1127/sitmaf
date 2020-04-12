<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\admin;
use DB;
use Yajra\DataTables\DataTables;
class adminController extends Controller
{
    public function getAdmin(){
          $getAdmin = DB::table('users')->get();
          return DataTables::of($getAdmin)
              ->make(true);
    }

    public function adminView(){
        return view('admin.adminView');
    }

}
