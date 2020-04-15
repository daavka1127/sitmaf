<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\admin;
use DB;
use Illuminate\Support\Facades\Hash;
use Yajra\DataTables\DataTables;
class adminController extends Controller
{
  public function __construct()
  {
      $this->middleware('auth');
  }
    public function getAdmin(){
          $getAdmin = DB::table('users')
          ->join("tb_heseg2", "users.heseg_id", "=", "tb_heseg2.id")
          ->select("users.*", "tb_heseg2.name as heseg_name")->get();
          return DataTables::of($getAdmin)
              ->make(true);
    }

    public function adminView(){
        return view('admin.adminView');
    }

    public function adminUpdate(Request $req){

      $admin =  admin::find($req->adminRowID);
      $admin->name = $req->name;
      $admin->email = $req->email;
      $admin->password = Hash::make($req->pass);
      $admin->heseg_id = $req->heseg;
      $admin->edit = $req->edit;
      $admin->save();

      return "Амжилттай заслаа";
    }

    public function delete(Request $req){
        $admin = admin::find($req->id);
        $admin->delete();
        return "Амжилттай устгалаа";
    }
    public static function getAdminEdit($id)
    {
      $user = DB::table('users')
        ->where('id','=',$id)
        ->first();

      return $user;
    }
}
