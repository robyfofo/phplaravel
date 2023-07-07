<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Timecard extends Model
{
  use HasFactory;

  protected $appends = ['level'];

  public static function getCalendar()
  {


    $lista_giorni = config('settings.lista_giorni');

    $datatimecard = date('Y-m-d');
    $data = \DateTime::createFromFormat('Y-m-d', $datatimecard);
    $month = $data->format('m');
    $year = $data->format('Y');
    $num = cal_days_in_month(CAL_GREGORIAN, $month, $year);

    //echo $num;
    $dates_month = array();
    $tottimes = array();
    $times = array();
    $id_project_used = array();
    for ($i = 1; $i <= $num; $i++) {
      $data1 = \DateTime::createFromFormat('Y-m-d', $year . '-' . $month . '-' . $i);
      $dateL = $data1->format('d/m/Y');
      $dateV = $data1->format('Y-m-d');
      $numberday = $data1->format('w');
      $nameday = $lista_giorni[$numberday];
      $nameabbday = ucfirst((strlen($nameday) > 3 ? mb_strcut($nameday,0,3) : $nameday));
/*
      echo $dateL.' - ';
      echo $dateV.' - ';
      echo $numberday.' - ';
      echo $nameday.' - ';

      echo '<br>';
*/
      
      $dates_month[$i] = array('label'=>$dateL,'value'=>$dateV,'numberday'=>$numberday,'nameabbday'=>$nameabbday,'nameday'=>$nameday);	
      
      // memorizza le time card per ogni data
      $foo = Timecard::orderBy('dateins', 'ASC')->where('dateins','=',$dateV)->get();
      $times = array();
      foreach ($foo AS $key=>$value) {	
        //$id_project_used[$value->id_project] = $value->project;
        $tottimes[] = $value->worktime;
        $times[] = $value->worktime;							
      }

      $timecards[$dateV]['timecards'] = $foo;
			$timecards_total[$dateV] = sumTheTime($times);		
      
    }
    
    //dd($times);
    dd($timecards_total);

    //return array($dates_month,$timecards,$timecards_total,$timecards_total_time,$id_project_used);

    /*
			
			//$mktime = mktime(0, 0, 0, $month, $i, $year);
			
			
			$where = "dateins = '".$dateV."'";
			if (isset($_SESSION[$sessionName]['id_project']) && $_SESSION[$sessionName]['id_project'] > 0) $where .= " AND id_project = '".intval($_SESSION[$sessionName]['id_project'])."'";
			Sql::initQuery(Config::$DatabaseTablesOptions['timecard']['name'].' AS t LEFT JOIN '.Config::$DatabaseTablesOptions['projects']['name'].' AS p ON (t.id_project = p.id)',array('t.*,p.title AS project'),array(),$where);
			Sql::setOrder('starttime ASC');
			$obj = Sql::getRecords();

			if (is_array($obj) && count($obj) > 0) {
				foreach ($obj AS $key=>$value) {	
					$id_project_used[$value->id_project] = $value->project;
					$tottimes[] = $value->worktime;
					$times[] = $value->worktime;							
				}
			}				
			$timecards[$dateV]['timecards'] = $obj;
			$timecards_total[$dateV] = DateFormat::sumTheTime($times);
		}
		$timecards_total_time = DateFormat::sumTheTime($tottimes);
		return array($dates_month,$timecards,$timecards_total,$timecards_total_time,$id_project_used);

        */


































    //
    $result = Timecard::orderBy('dateins', 'ASC')->get();


    return $result;
  }




  public function getLevelAttribute()
  {
    return 'aaaaa';
  }
}
