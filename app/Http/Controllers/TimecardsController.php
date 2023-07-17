<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;

use Illuminate\Http\Request;
use App\Http\Requests\TimecardRequest;


use App\Models\Timecard;
use App\Models\Project;
use App\Models\User;



use App\Http\Requests\TimecarsRequest;

use Carbon\Carbon;


class TimecardsController extends Controller
{

  private $itemsforpage = 10;
  private $page = 1;


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
    $appJavascriptBodyCode .= "defaultdateins ='".$datatimecardIta."';";
    $appJavascriptBodyCode .= "defaultstarttime ='09:00';";
    $appJavascriptBodyCode .= "defaultendtime ='10:00';";


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

    $timecard->user_id = auth()->user()->id;
    $timecard->project_id = $request->input('project_id');
    $timecard->content = $request->input('content');

    $timecard->dateins = Carbon::createFromFormat('d/m/Y', $request->input('dateins'))->format('Y-m-d');
    $timecard->starttime = $request->input('starttime').':00';
    $timecard->endtime = $request->input('endtime').':00';

    // controlla esisteza timecard
    $res = Timecard::checkIfTimecardExist($timecard->user_id,$timecard->project_id,$timecard->dateins,$timecard->starttime,$timecard->endtime,0);
    if ($res == true) {
      return to_route('timecards.index')->with('error', 'Il tempo inserito è gia presente');
    }

    $ts = Carbon::parse($timecard->starttime);
    $te = Carbon::parse($timecard->endtime);
    // controlla intervallo di tempo
    if ($ts > $te) {
      return to_route('timecards.index')->with('error', 'Il tempo inizio e superiore al tempo di fine');
    }
    $worktime = $te->diff($ts)->format('%H:%I:%S');
    $timecard->worktime = $worktime;

    //dd($timecard);

    $timecard->save();

    return to_route('timecards.index')->with('success', 'Timecard inserita!');
  }

  public function edit(Request $request,$id)
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

    $timecard = Timecard::findOrFail($id);

    $appCssLinks = array('<link rel="stylesheet" href="/plugins/tempus-dominus/css/tempus-dominus.min.css"/>');

    $appJavascriptLinks = array(
      '<script src="/plugins/moment/js/moment-with-locales.min.js"></script>',
      '<script src="/plugins/tempus-dominus/js/tempus-dominus.min.js"></script>',
      '<script src="/js/modules/timecards.index.20230608.js"></script>'
    );

    $appJavascriptBodyCode = "defaultdatatimecard ='".$datatimecardIta."';";
    $dateins = Carbon::createFromFormat('Y-m-d', $timecard->dateins)->format('d/m/Y');
    $appJavascriptBodyCode .= "defaultdateins ='".$dateins."';";
    $appJavascriptBodyCode .= "defaultstarttime ='".$timecard->starttime."';";
    $appJavascriptBodyCode .= "defaultendtime ='".$timecard->endtime."';";

    return view('timecards.edit', ['timecard' => $timecard])
    ->with('timecards', $timecards)
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

  public function update(TimecardRequest $request, $id)
  {
    $timecard = Timecard::findOrFail($id);
    $timecard->project_id = $request->input('project_id');
    $timecard->content = $request->input('content');

    $timecard->dateins = Carbon::createFromFormat('d/m/Y', $request->input('dateins'))->format('Y-m-d');
    $timecard->starttime = $request->input('starttime').':00';
    $timecard->endtime = $request->input('endtime').':00';

    // controlla esisteza timecard
    $res = Timecard::checkIfTimecardExist($timecard->user_id,$timecard->project_id,$timecard->dateins,$timecard->starttime,$timecard->endtime,$timecard->id);
    if ($res == true) {
      return to_route('timecards.edit', [$timecard->id])->with('error', 'Il tempo inserito è gia presente');
    }

    $ts = Carbon::parse($timecard->starttime);
    $te = Carbon::parse($timecard->endtime);
    // controlla intervallo di tempo
    if ($ts > $te) {
      return to_route('timecards.index')->with('error', 'Il tempo inizio e superiore al tempo di fine');
    }
    $worktime = $te->diff($ts)->format('%H:%I:%S');
    $timecard->worktime = $worktime;

    $timecard->save();

    return to_route('timecards.index')->with('success', 'Timecard modificata!');
  }

  public function destroy($id)
  {
    $timecard = Timecard::findOrFail($id);
    $timecard->delete();
    return to_route('timecards.index')->with('success', 'Timecard cancellata!');
  }

  public function list(Request $request)
  {
    // numero pagine
    if ($request->session()->missing('timecards itemsforpage')) $request->session()->put('timecards itemsforpage', 10);
    if (request()->input('itemsforpage')) $request->session()->put('timecards itemsforpage', request()->input('itemsforpage'));

    $request->session()->put('timecards project_id', '');
    if (request()->input('project_id') != '') $request->session()->put('timecards project_id', request()->input('project_id'));

    $request->session()->put('timecards dateins', '');
    if (request()->input('dateins') != '') $request->session()->put('timecards dateins', request()->input('dateins'));

    $request->session()->put('timecards keyword', '');
    if (request()->input('keyword') != '') $request->session()->put('timecards keyword', request()->input('keyword'));

    // preleva tutti i progetti
    $projects = Project::orderBy('ordering', 'DESC')->get();

    $timecards = Timecard::getAllWithForeign(
      $request->session()->get('timecards itemsforpage'),
      $request->session()->get('timecards project_id'),
      $request->session()->get('timecards dateins'),
      $request->session()->get('timecards keyword')
    );
    return view('timecards.list', ['timecards' => $timecards])
    ->with('projects', $projects)
    ;
    
  }





  
}
