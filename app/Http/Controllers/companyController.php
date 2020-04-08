<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\company;
use App\Http\Controllers\planController;
use App\Http\Controllers\ExecutionContoller;
use App\plan;
use DB;
use Yajra\DataTables\DataTables;

class companyController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function getCompanies(){
      $companies = DB::table('tb_companies')
          ->join('tb_heseg', 'tb_companies.heseg_id', '=', 'tb_heseg.id')
          ->select('tb_companies.*', 'tb_heseg.name')
          ->orderBy('tb_companies.heseg_id', 'asc')
          ->orderBy('tb_companies.companyName', 'asc')
          ->get();
      return DataTables::of($companies)
            ->make(true);
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

    public function store(Request $req){
        $company = new company;
        $company->companyName = $req->companyName;
        $company->heseg_id = $req->heseg_id;
        $company->ajliinHeseg = $req->ajliinHeseg;
        $company->hursHuulalt = $req->hursHuulalt;
        $company->dalan = $req->dalan;
        $company->uhmal = $req->uhmal;
        $company->suuriinUy = $req->suuriinUy;
        $company->shuuduu = $req->shuuduu;
        $company->uhmaliinHamgaalalt = $req->uhmaliinHamgaalalt;
        $company->uuliinShuuduu = $req->uuliinShuuduu;
        $company->niit = ($req->hursHuulalt + $req->dalan + $req->uhmal + $req->suuriinUy + $req->shuuduu + $req->uhmaliinHamgaalalt + $req->uuliinShuuduu);
        $company->gereeOgnoo = $req->gereeOgnoo;
        $company->hunHuch = $req->hunHuch;
        $company->mashinTehnik = $req->mashinTehnik;
        $company->save();
        return "Амжилттай хадгаллаа.";
    }

    public function update(Request $req){
        $company = company::find($req->id);
        $company->companyName = $req->companyName;
        $company->heseg_id = $req->heseg_id;
        $company->ajliinHeseg = $req->ajliinHeseg;
        $company->hursHuulalt = $req->hursHuulalt;
        $company->dalan = $req->dalan;
        $company->uhmal = $req->uhmal;
        $company->suuriinUy = $req->suuriinUy;
        $company->shuuduu = $req->shuuduu;
        $company->uhmaliinHamgaalalt = $req->uhmaliinHamgaalalt;
        $company->uuliinShuuduu = $req->uuliinShuuduu;
        $company->niit = ($req->hursHuulalt + $req->dalan + $req->uhmal + $req->suuriinUy + $req->shuuduu + $req->uhmaliinHamgaalalt + $req->uuliinShuuduu);
        $company->gereeOgnoo = $req->gereeOgnoo;
        $company->hunHuch = $req->hunHuch;
        $company->mashinTehnik = $req->mashinTehnik;
        $company->save();
        return "Амжилттай заслаа.";
    }

    public function delete(Request $req){
        $company = company::find($req->id);
        $company->delete();
        $planWork = new planController;
        $planWork->deletePlanByCompany($req->id);

        $exec = new ExecutionContoller;
        $exec->execDeleteByCompany($req->id);

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
        $company->hunHuch = $req->hunHuch;
        $company->mashinTehnik = $req->mashinTehnik;
        $company->save();
        $comID = $company->id;
      }
      else {
        $comID = $req->companyID;
      }
      $planWork = new planController;
      $planWork->storePlanByWorkID($req->json, $comID);

      return $comID;
    }
    public function updateWorks(Request $req)
    {
      $company = company::find($req->companyID);
      $company->companyName = $req->companyName;
      $company->heseg_id = $req->heseg_id;
      $company->ajliinHeseg = $req->ajliinHeseg;
      $company->gereeOgnoo = $req->gereeOgnoo;
      $company->hunHuch = $req->hunHuch;
      $company->mashinTehnik = $req->mashinTehnik;
      $company->save();

      $planWork = new planController;
      $planWork->deletePlanByWorkTypeAndCompany($req->workTypeID, $req->companyID);
      $planWork->storePlanByWorkID($req->json, $req->companyID);

      return "Амжилттай заслаа.";
    }


    // davaanyam uusegsen start
    public static function getCompany(){
        $companies = DB::table('tb_companies')
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
