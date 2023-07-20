<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

use App\Models\Timecard;

use Carbon\Carbon;

class Project extends Model
{
    use HasFactory;

    protected $appends = ['worktime'];

    public function getWorktimeAttribute()
    {
      $foo = Timecard::select(DB::raw('SEC_TO_TIME( SUM( TIME_TO_SEC( `worktime` ) ) ) AS timeSum'))->where('project_id','=',$this->id)->get();
      //dd($foo);
      return $foo[0]->timeSum;
    }

    public static function getprojecttimecardsum($id)
    {
      $foo = Timecard::select(DB::raw('SEC_TO_TIME( SUM( TIME_TO_SEC( `worktime` ) ) ) AS timeSum'))->where('project_id','=',$id)->get();
      //dd($foo);
      return $foo[0]->timeSum;
    }

    public static function getprojecttimecardsummc($id)
    {
      $date = date('Y-m');
      $foo = Timecard::select(DB::raw('SEC_TO_TIME( SUM( TIME_TO_SEC( `worktime` ) ) ) AS timeSum'))->where('project_id','=',$id)
      ->where('timecards.dateins','LIKE',$date.'%')->get();
      //dd($foo);
      return $foo[0]->timeSum;
    }
    public static function getprojecttimecardsummp($id)
    {
      $date = Carbon::parse(date('Y-m-d'));
      $date = $date->subMonth()->format('Y-m');
      $foo = Timecard::select(DB::raw('SEC_TO_TIME( SUM( TIME_TO_SEC( `worktime` ) ) ) AS timeSum'))->where('project_id','=',$id)
      ->where('timecards.dateins','LIKE',$date.'%')->get();
      //dd($foo);
      return $foo[0]->timeSum;
    }
}
