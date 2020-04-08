<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\guitsetgel;
use DB;
use Yajra\DataTables\DataTables;

class GuitsetgelController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(){
        $companies = DB::table('tb_companies')->get();
        // $companies  =DB::SELECT("SELECT * FROM tb_companies")->get();

        return view('guitsetgel.guitsetgelShow', compact('companies'));
    }

    public function getCompanyToNew(){
        $guitsetgel = DB::table('tb_guitsetgel')
            ->join('tb_companies', 'tb_guitsetgel.companyID', '=','tb_companies.id')
            ->select('tb_guitsetgel.*', 'tb_companies.companyName', 'tb_companies.hursHuulalt', 'tb_companies.dalan',
            'tb_companies.uhmal', 'tb_companies.suuriinUy', 'tb_companies.shuuduu', 'tb_companies.uhmaliinHamgaalalt',
            'tb_companies.uuliinShuuduu')
            ->get();
        return DataTables::of($guitsetgel)
            ->make(true);
    }

    public function getCompanyGuitsetgelTable(){
        $companies = DB::table('tb_companies')
            ->orderby('heseg_id', 'DESC')
            ->get();
        $companies1 = DB::table('tb_companies')
            ->where('heseg_id', '=', 1)
            ->get();
        $companies2 = DB::table('tb_companies')
            ->where('heseg_id', '=', 2)
            ->get();
        $companies3 = DB::table('tb_companies')
            ->where('heseg_id', '=', 3)
            ->get();

        return view('report.companyGuitsetgelt', compact('companies', 'companies1', 'companies2', 'companies3'));
    }

    public static function getCompanyRow($companyID){
        $company = DB::table('tb_companies')
            ->where('id', '=', $companyID)
            ->select('tb_companies.*', DB::raw('(SELECT tb_guitsetgel.gHursHuulalt FROM tb_guitsetgel WHERE tb_guitsetgel.companyID = tb_companies.id ORDER BY tb_guitsetgel.ognoo DESC LIMIT 1) as gHursHuulalt'),
            DB::raw('(SELECT tb_guitsetgel.gDalan FROM tb_guitsetgel WHERE tb_guitsetgel.companyID = tb_companies.id ORDER BY tb_guitsetgel.ognoo DESC LIMIT 1) as gDalan'),
            DB::raw('(SELECT tb_guitsetgel.gUhmal FROM tb_guitsetgel WHERE tb_guitsetgel.companyID = tb_companies.id ORDER BY tb_guitsetgel.ognoo DESC LIMIT 1) as gUhmal'),
            DB::raw('(SELECT tb_guitsetgel.gSuuriinUy FROM tb_guitsetgel WHERE tb_guitsetgel.companyID = tb_companies.id ORDER BY tb_guitsetgel.ognoo DESC LIMIT 1) as gSuuriinUy'),
            DB::raw('(SELECT tb_guitsetgel.gShuuduu FROM tb_guitsetgel WHERE tb_guitsetgel.companyID = tb_companies.id ORDER BY tb_guitsetgel.ognoo DESC LIMIT 1) as gShuuduu'),
            DB::raw('(SELECT tb_guitsetgel.gUhmaliinHamgaalalt FROM tb_guitsetgel WHERE tb_guitsetgel.companyID = tb_companies.id ORDER BY tb_guitsetgel.ognoo DESC LIMIT 1) as gUhmaliinHamgaalalt'),
            DB::raw('(SELECT tb_guitsetgel.gUuliinShuuduu FROM tb_guitsetgel WHERE tb_guitsetgel.companyID = tb_companies.id ORDER BY tb_guitsetgel.ognoo DESC LIMIT 1) as gUuliinShuuduu'),
            DB::raw('(SELECT tb_hunhuch.hunHuch FROM tb_hunhuch WHERE tb_hunhuch.companyID = tb_companies.id ORDER BY tb_hunhuch.ognoo DESC LIMIT 1) as hunHuch'),
            DB::raw('(SELECT tb_hunhuch.mashinTehnik FROM tb_hunhuch WHERE tb_hunhuch.companyID = tb_companies.id ORDER BY tb_hunhuch.ognoo DESC LIMIT 1) as mashinTehnik'))
            ->first();
        return $company;
    }

    public static function getGuitsetgelTable($companyID){
        $guitsetgelt = DB::table('tb_guitsetgel')
            ->where('tb_guitsetgel.companyID', '=', $companyID)
            ->orderBy('tb_guitsetgel.ognoo', 'desc')
            ->first();
        return $guitsetgelt;
    }

    public function store(Request $req){

        $guitsetgel = new guitsetgel;
        $guitsetgel->companyID = $req->companyID;
        $guitsetgel->gHursHuulalt = $req->gHursHuulalt;
        $guitsetgel->gDalan = $req->gDalan;
        $guitsetgel->gUhmal = $req->gUhmal;
        $guitsetgel->gSuuriinUy = $req->gSuuriinUy;
        $guitsetgel->gShuuduu = $req->gShuuduu;
        $guitsetgel->gUhmaliinHamgaalalt = $req->gUhmaliinHamgaalalt;
        $guitsetgel->gUuliinShuuduu = $req->gUuliinShuuduu;
        $guitsetgel->ognoo = $req->ognoo;
        $guitsetgel->save();
        return "Амжилттай хадгаллаа.";
    }

    public function update(Request $req){
        $guitsetgel = guitsetgel::find($req->id);
        $guitsetgel->companyID = $req->companyID;
        $guitsetgel->gHursHuulalt = $req->gHursHuulalt;
        $guitsetgel->gDalan = $req->gDalan;
        $guitsetgel->gUhmal = $req->gUhmal;
        $guitsetgel->gSuuriinUy = $req->gSuuriinUy;
        $guitsetgel->gShuuduu = $req->gShuuduu;
        $guitsetgel->gUhmaliinHamgaalalt = $req->gUhmaliinHamgaalalt;
        $guitsetgel->gUuliinShuuduu = $req->gUuliinShuuduu;
        $guitsetgel->ognoo = $req->ognoo;
        $guitsetgel->save();
        return "Амжилттай заслаа.";
//        return $req->id;
    }

    public function delete(Request $req){
        $guitsetgel = guitsetgel::find($req->id);
        $guitsetgel->delete();
        return "Амжилттай устгалаа.";
    }

    public function chartAllShow(){
        $companies = DB::table('tb_companies')->get();
        return view('chart.guitsetgelAllChart', compact('companies'));
    }

    public function chartByDateShow($companyID, $workTypeID){
        $datas = DB::table('tb_execution')
          ->join("tb_work","tb_execution.work_id","=","tb_work.id")
          ->select('tb_execution.work_id', 'tb_work.name as nameExec', 'tb_execution.companyID',
                  'tb_execution.work_type_id', DB::raw('SUM(tb_execution.execution) as execution'))
          ->where('companyID', '=', $companyID)
          ->where('tb_execution.work_type_id', '=', $workTypeID)
          ->groupBy('work_id','tb_work.name','tb_execution.companyID', 'tb_execution.work_type_id')
          ->get();

        $planDatas = DB::table('tb_plan');


        $companies = DB::table('tb_companies')->get();
        // //return $guitsetgel->hursHuulalt;
         return view('chart.showCharts', compact('datas', 'companies', 'companyID', 'workTypeID'));
    }
    public static function getWorkExecution($companyID, $work_id)
    {
        $datas = DB::table('tb_execution')
        ->where('companyID','=',$companyID)
        ->where('work_id', '=', $work_id)
        ->orderBy('date', 'desc')
        ->get();

        return $datas;
    }
    public static function getSumWorkExecution($companyID, $work_id)
    {
      $datas = DB::table('tb_execution')
      ->join('tb_work', 'tb_execution.work_id', '=', 'tb_work.id')
      ->select(DB::raw('SUM(tb_execution.execution) as execution'), 'tb_work.name as workName')
      ->where('tb_execution.companyID','=',$companyID)
      ->where('tb_execution.work_id', '=', $work_id)
      ->groupBy('tb_work.name')
      ->first();

      return $datas;
    }

    public static function getGuitsetgelHuvi($companyID){


          $plan = DB::table("tb_plan")
            ->where("companyID","=",$companyID)
            ->sum("quantity");
          $exec = DB::table("tb_execution")
            ->where("companyID","=",$companyID)
            ->sum("execution");

          $execPercent = 0;
            if($plan != 0)
              $execPercent = ($exec*100/$plan);

        return $execPercent;
    }

    public static function getPlans($comID, $workTypeID)
    {
      $plans = DB::table('tb_plan')
        ->join('tb_work', 'tb_work.id', '=', 'tb_plan.work_id')
        ->select('tb_plan.*', 'tb_work.name as workName')
        ->where('tb_plan.companyID', '=', $comID)
        ->where('tb_plan.work_type_id', '=', $workTypeID)
        ->get();
        // dd($plans);
        return $plans;
    }

    public static function generalChart($hesegID){
        $count = 0;
        $dundajHuvi = null;

        if($hesegID == 4){
            $companies = DB::table('tb_companies')->get();
        }
        else{
            $companies = DB::table('tb_companies')
                ->where('heseg_id', '=', $hesegID)
                ->get();
        }

        foreach($companies as $company){
            $dundaj = self::getGuitsetgelHuvi($company->id);
            $dundajHuvi = $dundajHuvi + $dundaj;
            $count++;
        }

        $dundajHuvi = $dundajHuvi / $count;
        return round($dundajHuvi, 2);
    }
}
