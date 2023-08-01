<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;

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

    $appCssLinks = array('<link rel="stylesheet" href="/plugins/tempus-dominus/css/tempus-dominus.min.css"/>');

    $appJavascriptLinks = array(
      '<script src="/plugins/moment/js/moment-with-locales.min.js"></script>',
      '<script src="/plugins/tempus-dominus/js/tempus-dominus.min.js"></script>',
      '<script src="/js/modules/estimates.create.20230608.js"></script>',
      '<script src="/js/modules/estimates.form.20230608.js"></script>'
    );

    $dateins = Carbon::createFromFormat('Y-m-d', date('Y-m-d'))->format('d/m/Y');
    $appJavascriptBodyCode = "defaultdateins ='".$dateins."';";
    $datesca = Carbon::createFromFormat('Y-m-d', date('Y-m-d'))->format('d/m/Y');
    $appJavascriptBodyCode .= "defaultdatesca ='".$datesca."';";


    return view('estimates.create')
    ->with('thirdies',$this->thirdies)
    ->with('appCssLinks', $appCssLinks)
    ->with('appJavascriptBodyCode', $appJavascriptBodyCode)
    ->with('appJavascriptLinks',$appJavascriptLinks);
  }

  public function store(EstimateRequest $request)
  {

    if (!$request->has('active')) $request->merge(['active' => 0]);
    
    $estimate = new Estimate;

    $estimate->user_id = auth()->user()->id;
    $estimate->thirdparty_id = $request->input('thirdparty_id'); 
    $estimate->alt_thirdparty = $request->input('alt_thirdparty');

    $estimate->dateins = Carbon::createFromFormat('d/m/Y', $request->input('dateins'))->format('Y-m-d');
    $estimate->datesca = Carbon::createFromFormat('d/m/Y', $request->input('datesca'))->format('Y-m-d');

    $estimate->note = $request->input('note');
    $estimate->content = $request->input('content');
    $estimate->active = $request->input('active');
    $estimate->save();

    $savearticles = true;
    
  
    if ($savearticles == true) {

      $article = new Estimatesarticle;
      $article->estimate_id = $estimate->id;
      $article->note = $request->input('art_note');
      $article->content = $request->input('art_content');
      $article->quantity = $request->input('art_quantity');
      $article->value = $request->input('art_value');
      $article->save();

      return to_route('estimates.edit', [$estimate->id]);
    }
    
    
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
      '<script src="/js/modules/estimates.edit.20230608.js"></script>',
      '<script src="/js/modules/estimates.form.20230608.js"></script>'
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
    $estimate->alt_thirdparty = $request->input('alt_thirdparty');

    $estimate->dateins = Carbon::createFromFormat('d/m/Y', $request->input('dateins'))->format('Y-m-d');
    $estimate->datesca = Carbon::createFromFormat('d/m/Y', $request->input('datesca'))->format('Y-m-d');

    $estimate->note = $request->input('note');
    $estimate->content = $request->input('content');
    $estimate->active = $request->input('active');
    $estimate->save();

    $savearticles = true;

    if ($request->input('art_value') == '')   $savearticles = false;


    if ($savearticles == true) {

      $article = new Estimatesarticle;
      $article->estimate_id = $estimate->id;
      $article->note = $request->input('art_note');
      $article->content = $request->input('art_content');
      $article->quantity = $request->input('art_quantity');
      $article->value = $request->input('art_value');
      $article->save();

      return to_route('estimates.edit', [$estimate->id]);
    }
    


    
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

    $res = Estimatesarticle::where('estimate_id','=',$id)->delete();
   
    $estimate = Estimate::findOrFail($id);
    $estimate->delete();
    return to_route('estimates.index')->with('success', 'Preventivo cancellato!');
  }

  public function ajaxgetarticleslist(Request $request) 
  {
    $token = $request->input('_token', '');
    $id = $request->input('id', 0);
    if (csrf_token() !== $token) {
      return 'Non hai passato il token corretto!';
    }
    $articles = Estimatesarticle::where('estimate_id','=',$id)->get();
    return view('estimates.articleslist')
    ->with('articles',$articles);

  }


}