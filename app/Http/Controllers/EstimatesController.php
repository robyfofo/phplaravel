<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;


use App\Models\Estimate;
use App\Http\Requests\EstimateRequest;

class EstimatesController extends Controller
{
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Contracts\View\View
   */

  private $searchfromtable = '';
  private $orderType = 'ASC';

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

  /**
   * Store a newly created resource in storage.
   *
   * @param  ProjectRequest  $request
   * @return \Illuminate\Http\RedirectResponse
   */
  public function store(ProjectRequest $request)
  {

    if (!$request->has('active')) $request->merge(['active' => 0]);
    
    $project = new Project;
    $project->title = $request->input('title');
    $project->content = $request->input('content');
    $project->active = $request->input('active');
    $project->ordering = $request->input('ordering');
    $project->status = $request->input('status');
    $project->completato = $request->input('completato');
    $project->costo_orario = $request->input('costo_orario');
    $project->ore_preventivo = $request->input('ore_preventivo');
    $project->save();

    return to_route('projects.index')->with('success', 'Progetto inserito!');
  }

  /**
   * Display the specified resource.
   *
   * @param  int  $id
   * @return \Illuminate\Contracts\View\View
   */
  public function show($id)
  {
    $project = Project::findOrFail($id);
    return view('projects.show', ['project' => $project]);
  }

  /**
   * Show the form for editing the specified resource.
   *
   * @param  int  $id
   * @return \Illuminate\Contracts\View\View
   */
  public function edit($id)
  {
    $project = Project::findOrFail($id);
    return view('projects.edit', ['project' => $project]);
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  ProjectRequest  $request
   * @param  int  $id
   * @return \Illuminate\Http\RedirectResponse
   */
  public function update(ProjectRequest $request, $id)
  {

    if (!$request->has('active')) {
      $request->merge(['active' => 0]);
    }

    $project = Project::findOrFail($id);
    $project->title = $request->input('title');
    $project->content = $request->input('content');
    $project->active = $request->input('active');
    $project->ordering = $request->input('ordering');
    $project->status = $request->input('status');
    $project->completato = $request->input('completato');
    $project->costo_orario = $request->input('costo_orario');
    $project->ore_preventivo = $request->input('ore_preventivo');
    $project->save();
    
    return to_route('projects.index')->with('success', 'Progetto modificato!');
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