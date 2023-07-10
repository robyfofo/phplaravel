<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;

use Illuminate\Http\Request;


use App\Models\Timecard;

use App\Http\Requests\TimecarsRequest;


class TimecardsController extends Controller
{
  function index(Request $request)
  {

    list($dates_month,$timecards,$timecards_total,$timecards_total_time,$id_project_used) = Timecard::getCalendar();

    $appJavascriptLinks = array('<script src="js/modules/projects.index.20230608.js"></script>');

    return view('timecards.index', ['timecards' => $timecards])
      ->with('dates_month', $dates_month)
      ->with('timecards_total', $timecards_total)
      ->with('timecards_total_time', $timecards_total_time)
      ->with('id_project_used', $id_project_used);
  
   
  }
}
