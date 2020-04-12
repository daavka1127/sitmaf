<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use File;
use App\Http\Controllers\ReportTimeController;

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
      File::put('test.html',
          view('report.companyTableReport', compact("date"))
              ->render()
      );
      File::put('print.html',
          view('report.printReport', compact("date"))
              ->render()
      );
    }

}
