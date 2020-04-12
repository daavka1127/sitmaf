<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ReportTime;
use Carbon\Carbon;

class ReportTimeController extends Controller
{
    public function updateDate($date){
        $splitDate = explode(' ', $date, 2);
        $startDate = Carbon::parse($date)->subDays(7);
        $reportTime = ReportTime::find(1);
        $reportTime->startDate =$startDate;
        $reportTime->endDate = $date;
        $reportTime->save();
    }

    public static function getLastDate(){
        $reportTime = ReportTime::find(1);
        $splitStartDate = explode(' ',$reportTime->startDate);
        $splitEndDate = explode(' ',$reportTime->endDate);
        return $splitStartDate[0] . '&' . $splitEndDate[0];
    }
}
