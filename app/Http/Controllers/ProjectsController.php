<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;


use App\Models\Project;
use App\Http\Requests\ProjectRequest;

class ProjectsController extends Controller
{
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Contracts\View\View
   */

  private $itemsforpage = 2;
  private $page = 1;
  private $searchFromTable = '';
  private $orderType = 'ASC';

  public function index(Request $request)
  {
    // numero pagine
    if ($request->session()->missing('projects itemsforpage')) $request->session()->put('projects itemsforpage', 10);
    if (request()->input('itemsforpage')) $request->session()->put('projects itemsforpage', request()->input('itemsforpage'));

    // paginazione
    if ($request->session()->missing('projects page')) $request->session()->put('projects page', 1);
    if (request()->input('page')) $request->session()->put('projects page', request()->input('page'));

    if ($request->session()->has('projects itemsforpage')) $this->itemsforpage = $request->session()->get('projects itemsforpage');
    if ($request->session()->has('projects page')) $this->page = $request->session()->get('projects page');

    // ricerca 
    if ($request->session()->missing('projeks searchFromTable')) $request->session()->put('projeks searchFromTable', '');
    if (request()->input('searchFromTable')) {
      $request->session()->put('projeks searchFromTable', request()->input('searchFromTable'));
    } else {
      $request->session()->put('projeks searchFromTable', '');
    }
    if ($request->session()->has('projeks searchFromTable')) $this->searchFromTable = $request->session()->get('projeks searchFromTable');


    /*
    $searchwhere = array();
    $fieldsSearch = array('title', 'content');
    if ($this->searchFromTable != '') {
      $words = explode(',', $this->searchFromTable);
      if (count($fieldsSearch) > 0) {
        foreach ($fieldsSearch as $key => $value) {
          if (count($words) > 0) {
            foreach ($words as $value1) {
              $searchwhere[] = array($value, 'LIKE', '%' . $value1 . '%');
            }
          }
        }
      }
    }
    */
  
    $appJavascriptLinks = array('<script src="js/modules/projects.index.20230608.js"></script>');

    $projects = Project::orderBy('ordering', $this->orderType)
    ->where(function($query) {
      $query->where('title', 'like', '%' . $this->searchFromTable . '%')
      ->orWhere('content', 'like', '%' . $this->searchFromTable . '%');
    })
    ->paginate($this->itemsforpage);

    return view('projects.index', ['projects' => $projects])
      ->with('itemsforpage', $this->itemsforpage)
      ->with('searchFromTable', $this->searchFromTable)
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
    $project = new Project;
    $ordering = getLastOrdering('projects', 'ordering', array());
    return view('projects.create')->with('ordering', $ordering);
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
    $project = Project::findOrFail($id);
    $project->delete();
    optimizeFieldOrdering($table = 'projects', $fieldOrder = 'ordering', $fieldParent = array(), $fieldParentValue = array());
    return to_route('projects.index')->with('success', 'Progetto cancellato!');
  }

  public function moreordering($id, $foo)
  {
    $result = moreorder($id, $table = 'projects', $opt = array());

    if ($result == false) {
      return to_route('projects.index')->with('error', 'Progetto NON spostato.');
    }
    return to_route('projects.index')->with('success', 'Progetto spostato.');
  }

  public function lessordering($id, $foo)
  {
    $result = lessorder($id, $table = 'projects', $opt = array());

    if ($result == false) {
      return to_route('projects.index')->with('error', 'Progetto NON spostato.');
    }
    return to_route('projects.index')->with('success', 'Progetto spostato.');
  }

}