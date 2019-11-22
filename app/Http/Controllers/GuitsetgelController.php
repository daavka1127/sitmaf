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
}
