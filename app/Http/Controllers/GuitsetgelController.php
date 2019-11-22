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

        return view('guitsetgel.guitsetgelShow', compact('companies'));
    }

    public function getCompanyToNew(){
        $guitsetgel = DB::table('tb_guitsetgel')
        ->join('tb_companies', 'tb_guitsetgel.companyID', '=','tb_companies.id')
        ->select('tb_guitsetgel.*', 'tb_companies.companyName')
        ->get();
        return DataTables::of($guitsetgel)
            ->make(true);
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

    public function chartByDateShow($companyID){
        $datas = DB::table('tb_guitsetgel')
        ->where('companyID','=',$companyID)->get();
        return view('chart.guitsetgelByDateChart', compact('datas'));
    }

    public static function getGuitsetgelHuvi($companyID){
        $guitsetgel = DB::table('tb_guitsetgel')
            ->where('companyID', '=', $companyID)
            ->orderBy('ognoo', 'desc')
            ->first();
        $company = DB::table('tb_companies')
            ->where('id', '=', $companyID)
            ->first();
        $guitsetgelHursHuulalt = null;
        $guitsetgelDalan = null;
        $guitsetgelUhmal = null;
        $guitsetgelSuuriinUy = null;
        $guitsetgelShuuduu = null;
        $guitsetgelUhmaliinHamgaalalt = null;
        $guitsetgelUuliinShuuduu = null;
        $dundaj = null;
        $i=0;
        if($guitsetgel == null){
          return 0;
        }
        if($company->hursHuulalt != null && $guitsetgel->gHursHuulalt != null){
            $guitsetgelHursHuulalt = $guitsetgel->gHursHuulalt * 100 / $company->hursHuulalt;
            $i++;
        }
        if($company->dalan != null && $guitsetgel->gDalan != null){
            $guitsetgelDalan = $guitsetgel->gDalan * 100 / $company->dalan;
            $i++;
        }
        if($company->uhmal != null && $guitsetgel->gUhmal != null){
            $guitsetgelUhmal = $guitsetgel->gUhmal * 100 / $company->uhmal;
            $i++;
        }
        if($company->suuriinUy != null && $guitsetgel->gSuuriinUy != null){
            $guitsetgelSuuriinUy = $guitsetgel->gSuuriinUy * 100 / $company->suuriinUy;
            $i++;
        }
        if($company->shuuduu != null && $guitsetgel->gShuuduu != null){
            $guitsetgelShuuduu = $guitsetgel->gShuuduu * 100 / $company->shuuduu;
            $i++;
        }
        if($company->uhmaliinHamgaalalt != null && $guitsetgel->gUhmaliinHamgaalalt != null){
            $guitsetgelUhmaliinHamgaalalt = $guitsetgel->gUhmaliinHamgaalalt * 100 / $company->uhmaliinHamgaalalt;
            $i++;
        }
        if($company->uuliinShuuduu != null && $guitsetgel->gUuliinShuuduu != null){
            $guitsetgelUuliinShuuduu = $guitsetgel->gUuliinShuuduu * 100 / $company->uuliinShuuduu;
            $i++;
        }
        $dundaj = ($guitsetgelHursHuulalt + $guitsetgelDalan + $guitsetgelUhmal + $guitsetgelSuuriinUy + $guitsetgelShuuduu + $guitsetgelUhmaliinHamgaalalt + $guitsetgelUuliinShuuduu)/$i;
        return $i;

    }
}
