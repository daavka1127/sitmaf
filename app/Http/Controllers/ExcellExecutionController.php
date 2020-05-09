<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\ExecutionImport;

class ExcellExecutionController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function showExcelHeader($heseg1, $wType){
        $allHeseg = DB::table("tb_heseg")->get();
        $workTypes = DB::table("tb_work_type")->get();
        return view("excel.excelHeaderExecution", compact("heseg1", "allHeseg", "workTypes", "wType"));
    }

    public function showExcelUpload(){
        $allHeseg = DB::table("tb_heseg")->get();
        return view("excel.excelExecUpload", compact("allHeseg"));
    }

    public static function getWorks($workType){
        $works = DB::table('tb_work')
            ->where('work_type_id', '=', $workType)
            ->orderBy('daraalal', 'ASC')
            ->get();
        return $works;
    }

    public function storeExec(Request $req){
        DB::table("tb_excel_exec")->truncate();
        Excel::import(new ExecutionImport($req->date),request()->file('file'));
        $errorRows = DB::table('tb_excel_exec')
            ->get();
        return view('excel.excelExecUpload', compact("errorRows"));
    }
}
