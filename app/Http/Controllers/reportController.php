<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use File;
use App\Http\Controllers\ReportTimeController;
use Illuminate\Support\Facades\Auth;
use DB;

class reportController extends Controller
{
  public function __construct()
  {
      $this->middleware('auth');
  }
    public function generateHtml(Request $req){
      $reportTime = new ReportTimeController;
      $reportTime->updateDate($req->lastDate);
      $date=$req->lastDate;
      $companies = DB::table('tb_companies')
      ->get();
      if(Auth::user()->heseg_id > 0 && Auth::user()->heseg_id < 4){
          $companies = DB::table('tb_companies')
              ->where('heseg_id', '=', Auth::user()->heseg_id)
              ->get();
          if(Auth::user()->heseg_id == 1){
              File::put('heseg1.html',
                  view('report.companyTableReport', compact("date", "companies"))
                      ->render()
              );
          }
          else if(Auth::user()->heseg_id == 2){
              File::put('heseg2.html',
                  view('report.companyTableReport', compact("date", "companies"))
                      ->render()
              );
          }
          else if(Auth::user()->heseg_id == 3){
            File::put('heseg3.html',
                view('report.companyTableReport', compact("date", "companies"))
                    ->render()
            );
          }
      }
      else{
          $companies = DB::table('tb_companies')
              ->get();

          File::put('all.html',
              view('report.companyTableReport', compact("date", "companies"))
                  ->render()
          );
      }
      File::put('print.html',
          view('report.printReport', compact("date"))
              ->render()
      );
    }


}
