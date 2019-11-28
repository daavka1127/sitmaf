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
        if(Auth::user()->heseg_id == 0){
            $companies = DB::table('tb_companies')->get();
        }else{
            $companies = DB::table('tb_companies')
                ->where('tb_companies.heseg_id', '=', Auth::user()->heseg_id)
                ->get();
        }
        return view('hunHuch.hunHuchShow', compact('companies'));
    }

    public function getHunHuchToNew(){
        $hunHuchs = DB::table('tb_hunhuch')
            ->join('tb_companies', 'tb_hunhuch.companyID', '=', 'tb_companies.id')
            ->select('tb_hunhuch.*', 'tb_companies.companyName')
            ->get();
        return DataTables::of($hunHuchs)
            ->make(true);
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
        $hunHuch->companyID = $req->companyID;
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
}
