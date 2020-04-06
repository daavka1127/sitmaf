<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use File;

class reportController extends Controller
{
    public function generateHtml(){
      File::put('test.html',
          view('report.companyTableReport')
              ->render()
      );
    }
}
