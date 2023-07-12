<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;

use Illuminate\Http\Request;
use App\Http\Requests\TimecardRequest;


use App\Models\Timecard;
use App\Models\Project;



use App\Http\Requests\TimecarsRequest;

use Carbon\Carbon;


class TimecardsController extends Controller
{
  function index(Request $request)
  {

    if ($request->session()->missing('timecards datatimecard')) $request->session()->put('timecards datatimecard', date('d/m/Y'));
    if (request()->input('datatimecard')) {
      $request->session()->put('timecards datatimecard',  request()->input('datatimecard') );
    }
    if ($request->session()->has('timecards datatimecard')) {
      $datatimecardIta = $request->session()->get('timecards datatimecard');
      $datatimecardIso = Carbon::createFromFormat('d/m/Y', $datatimecardIta)->format('Y-m-d');
    }

    // preleva tutti i progetti
    $projects = Project::orderBy('ordering', 'DESC')->get();

    list($dates_month,$timecards,$timecards_total,$timecards_total_time,$id_project_used) = Timecard::getCalendar($datatimecardIso);

    $appCssLinks = array('<link rel="stylesheet" href="/plugins/tempus-dominus/css/tempus-dominus.min.css"/>');

    $appJavascriptLinks = array(
      '<script src="/plugins/moment/js/moment-with-locales.min.js"></script>',
      '<script src="/plugins/tempus-dominus/js/tempus-dominus.min.js"></script>',
      '<script src="js/modules/timecards.index.20230608.js"></script>'
    );

    $appJavascriptBodyCode = "defaultdatatimecard ='".$datatimecardIta."';";
    $appJavascriptBodyCode .= "defaultnewtimecarddata ='".$datatimecardIta."';";
    $appJavascriptBodyCode .= "defaultnewtimecardstarttime ='09:00';";
    $appJavascriptBodyCode .= "defaultnewtimecardendtime ='18:00';";


    return view('timecards.index', ['timecards' => $timecards])
      ->with('projects', $projects)
      ->with('dates_month', $dates_month)
      ->with('timecards_total', $timecards_total)
      ->with('timecards_total_time', $timecards_total_time)
      ->with('id_project_used', $id_project_used)
      ->with('datatimecardIso', $datatimecardIso)
      ->with('datatimecardIta', $datatimecardIta)
      ->with('appCssLinks', $appCssLinks)
      ->with('appJavascriptBodyCode', $appJavascriptBodyCode)
      ->with('appJavascriptLinks', $appJavascriptLinks);
  
   
  }

  public function store(TimecardRequest $request)
  {
    $timecard = new Timecard;
    /*
    $timecard->title = $request->input('title');
    $timecard->active = $request->input('active');
    $timecard->ordering = $request->input('ordering');
    $timecard->status = $request->input('status');
    */
    
    $dateins = Carbon::createFromFormat('d/m/Y', $request->input('newtimecarddata'))->format('Y-m-d');
    $timecard->dateins = $dateins;
    
    $starttime = $request->input('newtimecardstarttime').':00';
    $timecard->starttime = $starttime;

    $endtime = $request->input('newtimecardendtime').':00';
    $timecard->endtime = $endtime;


    $ts = Carbon::parse($starttime);
    $te = Carbon::parse($endtime);
    $worktime = $te->diff($ts)->format('%H:%I:%S');
    $timecard->worktime = $worktime;


    $timecard->user_id = auth()->user()->id;
    $timecard->project_id = $request->input('project_id');
    $timecard->content = $request->input('content');



    //dd($timecard);

    $timecard->save();

    return to_route('timecards.index')->with('success', 'Timecard inserita!');
  }

}
