<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;

use Illuminate\Http\Request;


use App\Models\Thirdparty;

use App\Http\Requests\ThirdpartyRequest;


class ThirdpartiesController extends Controller
{

  private $itemsforpage = 2;
  private $page = 1;
  private $searchfromtable = '';
  private $orderType = 'ASC';
  private $location_nations;
  private $location_province;
  private $location_cities;

  public function __construct()
  {
    // preleva le nazioni
    $this->location_nations = DB::table('location_nations')->where('active', '=', '1')->get();
    // preleva le province
    $this->location_province = DB::table('location_province')->where('active', '=', '1')->get();
    // preleva le citta
    $this->location_cities = DB::table('location_cities')->where('active', '=', '1')->get();
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
    if ($request->session()->missing('thirdparty searchfromtable')) $request->session()->put('thirdparty searchfromtable', '');
    if (request()->input('searchfromtable')) {
      $request->session()->put('thirdparty searchfromtable', request()->input('searchfromtable'));
    } else {
      $request->session()->put('thirdparty searchfromtable', '');
    }
    if ($request->session()->has('thirdparty searchfromtable')) $this->searchfromtable = $request->session()->get('thirdparty searchfromtable');

  
    $appJavascriptLinks = array('<script src="js/modules/thirdparties.index.20230612.js"></script>');

    $thirdparties = Thirdparty::orderBy('id', $this->orderType)

      ->where(function($query) {
        $query->where('name', 'like', '%' . $this->searchfromtable . '%')
        ->orWhere('surname', 'like', '%' . $this->searchfromtable . '%')
        ->orWhere('email', 'like', '%' . $this->searchfromtable . '%');
      })
      
      ->paginate($this->itemsforpage);

    return view('thirdparties.index', ['thirdparties' => $thirdparties])
    ->with('itemsforpage', $this->itemsforpage)
    ->with('searchfromtable', $this->searchfromtable)
    ->with('orderType', $this->orderType)
    ->with('appJavascriptLinks', $appJavascriptLinks);
  }

  /**
   * Show the form for creating a new resource.
   */
  public function create()
  {
    $thirdparty = new Thirdparty;

    $appJavascriptBodyCode = "
    let selected_location_nations_id = '0';
		let selected_location_province_id = '0';
		let selected_location_cities_id = '0';
		
		let default_provincia_alt = '';
		let default_city_alt = '';
    ";
    $appJavascriptLinks = array('<script src="/js/modules/thirdparties.create.20230612.js"></script>');

    return view('thirdparties.create')
    -> with('location_cities', $this->location_cities)
    -> with('location_province', $this->location_province)
    -> with('location_nations', $this->location_nations)
    -> with('appJavascriptBodyCode', $appJavascriptBodyCode)
    -> with('appJavascriptLinks', $appJavascriptLinks);
  }

  /**
   * Store a newly created resource in storage.
   */
  public function store(ThirdpartyRequest $request)
  {

    if (!$request->has('active')) $request->merge(['active' => 0]);

    $thirdparty = new Thirdparty;

    $thirdparty->name = $request->input('name');
    $thirdparty->surname = $request->input('surname');
    $thirdparty->street = $request->input('street');
    $thirdparty->zip_code = $request->input('zip_code');

    $thirdparty->location_nations_id = $request->input('location_nations_id');
    $thirdparty->location_province_id = $request->input('location_province_id');
    
    $thirdparty->telephone = $request->input('telephone');
    $thirdparty->mobile = $request->input('mobile');
    $thirdparty->email = $request->input('email');
    
    $thirdparty->ragione_sociale = $request->input('ragione_sociale');
    $thirdparty->partita_iva = $request->input('partita_iva');
    $thirdparty->codice_fiscale = $request->input('codice_fiscale');
    $thirdparty->sid = $request->input('sid');
    $thirdparty->pec = $request->input('pec');

    $thirdparty->active = $request->input('active');

    $thirdparty->save();
    return to_route('thirdparties.index')->with('success', 'Cliente inserito!');
  }


  /**
   * Show the form for editing the specified resource.
   */
  public function edit(string $id)
  {
    $thirdparty = Thirdparty::findOrFail($id);
    
    $appJavascriptBodyCode = "
    let selected_location_nations_id = '".$thirdparty->location_nations_id."';
		let selected_location_province_id = '".$thirdparty->location_province_id."';
		let selected_location_cities_id = '".$thirdparty->location_cities_id."';
		
		let default_provincia_alt = '".$thirdparty->provincia_alt."';
		let default_city_alt = '".$thirdparty->city_alt."';
    ";
    $appJavascriptLinks = array('<script src="/js/modules/thirdparties.edit.20230612.js"></script>');
    
    return view('thirdparties.edit', ['thirdparty' => $thirdparty])    
    -> with('location_cities', $this->location_cities)
    -> with('location_province', $this->location_province)
    -> with('location_nations', $this->location_nations)
    -> with('appJavascriptBodyCode', $appJavascriptBodyCode)
    -> with('appJavascriptLinks', $appJavascriptLinks);
  }

  /**
   * Update the specified resource in storage.
   */
  public function update(ThirdpartyRequest $request, $id)
  {

    if (!$request->has('active')) $request->merge(['active' => 0]);

    $thirdparty = Thirdparty::findOrFail($id);

    $thirdparty->name = $request->input('name');
    $thirdparty->surname = $request->input('surname');
    $thirdparty->street = $request->input('street');
    $thirdparty->zip_code = $request->input('zip_code');

    $thirdparty->location_nations_id = $request->input('location_nations_id');
    $thirdparty->location_province_id = $request->input('location_province_id');
    $thirdparty->location_cities_id = $request->input('location_cities_id');
    
    $thirdparty->provincia_alt = $request->input('provincia_alt');
    $thirdparty->city_alt = $request->input('city_alt');

    $thirdparty->telephone = $request->input('telephone');
    $thirdparty->mobile = $request->input('mobile');
    $thirdparty->email = $request->input('email');
    
    $thirdparty->ragione_sociale = $request->input('ragione_sociale');
    $thirdparty->partita_iva = $request->input('partita_iva');
    $thirdparty->codice_fiscale = $request->input('codice_fiscale');
    $thirdparty->sid = $request->input('sid');
    $thirdparty->pec = $request->input('pec');

    $thirdparty->active = $request->input('active');
    
    $thirdparty->save();
    return to_route('thirdparties.index')->with('success', 'Cliente modificato!');
  }

  /**
   * Remove the specified resource from storage.
   */
  public function destroy(string $id)
  {
    $thirdparty = Thirdparty::findOrFail($id);
    $thirdparty->delete();
    return to_route('thirdparties.index')->with('success', 'Cliente cancellato!');
  }
}
