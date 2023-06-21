<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;


use App\Models\Users;
use App\Http\Requests\UsersRequest;

class UsersController extends Controller
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

    $where = array();
    $fieldsSearch = array('title', 'content');
    if ($this->searchFromTable != '') {
      $words = explode(',', $this->searchFromTable);
      if (count($fieldsSearch) > 0) {
        foreach ($fieldsSearch as $key => $value) {
          if (count($words) > 0) {
            foreach ($words as $value1) {
              $where[] = array($value, 'LIKE', '%' . $value1 . '%');
            }
          }
        }
      }
    }

    $appJavascriptLinks = array('<script src="js/modules/users.index.20230608.js"></script>');

    $projects = user::orderBy('ordering', $this->orderType)
      ->where($where)
      ->paginate($this->itemsforpage);

    return view('users.index', ['users' => $users])
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
    $user = new user;
    $ordering = getLastOrdering('users', 'ordering', array());
    return view('users.create')->with('ordering', $ordering);
  }

  /**
   * Store a newly created resource in storage.
   *
   * @param  userRequest  $request
   * @return \Illuminate\Http\RedirectResponse
   */
  public function store(userRequest $request)
  {

    if (!$request->has('active')) $request->merge(['active' => 0]);

    $user = new user;
    $user->title = $request->input('title');
    $user->content = $request->input('content');
    $user->active = $request->input('active');
    $user->ordering = $request->input('ordering');
    $user->status = $request->input('status');
    $user->completato = $request->input('completato');
    $user->save();

    return to_route('users.index');
  }

  /**
   * Display the specified resource.
   *
   * @param  int  $id
   * @return \Illuminate\Contracts\View\View
   */
  public function show($id)
  {
    $user = User::findOrFail($id);
    return view('usersshow', ['project' => $project]);
  }

  /**
   * Show the form for editing the specified resource.
   *
   * @param  int  $id
   * @return \Illuminate\Contracts\View\View
   */
  public function edit($id)
  {
    $project = Users::findOrFail($id);
    return view('usersedit', ['project' => $project]);
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  UserRequest  $request
   * @param  int  $id
   * @return \Illuminate\Http\RedirectResponse
   */
  public function update(UserRequest $request, $id)
  {

    if (!$request->has('active')) {
      $request->merge(['active' => 0]);
    }

    $project = Users::findOrFail($id);
    $project->title = $request->input('title');
    $project->content = $request->input('content');
    $project->active = $request->input('active');
    $project->ordering = $request->input('ordering');
    $project->status = $request->input('status');
    $project->completato = $request->input('completato');
    $project->save();

    return to_route('users.index')->with('success', 'Utente modificato!');
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  int  $id
   * @return \Illuminate\Http\RedirectResponse
   */
  public function destroy($id)
  {
    $project = Users::findOrFail($id);
    $project->delete();
    optimizeFieldOrdering($table = 'projects', $fieldOrder = 'ordering', $fieldParent = array(), $fieldParentValue = array());
    return to_route('users.index')->with('success', 'Utente cancellato!');
  }

  public function moreordering($id, $foo)
  {
    $result = moreorder($id, $table = 'projects', $opt = array());

    if ($result == false) {
      return to_route('users.index')->with('error', 'Utente NON spostato.');
    }
    return to_route('users.index')->with('success', 'Utente spostato.');
  }

  public function lessordering($id, $foo)
  {
    $result = lessorder($id, $table = 'projects', $opt = array());

    if ($result == false) {
      return to_route('users.index')->with('error', 'Utente NON spostato.');
    }
    return to_route('users.index')->with('success', 'Utente spostato.');
  }
}
