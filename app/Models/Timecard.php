<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Timecard extends Model
{
  use HasFactory;
  public $timestamps = false;

  public static function getCalendar($datatimecard)
  {
    $lista_giorni = config('settings.lista_giorni');
    //die($datatimecard);

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

      
      $dates_month[$i] = array('label'=>$dateL,'value'=>$dateV,'numberday'=>$numberday,'nameabbday'=>$nameabbday,'nameday'=>$nameday);	
      
      // memorizza le time card per ogni data
      $foo = Timecard::select('timecards.*','projects.title AS project')
      ->orderBy('dateins', 'ASC')
      ->where('dateins','=',$dateV)
      ->join('projects', 'timecards.project_id', '=', 'projects.id')
      ->get();

      $times = array();
      foreach ($foo AS $key=>$value) {	
        $id_project_used[$value->project_id] = $value->project;
        $tottimes[] = $value->worktime;
        $times[] = $value->worktime;							
      }

      $timecards[$dateV]['timecards'] = $foo;
			$timecards_total[$dateV] = sumTheTime($times);		
      
    }

    $timecards_total_time = sumTheTime($tottimes);
  
    return array($dates_month,$timecards,$timecards_total,$timecards_total_time,$id_project_used);

  }

  public static function checkIfTimecardExist($user_id,$project_id,$dateins,$starttime,$endtime,$id)
  {

    /*
    $user_id = 1;
    $project_id = 2;
    $dateins = '2023-07-05';
    $starttime = '16:00:00';
    $endtime = '18:00:00';
    $id='3';

    echo '<br>user_id: '.$user_id;
    echo '<br>project_id: '.$project_id;
    echo 'dateins: '.$dateins;
    echo 'starttime: '.$starttime;
    echo 'endtime: '.$endtime;
    echo '<br>id '.$id;
    */

    $timecard = Timecard::where('dateins','=',$dateins)
    ->where('user_id','=',$user_id)
    ->when($id,function ($query, $id) {
      $query->where('id','><',$id);
    })
    ->where(function($query) use($starttime,$endtime) {
      $query->whereRaw('? BETWEEN starttime AND endtime', [$starttime]);
      $query->orwhereRaw('? BETWEEN starttime AND endtime', [$endtime]);
      $query->orwhereBetween('starttime', [$starttime,$endtime]);
      $query->orwhereBetween('endtime', [$starttime,$endtime]);
    })
    ->first();

    //dd($timecard);
    
    $match = 1;
    if (isset($timecard->id) && $timecard->id > 0) {
			if ($starttime == $timecard->endtime && $endtime > $timecard->endtime) {
				$match = 0;
			}
			if ($endtime == $timecard->starttime && $endtime < $timecard->endtime) {
				$match = 0;
			}
    return ($match == 1 ? true : false);
		}
    
  }

}
