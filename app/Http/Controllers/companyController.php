<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\company;
use App\Http\Controllers\planController;
use App\Http\Controllers\logsController;
use App\Http\Controllers\ExecutionContoller;
use App\plan;
use App\tbLog;
use Illuminate\Support\Facades\Auth;
use DB;
use Yajra\DataTables\DataTables;

class companyController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public static function getCompaniesExcel($heseg){
        $companies = DB::table("tb_companies")
            ->where('heseg_id', '=', $heseg)
            ->orderBy('daraalal', "ASC")
            ->get();
        return $companies;
    }

    public function getCompanies(){
      if(Auth::user()->heseg_id >= 1 && Auth::user()->heseg_id <= 3 ){
        $hesegID = Auth::user()->heseg_id;
        $companies = DB::table('tb_companies')
            ->join('tb_heseg', 'tb_companies.heseg_id', '=', 'tb_heseg.id')
            ->select('tb_companies.*', 'tb_heseg.name', 'tb_heseg.id as hesegID',
            DB::raw("(SELECT SUM(quantity) FROM `tb_plan` as `t1` WHERE `t1`.`companyID` = tb_companies.id) as plan"),
            DB::raw("(SELECT SUM(execution) FROM `tb_execution` as `t2` WHERE `t2`.`companyID` = tb_companies.id) as allExec"),
            DB::raw('(FORMAT((SELECT SUM(execution) FROM `tb_execution` as `t2` WHERE `t2`.`companyID` = tb_companies.id)*100/(SELECT SUM(quantity) FROM
            `tb_plan` as `t1` WHERE `t1`.`companyID` = tb_companies.id), 2)) as per'),
            DB::raw("(SELECT `tb_execution`.`date` FROM `tb_execution` WHERE `tb_execution`.`companyID` = tb_companies.id ORDER BY `tb_execution`.`date`
            DESC limit 1) as ognoo1"))
            ->where("tb_companies.heseg_id", "=", $hesegID)
            ->orderBy('tb_companies.heseg_id', 'asc')
            ->orderBy('tb_companies.companyName', 'asc')
            ->get();
        return DataTables::of($companies)
              ->make(true);
      }else{
        $companies = DB::table('tb_companies')
            ->join('tb_heseg', 'tb_companies.heseg_id', '=', 'tb_heseg.id')
            ->select('tb_companies.*', 'tb_heseg.name', 'tb_heseg.id as hesegID',
            DB::raw("(SELECT SUM(quantity) FROM `tb_plan` as `t1` WHERE `t1`.`companyID` = tb_companies.id) as plan"),
            DB::raw("(SELECT SUM(execution) FROM `tb_execution` as `t2` WHERE `t2`.`companyID` = tb_companies.id) as allExec"),
            DB::raw('(FORMAT((SELECT SUM(execution) FROM `tb_execution` as `t2` WHERE `t2`.`companyID` = tb_companies.id)*100/(SELECT SUM(quantity) FROM
            `tb_plan` as `t1` WHERE `t1`.`companyID` = tb_companies.id), 2)) as per'),
            DB::raw("(SELECT `tb_execution`.`date` FROM `tb_execution` WHERE `tb_execution`.`companyID` = tb_companies.id ORDER BY `tb_execution`.`date`
            DESC limit 1) as ognoo1"))
            ->orderBy('tb_companies.heseg_id', 'asc')
            ->orderBy('tb_companies.companyName', 'asc')
            ->get();
        return DataTables::of($companies)
              ->make(true);
      }
    }

    public static function getCompaniesJson(){
      if(Auth::user()->heseg_id >= 1 && Auth::user()->heseg_id <= 3 ){
        $hesegID = Auth::user()->heseg_id;
        $companies = DB::table('tb_companies')
            ->join('tb_heseg', 'tb_companies.heseg_id', '=', 'tb_heseg.id')
            ->select('tb_companies.*', 'tb_heseg.name')
            ->where("tb_companies.heseg_id", "=", $hesegID)
            ->orderBy('tb_companies.heseg_id', 'asc')
            ->orderBy('tb_companies.companyName', 'asc')
            ->get();
        return $companies;
      }else{
        $companies = DB::table('tb_companies')
            ->join('tb_heseg', 'tb_companies.heseg_id', '=', 'tb_heseg.id')
            ->select('tb_companies.*', 'tb_heseg.name')
            ->orderBy('tb_companies.heseg_id', 'asc')
            ->orderBy('tb_companies.companyName', 'asc')
            ->get();
        return $companies;
      }
    }

    public static function getHesegID(){
        $hesegID = Auth::user()->heseg_id;
        if(Auth::user()->heseg_id >= 1 && Auth::user()->heseg_id <= 3 ){
          $tbHeseg = DB::table('tb_heseg')
              ->where("tb_heseg.id", "=", $hesegID)
              ->get();
              return $tbHeseg;
        }else{
          $tbHeseg = DB::table('tb_heseg')
              ->get();
              return $tbHeseg;
        }



    }

    public function showSlider(){
        return view('companySlider.companySliderShow');
    }

    public function index(){
        return view('company.companies');
    }

    public function getCompanyToNew(){
        $companies = DB::table('tb_companies')
        ->get();
        return DataTables::of($companies)
            ->make(true);
    }

    public function getCompanyByID(Request $req){
        $company = DB::table('tb_companies')
            ->where('tb_companies.id', '=', $req->id)
            ->get();
        return $company;
    }

    public function delete(Request $req){
        $company = company::find($req->id);
        $company->delete();
        $planWork = new planController;
        $planWork->deletePlanByCompany($req->id);

        $exec = new ExecutionContoller;
        $exec->execDeleteByCompany($req->id);

        $log = new logsController;
        $log->insertTableLog($req->ip(), Auth::user()->name, "Өгөгдөл устгав", "Компани", $req->comName, "");

        return "Амжилттай устгалаа.";

    }
    public function storeWorks(Request $req){
      $comID=0;
      if($req->companyID == 0)
      {
        $company = new company;
        $company->companyName = $req->companyName;
        $company->heseg_id = $req->heseg_id;
        $company->ajliinHeseg = $req->ajliinHeseg;
        $company->gereeOgnoo = $req->gereeOgnoo;
        $company->daraalal = $req->daraalal;
        $company->save();
        $comID = $company->id;
        $log = new logsController;
        $log->insertTableLog($req->ip(), Auth::user()->name, "Өгөгдөл оруулсан", "Компани", $req->companyName, "");
      }
      else {
        $comID = $req->companyID;
      }
      $planWork = new planController;
      $planWork->storePlanByWorkID($req->json, $comID, $req->ip(), "add");


      return $comID;
    }
    public function updateWorks(Request $req)
    {
      $company = company::find($req->companyID);
      $company->companyName = $req->companyName;
      $company->heseg_id = $req->heseg_id;
      $company->ajliinHeseg = $req->ajliinHeseg;
      $company->gereeOgnoo = $req->gereeOgnoo;
      $company->daraalal = $req->daraalal;
      $company->save();

      $log = new logsController;
      $log->insertTableLog($req->ip(), Auth::user()->name, "Өгөгдөл зассан", "Компани",
            $req->companyName.", ".$req->companyName.", ".$req->ajliinHeseg.", ".$req->gereeOgnoo, "");

      $planWork = new planController;
      $planWork->deletePlanByWorkTypeAndCompany($req->workTypeID, $req->companyID);
      $planWork->storePlanByWorkID($req->json, $req->companyID, $req->ip(), "edit");

      return "Амжилттай заслаа.";
    }


    // davaanyam uusegsen start
    public static function getCompany(){
        $companies = DB::table('tb_companies')
        // ->where("heseg_id", "=", Auth::user()->heseg_id)
        ->get();
        return $companies;
    }

    public static function getCompanyByHeseg($hesegID){
        $companiesHeseg = DB::table('tb_companies')
        ->where('tb_companies.heseg_id', '=', $hesegID)
        ->get();
        return $companiesHeseg;
    }



    // davaanyam uusegsen end

}
