<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\hunHuch;
use DB;
use Yajra\DataTables\DataTables;
use Auth;

class hunHuchController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(){
        if(Auth::user()->heseg_id == 5){
            $companies = DB::table('tb_companies')
                ->orderby('ajliinHeseg', 'ASC')
                ->get();
        }else{
            $companies = DB::table('tb_companies')
                ->where('tb_companies.heseg_id', '=', Auth::user()->heseg_id)
                ->orderby('ajliinHeseg', 'ASC')
                ->get();
        }
        return view('hunHuch.hunHuchShow', compact('companies'));
    }

    public function getHunHuchToNew(){
        if(Auth::user()->heseg_id == 5){
            $hunHuchs = DB::table('tb_hunhuch')
                ->join('tb_companies', 'tb_hunhuch.companyID', '=', 'tb_companies.id')
                ->select('tb_hunhuch.*', 'tb_companies.companyName', 'tb_companies.ajliinHeseg')
                ->orderby('tb_hunhuch.ognoo', 'DESC')
                ->orderby('tb_companies.companyName', 'ASC')
                ->get();
        }
        else{
            $hunHuchs = DB::table('tb_hunhuch')
                ->join('tb_companies', 'tb_hunhuch.companyID', '=', 'tb_companies.id')
                ->select('tb_hunhuch.*', 'tb_companies.companyName')
                ->where('tb_companies.heseg_id', '=', Auth::user()->heseg_id)
                ->orderby('tb_hunhuch.ognoo', 'DESC')
                ->orderby('tb_companies.companyName', 'ASC')
                ->get();
        }
        return DataTables::of($hunHuchs)
            ->make(true);
    }

    public function getOneCompanyHunhuch(Request $req){
      $exec = DB::table("tb_hunhuch")
        ->join('tb_companies', 'tb_hunhuch.companyID', '=', 'tb_companies.id')
        ->select('tb_hunhuch.*', 'tb_companies.companyName')
        ->where("tb_hunhuch.companyID", "=", $req->comID)
        ->get();
        return DataTables::of($exec)
            ->make(true);
    }

    public function editOneCompanyHunhuch(Request $req){
      $hunhuchEdit = hunHuch::find($req->hunhuchRowID);
      $hunhuchEdit->hunHuch = $req->hunhuchEditRow;
      $hunhuchEdit->mashinTehnik = $req->texnikEditRow;
      $hunhuchEdit->ognoo = $req->ognooEditRow;
      $hunhuchEdit->save();
      return "Амжилттай заслаа.";
    }

    public function store(Request $req){
        $hunHuch = new hunHuch;
        $hunHuch->companyID = $req->companyID;
        $hunHuch->hunHuch = $req->hunHuch;
        $hunHuch->mashinTehnik = $req->mashinTehnik;
        $hunHuch->ognoo = $req->ognoo;
        $hunHuch->save();
        return "Амжилттай хадгаллаа.";
    }

    public function update(Request $req){
        $hunHuch = hunHuch::find($req->id);
        $hunHuch->hunHuch = $req->hunHuch;
        $hunHuch->mashinTehnik = $req->mashinTehnik;
        $hunHuch->ognoo = $req->ognoo;
        $hunHuch->save();
        return "Амжилттай заслаа.";
    }

    public function delete(Request $req){
        $hunHuch = hunHuch::find($req->id);
        $hunHuch->delete();
        return "Амжилттай устгалаа.";
    }

    public static function getHumanByCompany($companyID){
        $huns = DB::table("tb_hunhuch")
            ->where("companyID", "=", $companyID)
            ->orderBy("ognoo", "DESC")
            ->get();
        if($huns->count() == 0){
            return "";
        }
        else{
            foreach ($huns as $hun) {
                $huna = $hun->hunHuch;
            }
            return $huna;
        }
    }

    public static function getCarByCompany($companyID){
        $huns = DB::table("tb_hunhuch")
            ->where("companyID", "=", $companyID)
            ->orderBy("ognoo", "DESC")
            ->get();
        if($huns->count() == 0){
            return "";
        }
        else{
            foreach ($huns as $hun) {
                $cars = $hun->mashinTehnik;
            }
            return $cars;
        }
    }
}
