<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;

use Illuminate\Http\Request;


use App\Models\Thirdparty;
use App\Models\ThirdpartiesCategories;

use App\Http\Requests\ThirdpartyRequest;


class ThirdpartiesController extends Controller
{
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
    if ($request->session()->missing('thirdparties itemsforpage')) $request->session()->put('thirdparties itemsforpage', 10);
    if (request()->input('itemsforpage')) $request->session()->put('thirdparties itemsforpage', request()->input('itemsforpage'));

    // ricerca 
    $request->session()->put('thirdparties searchfromtable', '');
    if (request()->input('searchfromtable')) $request->session()->put('thirdparties searchfromtable', request()->input('searchfromtable'));

    // categoria
    $request->session()->put('thirdparties categories_id', '');
    if (request()->input('categories_id')) $request->session()->put('thirdparties categories_id', request()->input('categories_id'));

    $categories = ThirdpartiesCategories::tree();
    $appJavascriptLinks = array('<script src="js/modules/thirdparties.index.20230612.js"></script>');

    $thirdparties = Thirdparty::orderBy('id', $this->orderType)
      ->where(function($query) { 
        if (request()->session()->get('thirdparties categories_id') != '') {
          $query->where('categories_id','=',request()->session()->get('thirdparties categories_id'));
        }
      })
      ->where(function($query) {
        $query->where('name', 'like', '%' . request()->session()->get('thirdparties searchfromtable') . '%')
        ->orWhere('surname', 'like', '%' . request()->session()->get('thirdparties searchfromtable') . '%')
        ->orWhere('email', 'like', '%' . request()->session()->get('thirdparties searchfromtable') . '%');
      })
      ->paginate(request()->session()->get('thirdparties itemsforpage'));

    return view('thirdparties.index', ['thirdparties' => $thirdparties])
    ->with('orderType', $this->orderType)
    -> with('categories', $categories)
    ->with('appJavascriptLinks', $appJavascriptLinks);
  }

  /**
   * Show the form for creating a new resource.
   */
  public function create()
  {
    $categories = ThirdpartiesCategories::tree();

    $thirdparty = Thirdparty::findOrNew(0);
    $thirdparty->category_id = '';
    $thirdparty->location_nations_id = 0;
		$thirdparty->location_province_id = 0;
		$thirdparty->location_cities_id = 0;
		$thirdparty->active = 1;

    $appJavascriptBodyCode = "
    let selected_location_nations_id = '0';
		let selected_location_province_id = '0';
		let selected_location_cities_id = '0';
		
		let default_provincia_alt = '';
		let default_city_alt = '';
    ";
    $appJavascriptLinks = array('<script src="/js/modules/thirdparties.form.20230612.js"></script>');

    return view('thirdparties.form')
    -> with('thirdparty', $thirdparty)
    -> with('categories', $categories)
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
    $thirdparty->location_cities_id = $request->input('location_cities_id');
    
    $thirdparty->telephone = $request->input('telephone');
    $thirdparty->mobile = $request->input('mobile');
    $thirdparty->email = $request->input('email');
    
    $thirdparty->ragione_sociale = $request->input('ragione_sociale');
    $thirdparty->partita_iva = $request->input('partita_iva');
    $thirdparty->codice_fiscale = $request->input('codice_fiscale');
    $thirdparty->sid = $request->input('sid');
    $thirdparty->pec = $request->input('pec');

    $thirdparty->active = $request->input('active');
    $thirdparty->categories_id = $request->input('categories_id');


    $thirdparty->save();
    return to_route('thirdparties.index')->with('success', 'Cliente inserito!');
  }


  /**
   * Show the form for editing the specified resource.
   */
  public function edit(string $id)
  {
    $categories = ThirdpartiesCategories::tree();
    //dd($categories);
    $thirdparty = Thirdparty::findOrFail($id);
    
    $appJavascriptBodyCode = "
    let selected_location_nations_id = '".$thirdparty->location_nations_id."';
		let selected_location_province_id = '".$thirdparty->location_province_id."';
		let selected_location_cities_id = '".$thirdparty->location_cities_id."';
		
		let default_provincia_alt = '".$thirdparty->provincia_alt."';
		let default_city_alt = '".$thirdparty->city_alt."';
    ";
    $appJavascriptLinks = array('<script src="/js/modules/thirdparties.form.20230612.js"></script>');
    
    return view('thirdparties.form', ['thirdparty' => $thirdparty])    
    -> with('location_cities', $this->location_cities)
    -> with('location_province', $this->location_province)
    -> with('location_nations', $this->location_nations)
    -> with('categories', $categories)    
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

    $thirdparty->categories_id = $request->input('categories_id');
    
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
