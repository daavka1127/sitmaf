<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use File;

class reportController extends Controller
{
  public function __construct()
  {
      $this->middleware('auth');
  }
    public function generateHtml(){
      File::put('test.html',
          view('report.companyTableReport')
              ->render()
      );
    }
}
