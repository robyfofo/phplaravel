<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

use App\Models\Timecard;

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
}
