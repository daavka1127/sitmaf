<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\company;
use DB;
use Yajra\DataTables\DataTables;

class companyController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(){
        return view('company.companies');
    }

    public function getCompanyToNew(){
        $companies = DB::table('tb_companies')->get();
        $companies1 = DB::table('tb_companies')->get();
        return DataTables::of($companies)
            ->make(true);
    }

    public function store(Request $req){
        // $validator = Validator::make($req->all(), [
        //     'companyName' => 'required|unique:tb_companies|max:250',
        //     'ajliinHeseg' => 'required|unique:tb_companies|max:150',
        //     'gereeOgnoo' => 'required|date',
        //     'hunHuch' => 'required',
        //     'mashinTehnik' => 'required',
        // ]);
        // if ($validator->fails()) {
        //
        //     if($req->ajax())
        //     {
        //         return response()->json(array(
        //             'success' => false,
        //             'message' => 'There are incorect values in the form!',
        //             'errors' => $validator->getMessageBag()->toArray()
        //         ), 422);
        //     }
        //
        //     $this->throwValidationException(
        //
        //         $req, $validator
        //
        //     );
        //     return;
        // }
        $company = new company;
        $company->companyName = $req->companyName;
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
        $company->gHursHuulalt = $req->gHursHuulalt;
        $company->gDalan = $req->gDalan;
        $company->gUhmal = $req->gUhmal;
        $company->gSuuriinUy = $req->gSuuriinUy;
        $company->gShuuduu = $req->gShuuduu;
        $company->gUhmaliinHamgaalalt = $req->gUhmaliinHamgaalalt;
        $company->gUuliinShuuduu = $req->gUuliinShuuduu;
        $company->save();
        return "Амжилттай хадгаллаа.";
    }


}
