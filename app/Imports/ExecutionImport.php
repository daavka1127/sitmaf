<?php

namespace App\Imports;

use App\excelTest;
use App\ErrorExcel;
use App\execution;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithStartRow;
use DB;

class ExecutionImport implements ToModel, WithStartRow
{
    private $date;
    public function __construct($date)
    {
        $this->date = $date;
    }
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        $comID = self::getCompanyIDbyCompanyName($row[0], $row[1]);
        $workID = self::getWorkIDbyWorkName($row[2]);
        $exec = floatval($row[4]);
        if($exec == 0){
            return;
        }
        if($comID == 0){
            $errorExcel = new ErrorExcel;
            $errorExcel->company = $row[0];
            $errorExcel->pk = $row[1];
            $errorExcel->work = $row[2];
            $errorExcel->hemjihNegj = $row[3];
            $errorExcel->exec = $row[4];
            $errorExcel->memo = "Гүйцэтгэгч компаний нэр зөрж байна!!!";
            $errorExcel->save();
            return;
        }
        else if($workID == 0){
            $errorExcel = new ErrorExcel;
            $errorExcel->company = $row[0];
            $errorExcel->pk = $row[1];
            $errorExcel->work = $row[2];
            $errorExcel->hemjihNegj = $row[3];
            $errorExcel->exec = $row[4];
            $errorExcel->memo = "Ажлын нэр зөрж байна!!!";
            $errorExcel->save();
            return;
        }
        $nowExec = self::thinkExec($comID, $workID, $exec);
        if($nowExec < 0){
            return;
        }
        if(self::checkExecToPlan($comID, $workID, $nowExec) == false){
            $errorExcel = new ErrorExcel;
            $errorExcel->company = $row[0];
            $errorExcel->pk = $row[1];
            $errorExcel->work = $row[2];
            $errorExcel->hemjihNegj = $row[3];
            $errorExcel->exec = $row[4];
            $errorExcel->memo = $row[0] . " компаний гүйцэтгэл төлөвлөсөн ажлаас давах гэж байна!!!";
            $errorExcel->save();
            return;
        }
        if(self::checkExecToExec($comID, $workID, substr($this->date, 0, 10)) == false){
            $errorExcel = new ErrorExcel;
            $errorExcel->company = $row[0];
            $errorExcel->pk = $row[1];
            $errorExcel->work = $row[2];
            $errorExcel->hemjihNegj = $row[3];
            $errorExcel->exec = $row[4];
            $errorExcel->memo = substr($this->date, 0, 10) . " Энэ өдөр гүйлгээ орсон байна !!!";
            $errorExcel->save();
            return;
        }
        $work_type_id = self::getWorkTypeIDbyWorkID($workID);
        if($nowExec == 0){
            return;
        }
        return new execution([
            'companyID'     => $comID,
            'work_type_id'    => $work_type_id,
            'work_id'    => $workID,
            'execution'    => $nowExec,
            'date'    => $this->date,
        ]);
    }

    public function startRow(): int
    {
        return 2;
    }

    public static function getCompanyIDbyCompanyName($companyName, $pk){
        $companyRow = DB::table('tb_companies')
            ->where('companyName', '=', $companyName)
            ->where('ajliinHeseg', '=', $pk)
            ->get();
        if(count($companyRow) == 0){
            return 0;
        }
        else{
            foreach($companyRow as $company){
                $companyID = $company->id;
            }
            return $companyID;
        }
    }

    public static function getWorkIDbyWorkName($companyName){
        $works = DB::table('tb_work')
            ->where('name', '=', $companyName)
            ->get();
        if(count($works) == 0){
            return 0;
        }
        else{
            foreach($works as $work){
                $workID = $work->id;
            }
            return $workID;
        }
    }

    public static function getWorkTypeIDbyWorkID($workID){
        $worktypeRow = DB::table('tb_work')
            ->where('id', '=', $workID)
            ->get();
        foreach($worktypeRow as $work){
            $workTypeID = $work->work_type_id;
        }
        return $workTypeID;
    }

    public static function checkExecToPlan($comID, $wid, $exec){
        $sumPlan = DB::table('tb_plan')
            ->where('companyID', '=', $comID)
            ->where('work_id', '=', $wid)
            ->sum("quantity");
        if($exec > $sumPlan){
            return false;
        }
        else{
            return true;
        }
    }

    public static function checkExecToExec($comID, $wid, $date){
        $exec = DB::table('tb_execution')
            ->where('companyID', '=', $comID)
            ->where('work_id', '=', $wid)
            ->where('date', '=', $date)
            ->get();
        if(count($exec) == 0){
            return true;
        }
        else{
            return false;
        }
    }

    public static function thinkExec($comID, $wid, $nowExec){
        $prevExec = DB::table('tb_execution')
            ->where('companyID', '=', $comID)
            ->where('work_id', '=', $wid)
            ->sum("execution");
        return number_format($nowExec - $prevExec, 2, '.', '');
    }
}
