<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Thirdparty;

use App\Http\Requests\ThirdpartyRequest;


class ThirdpartiesController extends Controller
{

  private $itemsforpage = 2;
  private $page = 1;
  private $searchFromTable = '';
  private $orderType = 'ASC';
  private $levels;

  public function __construct()
  {

  }


  /**
   * Display a listing of the resource.
   */
  public function index(Request $request)
  {
    // numero pagine
    if ($request->session()->missing('thirdparty itemsforpage')) $request->session()->put('thirdparty itemsforpage', 10);
    if (request()->input('itemsforpage')) $request->session()->put('thirdparty itemsforpage', request()->input('itemsforpage'));

    // paginazione
    if ($request->session()->missing('thirdparty page')) $request->session()->put('thirdparty page', 1);
    if (request()->input('page')) $request->session()->put('thirdparty page', request()->input('page'));

    if ($request->session()->has('thirdparty itemsforpage')) $this->itemsforpage = $request->session()->get('thirdparty itemsforpage');
    if ($request->session()->has('thirdparty page')) $this->page = $request->session()->get('thirdparty page');

    // ricerca 
    if ($request->session()->missing('thirdparty searchFromTable')) $request->session()->put('thirdparty searchFromTable', '');
    if (request()->input('searchFromTable')) {
      $request->session()->put('thirdparty searchFromTable', request()->input('searchFromTable'));
    } else {
      $request->session()->put('thirdparty searchFromTable', '');
    }
    if ($request->session()->has('thirdparty searchFromTable')) $this->searchFromTable = $request->session()->get('thirdparty searchFromTable');

  
    $appJavascriptLinks = array('<script src="js/modules/thirdparties.index.20230612.js"></script>');

    $thirdparties = Thirdparty::orderBy('id', $this->orderType)

      ->where(function($query) {
        $query->where('name', 'like', '%' . $this->searchFromTable . '%')
        ->orWhere('surname', 'like', '%' . $this->searchFromTable . '%')
        ->orWhere('email', 'like', '%' . $this->searchFromTable . '%');
      })
      
      ->paginate($this->itemsforpage);

    return view('thirdparties.index', ['thirdparties' => $thirdparties])
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
    $thirdparty = new Thirdparty;
    return view('thirdparties.create');
  }

  /**
   * Store a newly created resource in storage.
   */
  public function store(ThirdpartyRequest $request)
  {
    $thirdparty = new Thirdparty;
    $thirdparty->name = $request->input('name');
    $thirdparty->surname = $request->input('surname');
    $thirdparty->email = $request->input('email');
    $thirdparty->save();
    return to_route('thirdparties.index')->with('success', 'Cliente inserito!');
  }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
      $thirdparty = Thirdparty::findOrFail($id);
      return view('thirdparties.edit', ['thirdparty' => $thirdparty]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ThirdpartyRequest $request, $id)
    {
      $thirdparty = Thirdparty::findOrFail($id);
      $thirdparty->name = $request->input('name');
      $thirdparty->surname = $request->input('surname');
      $thirdparty->email = $request->input('email');
      $thirdparty->save();
      return to_route('thirdparties.index')->with('success', 'Cliente modificato!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
