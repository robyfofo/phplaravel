<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;


use App\Models\Estimate;
use App\Models\Project;
use App\Models\Thirdparty;
use App\Models\Estimatesarticle;

use App\Http\Requests\EstimateRequest;

use Carbon\Carbon;

class EstimatesController extends Controller
{
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Contracts\View\View
   */

  private $searchfromtable = '';
  private $orderType = 'ASC';
  private $projects;
  private $thirdies;

  public function __construct()
  {
    // preleva i progetti
    $this->projects = Project::where('active', '=', '1')->orderBy('ordering', 'ASC')->get();
    //dd($this->projects);

    // preleva le terze parti
    $this->thirdies = Thirdparty::where('active', '=', '1')->orderBy('surname', 'ASC')->get();
    //dd($this->thirdies);

  }
  public function index(Request $request)
  {
    // numero pagine
    if ($request->session()->missing('estimates itemsforpage')) $request->session()->put('estimates itemsforpage', 10);
    if (request()->input('itemsforpage')) $request->session()->put('estimates itemsforpage', request()->input('itemsforpage'));

    // ricerca 
    $request->session()->put('estimates searchfromtable', '');
    if (request()->input('searchfromtable')) $request->session()->put('estimates searchfromtable', request()->input('searchfromtable'));

    $appJavascriptLinks = array('<script src="js/modules/estimates.index.20230608.js"></script>');

    $estimates = Estimate::orderBy('dateins', $this->orderType)
    ->where(function($query) {
      $query->where('note', 'like', '%' . request()->session()->get('estimates searchfromtable'). '%')
      ->orWhere('content', 'like', '%' . request()->session()->get('estimates searchfromtable') . '%')
      ->orWhere('alt_thirdparty', 'like', '%' . request()->session()->get('estimates searchfromtable') . '%');
    })
    ->paginate(request()->session()->get('estimates itemsforpage'));

    //dd($estimates);

    return view('estimates.index', ['estimates' => $estimates])
      ->with('orderType', $this->orderType)
      ->with('appJavascriptLinks', $appJavascriptLinks);
  }

  /**
   * Show the form for creating a new resource.
   *
   * @return \Illuminate\Contracts\View\View
   */
  public function create()
  {
    $estimate = new Estimate;
    return view('estimates.create');
  }

  public function store(EstimateRequest $request)
  {

    if (!$request->has('active')) $request->merge(['active' => 0]);
    
    $estmate = new Estimate;

    $estmate->note = $request->input('note');
    $estmate->content = $request->input('content');
    $estmate->active = $request->input('active');
    $estmate->save();

    return to_route('estimates.index')->with('success', 'Preventivo inserito!');
  }

  public function edit($id)
  {
    $estimate = Estimate::findOrFail($id);
    
    $articles = Estimatesarticle::where('estimate_id','=',$id)->get();

    $appCssLinks = array('<link rel="stylesheet" href="/plugins/tempus-dominus/css/tempus-dominus.min.css"/>');

    $appJavascriptLinks = array(
      '<script src="/plugins/moment/js/moment-with-locales.min.js"></script>',
      '<script src="/plugins/tempus-dominus/js/tempus-dominus.min.js"></script>',
      '<script src="/js/modules/estimates.edit.20230608.js"></script>'
    );

    $dateins = Carbon::createFromFormat('Y-m-d', $estimate->dateins)->format('d/m/Y');
    $appJavascriptBodyCode = "defaultdateins ='".$dateins."';";
    $datesca = Carbon::createFromFormat('Y-m-d', $estimate->datesca)->format('d/m/Y');
    $appJavascriptBodyCode .= "defaultdatesca ='".$datesca."';";

    return view('estimates.edit', ['estimate' => $estimate])
    ->with('projects',$this->projects)
    ->with('articles',$articles)
    ->with('thirdies',$this->thirdies)
    ->with('appCssLinks', $appCssLinks)
    ->with('appJavascriptBodyCode', $appJavascriptBodyCode)
    ->with('appJavascriptLinks',$appJavascriptLinks);
  }

  public function update(EstimateRequest $request, $id)
  {

    if (!$request->has('active')) {
      $request->merge(['active' => 0]);
    }

    $estimate = Estimate::findOrFail($id);
    $estimate->user_id = auth()->user()->id;
    $estimate->thirdparty_id = $request->input('thirdparty_id'); 
    $estimate->note = $request->input('note');
    $estimate->content = $request->input('content');
    $estimate->alt_thirdparty = $request->input('alt_thirdparty');
    $estimate->active = $request->input('active');
    $estimate->save();
    
    return to_route('estimates.index')->with('success', 'Preventivo modificato!');
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  int  $id
   * @return \Illuminate\Http\RedirectResponse
   */
  public function destroy($id)
  {
    $estimate = Estimate::findOrFail($id);
    $estimate->delete();
    return to_route('estimates.index')->with('success', 'Preventivo cancellato!');
  }

}