<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\guitsetgel;
use DB;
use Illuminate\Support\Facades\Auth;

class guitsetgelChartController extends Controller
{
  public function __construct()
  {
      $this->middleware('auth');
  }
    public function getCompaniesChart(Request $req){
        if($req->id>0 && $req->id<4){
            $companies = DB::table('tb_companies')
                ->where('tb_companies.heseg_id', '=', $req->id)
                ->get();
        }
        else{
          $companies = DB::table('tb_companies')->get();
        }
        return view('chart.guitsetgelAllChart', compact('companies'));
    }

    public function getCompaniesChartHorizontal(Request $req){
        $companies = DB::table('tb_companies')
            ->get();
        return view('chart.guitsetgelAllChartHorizontal', compact('companies'));
    }

    public function chartAllReact(Request $req){
      $companies = DB::table('tb_companies')
          ->get();
      return view('chart.guitsetgelReact', compact('companies'));
    }

    public function chartAlljqChart($hesegID){
        if(Auth::user()->heseg_id > 0 && Auth::user()->heseg_id < 4){
          $hesegs = DB::table('tb_heseg')
              ->where('id', '=', Auth::user()->heseg_id)
              ->get();
        }
        else{
            $hesegs = DB::table('tb_heseg')->get();
        }

        if(Auth::user()->heseg_id > 0 && Auth::user()->heseg_id < 4){
            $companiesChart = DB::table('tb_companies')
                ->where('heseg_id', '=', Auth::user()->heseg_id)
                ->get();
        }
        else{
            $companiesChart = DB::table('tb_companies')
                ->get();
        }

        if($hesegID != 4)
          $hesegCompanies = DB::table('tb_companies')
            ->where('heseg_id', '=', $hesegID)
            ->get();
        else {
          $hesegCompanies = DB::table('tb_companies')
              ->get();
        }

        return view('chart.guitsetgelAllChartJqChart', compact('companiesChart', 'hesegID', 'hesegs', 'hesegCompanies'));
    }

    public static function getLastGenrateDate(){
      $getDate = DB::table('tb_reporttime')
          ->where("id", "=", 1)
          ->get();
          return $getDate;
    }
}
