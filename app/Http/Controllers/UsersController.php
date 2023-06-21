<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\User;
use App\Http\Requests\UserRequest;


class UsersController extends Controller
{

  private $itemsforpage = 2;
  private $page = 1;
  private $searchFromTable = '';
  private $orderType = 'ASC';

    
  /**
   * Display a listing of the resource.
   */
  public function index(Request $request)
  {
    // numero pagine
    if ($request->session()->missing('users itemsforpage')) $request->session()->put('users itemsforpage', 10);
    if (request()->input('itemsforpage')) $request->session()->put('users itemsforpage', request()->input('itemsforpage'));

    // paginazione
    if ($request->session()->missing('users page')) $request->session()->put('users page', 1);
    if (request()->input('page')) $request->session()->put('users page', request()->input('page'));

    if ($request->session()->has('users itemsforpage')) $this->itemsforpage = $request->session()->get('users itemsforpage');
    if ($request->session()->has('users page')) $this->page = $request->session()->get('users page');

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

    $users = User::orderBy('id', $this->orderType)
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
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
