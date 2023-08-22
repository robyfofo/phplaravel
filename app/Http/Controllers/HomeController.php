<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;


use App\Models\Project;
use App\Models\Timecard;
use App\Models\Thirdparty;
use App\Models\Estimate;
use Carbon\Carbon;

class HomeController extends Controller
{
  /**
   * Create a new controller instance.
   *
   * @return void
   */
  public function __construct()
  {
    $this->middleware('auth');
  }

  /**
   * Show the application dashboard.
   *
   * @return \Illuminate\Contracts\Support\Renderable
   */
  public function index()
  {

    $lastlogin = auth()->user()->last_login_at;

    //$lastlogin = '2023-01-01 12:00:00';

    // prelevo ultimi progetti
    $lastprojects = Project::whereDate('created_at', '>',  $lastlogin)->count();
    // prelevo ultimi 1o progetti
    $projects = Project::orderBy('updated_at', 'DESC')->where('active', '=', 1)->take(10)->get();

    // prelevo ultimi clienti
    $lastthirdparty = Thirdparty::whereDate('created_at', '>',   $lastlogin)->count();
    // prelevo ultimi 1o timecards
    $thirdparties = Thirdparty::orderBy('created_at', 'DESC')->take(10)->get();

    // prelevo ultime timecards
    $lasttimecards = Timecard::whereDate('dateins', '>',  Carbon::parse($lastlogin)->format('Y-m-d'))->count();
    $timecards = Timecard::orderBy('dateins', 'DESC')->take(10)->get();

    // prelevo ultimi preventivi
    $lastestimates = Estimate::whereDate('created_at', '>',  $lastlogin)->count();
    // prelevo ultimi 1o preventivi
    $estimates = Estimate::orderBy('updated_at', 'DESC')->where('active', '=', 1)->take(10)->get();

    return view('home')
      ->with('lastprojects', $lastprojects)
      ->with('projects', $projects)
      ->with('lastthirdparty', $lastthirdparty)
      ->with('thirdparties', $thirdparties)
      ->with('lasttimecards', $lasttimecards)
      ->with('timecards', $timecards)
      ->with('lastestimates', $lastestimates)
      ->with('estimates', $estimates);
  }
}
