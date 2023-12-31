<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Config;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;

use Illuminate\Http\Request;

use App\Models\Estimate;
use App\Models\Project;
use App\Models\Thirdparty;
use App\Models\Estimatesarticle;

use App\Http\Requests\EstimateRequest;

use Carbon\Carbon;
use Sabberworm\CSS\Settings;
use PDF;
use stdClass;

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

    $estimate = Estimate::findOrNew(0);
    $estimate->thirdparty_id = 0;
    $estimate->id = 0;
    $estimate_tax = 5;
    $articles_total = 0;

    $appCssLinks = array('<link rel="stylesheet" href="/plugins/tempus-dominus/css/tempus-dominus.min.css"/>');

    $appJavascriptLinks = array(
      '<script src="/plugins/moment/js/moment-with-locales.min.js"></script>',
      '<script src="/plugins/tempus-dominus/js/tempus-dominus.min.js"></script>',
      '<script src="/js/modules/estimates.form.20230608.js"></script>',
      '<script src="/js/modules/estimates.ajaxform.20230608.js"></script>',
    );

    $dateins = Carbon::createFromFormat('Y-m-d', date('Y-m-d'))->format('d/m/Y');
    $appJavascriptBodyCode = "defaultdateins ='".$dateins."';";
    $datesca = Carbon::createFromFormat('Y-m-d', date('Y-m-d'))->format('d/m/Y');
    $appJavascriptBodyCode .= "defaultdatesca ='".$datesca."';";


    return view('estimates.form')
    ->with('estimate',$estimate)
    ->with('estimate_tax',$estimate_tax)
    ->with('articles_total',$articles_total)
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

    // salva gli articoli in sessione
    $foo = $request->session()->get('estimates articles');
    if (is_array($foo) && count($foo) > 0) {
      foreach ($foo AS $value) {

        $article = new Estimatesarticle;
        $article->estimate_id = $estimate->id;
        $article->note = $value['note'];
        $article->content = $value['content'];
        $article->quantity = $value['quantity'];
        $article->price_unity = $value['price_unity'];
        $article->save();
  
      }
    }
    $foo = array();
    request()->session()->put('estimates articles',$foo);
  
    return to_route('estimates.index')->with('success', 'Preventivo inserito!');
  }  

  public function edit($id)
  {
    $estimate = Estimate::findOrFail($id);
    $estimate_tax = 5;
    
    $appCssLinks = array('<link rel="stylesheet" href="/plugins/tempus-dominus/css/tempus-dominus.min.css"/>');

    $appJavascriptLinks = array(
      '<script src="/plugins/moment/js/moment-with-locales.min.js"></script>',
      '<script src="/plugins/tempus-dominus/js/tempus-dominus.min.js"></script>',
      '<script src="/js/modules/estimates.form.20230608.js"></script>',
      '<script src="/js/modules/estimates.ajaxform.20230608.js"></script>'
    );

    $dateins = Carbon::createFromFormat('Y-m-d', $estimate->dateins)->format('d/m/Y');
    $appJavascriptBodyCode = "defaultdateins ='".$dateins."';";
    $datesca = Carbon::createFromFormat('Y-m-d', $estimate->datesca)->format('d/m/Y');
    $appJavascriptBodyCode .= "defaultdatesca ='".$datesca."';";

    return view('estimates.form', ['estimate' => $estimate])
    ->with('projects',$this->projects)
    ->with('estimate_tax',$estimate_tax)
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

    // salva gli articoli in sessione
    $foo = $request->session()->get('estimates articles');
    if (is_array($foo) && count($foo) > 0) {
      foreach ($foo AS $value) {

        $article = new Estimatesarticle;
        $article->estimate_id = $estimate->id;
        $article->note = $value['note'];
        $article->content = $value['content'];
        $article->quantity = $value['quantity'];
        $article->price_unity = $value['price_unity'];
        $article->save();
  
      }
    }
    $foo = array();
    request()->session()->put('estimates articles',$foo);

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

    $articles_total = 0.00;
    $dbarticles_total = 0.00;
    $sessarticles_total = 0.00;
    foreach($articles AS $value) { $dbarticles_total += $value->total; }
    $foo = request()->session()->get('estimates articles');
    if (is_array($foo) && count($foo) > 0) $sessarticles_total = array_sum(array_column($foo, 'total'));
    $articles_total = $dbarticles_total + $sessarticles_total;


    return view('estimates.articleslist')
    ->with('articles',$articles)
    ->with('articles_total',$articles_total);

  }

  public function ajaxdeletearticle(Request $request)
  {
    $token = $request->input('_token', '');
    $id = $request->input('id', 0);
    if (csrf_token() !== $token) {
      return 'Non hai passato il token corretto!';
    }
    $article = Estimatesarticle::findOrFail($id);
    $article->delete();

  }

  public function ajaxeditarticle(Request $request)
  {
    $token = $request->input('_token', '');
    $id = $request->input('id', 0);
    if (csrf_token() !== $token) {
      return 'Non hai passato il token corretto!';
    }

    $article = Estimatesarticle::findOrFail($id);

    $old_price_total = $article->quantity * $article->price_unity;
    $tax = Config::get('settings.estimate_article_tax');

    // salva
    $article->note = $request->input('note');
    $article->content = $request->input('content');
    $article->quantity = $request->input('quantity');
    $article->price_unity = $request->input('price_unity');
    $article->save();

    $price_total = $request->input('price_unity') * $request->input('quantity');
    $price_tax = ($price_total * $tax) / 100;
    $total = $price_total + $price_tax;
    $foo = [
      'id' => $article->id,
      'note' => $article->note,
      'content' => $article->content,

      'price_unity' => $request->input('price_unity'),
      'quantity' => $request->input('quantity'),
      'price_total' => $price_total,
      'tax' => $tax,
      'price_tax' => $price_tax,
      'total' => $total,
    ];

    echo json_encode(array('error'=>0,'message'=>'Ok','data'=>$foo));

  }

  public function ajaxinsertsessarticle(Request $request)
  {
    $token = $request->input('_token', '');
    if (csrf_token() !== $token) {
      return 'Non hai passato il token corretto!';
    }
    $foo = $request->session()->get('estimates articles');
    $x = 0;
    if (is_array($foo) && count($foo) > 0) { $x = count($foo); }
    $x++;

    $note = $request->input('note');
    $content = $request->input('content');
    $quantity = $request->input('quantity');
    $price_unity = $request->input('price_unity');
    $tax = Config::get('settings.estimate_article_tax');

    if ($quantity > 0 && $price_unity > 0) {
      $price_total = $price_unity * $quantity;
      $price_tax = ($price_total * $tax) / 100;
      $total = $price_total + $price_tax;
      $foo[$x] = [
        'id' => $x,
        'note' => $note,
        'content' => $content,

        'price_unity' => $price_unity,
        'quantity' => $quantity,
        'price_total' => $price_total,
        'tax' => $tax,
        'price_tax' => $price_tax,
        'total' => $total,
      ];


      //dd($foo);
      
      request()->session()->put('estimates articles',$foo);
      return true;

    } else {
      return false;
    }

  }

  public function ajaxdeletesessarticle(Request $request)
  {
    $token = $request->input('_token', '');
    $id = $request->input('id', 0);
    if (csrf_token() !== $token) {
      return 'Non hai passato il token corretto!';
    }
   
    $foo = $request->session()->get('estimates articles');
    unset($foo[$id]);
    request()->session()->put('estimates articles',$foo);
  }

  public function ajaxeditsessarticle(Request $request)
  {
    $token = $request->input('_token', '');
    $id = $request->input('id', 0);
    if (csrf_token() !== $token) {
      return 'Non hai passato il token corretto!';
    }

    $note = $request->input('note');
    $content = $request->input('content');
    $quantity = $request->input('quantity');
    $price_unity = $request->input('price_unity');
    $tax = Config::get('settings.estimate_article_tax');
    
    if ($quantity > 0 && $price_unity > 0) {
      $foo = $request->session()->get('estimates articles');

      $price_total = $price_unity * $quantity;
      $price_tax = ($price_total * $tax) / 100;
      $total = $price_total + $price_tax;
      $foo[$id] = [
        'id' => $id,
        'note' => $note,
        'content' => $content,

        'price_unity' => $price_unity,
        'quantity' => $quantity,
        'price_total' => $price_total,
        'tax' => $tax,
        'price_tax' => $price_tax,
        'total' => $total,
      ];
      
      request()->session()->put('estimates articles',$foo);

      echo json_encode(array('error'=>0,'message'=>'Ok','data'=>$foo[$id]));
      die();
    }

    return false;
  }

  public function showpdf(Request $request, $id)
  {
   
    $estimate = Estimate::findOrFail($id);
    $estimate->tax = Config::get('settings.estimate_tax');
    //dd($estimate);
    
    $articles = Estimatesarticle::where('estimate_id','=',$id)->get();
    //dd($articles);
    $articles_total = 0.00;
    foreach($articles AS $value) { $articles_total += $value->total; }

    // trova dettagli anagrafica
    $thirdparty = new stdClass;
    if ($estimate->thirdparty_id > 0) $thirdparty = Thirdparty::findOrFail($estimate->thirdparty_id);
    //dd($thirdparty);

    // calcola totali
    $estimate->price_tax = ($articles_total * $estimate->tax) / 100;
    $estimate->total = $articles_total + $estimate->price_tax;
 
    $title = 'Preventivo numero '.$estimate->id.' del '.$estimate->dateins;
    $filename = 'Preventivo-'.$estimate->id.'-'.$estimate->dateins;
    $data = [
      'title' => $title,
      'date' => date('m/d/Y'),
      'estimate' => $estimate,
      'thirdparty'=>$thirdparty,
      'articles_total'=>$articles_total,
      'articles'=>$articles
    ]; 
    
    /*
    */
    $pdf = PDF::loadView('estimates.showpdf', $data);
    return $pdf->download($filename.'.pdf');
  
    /*
    return view('estimates.showpdf', ['estimate' => $estimate])
    ->with('articles',$articles)
    ->with('thirdparty',$thirdparty)
    ->with('articles_total',$articles_total)
    ->with('title','Preventivo');
    */

  }

  public function showxml(Request $request, $id)
  {
   
    $estimate = Estimate::findOrFail($id);
    $estimate->tax = Config::get('settings.estimate_tax');
    //dd($estimate);
    
    $articles = Estimatesarticle::where('estimate_id','=',$id)->get();
    //dd($articles);
    $articles_total = 0.00;
    foreach($articles AS $value) { $articles_total += $value->total; }

    // trova dettagli anagrafica
    $thirdparty = new stdClass;
    if ($estimate->thirdparty_id > 0) $thirdparty = Thirdparty::findOrFail($estimate->thirdparty_id);
    //dd($thirdparty);

    // calcola totali
    $estimate->price_tax = ($articles_total * $estimate->tax) / 100;
    $estimate->total = $articles_total + $estimate->price_tax;

		$xml = new \SimpleXMLElement('<?xml version="1.0" encoding="utf-8"?> <preventivo></preventivo>');
		$foo = $xml->addChild('Dati');
		$foo->addAttribute('Numero',$estimate->id);

		if(isset($estimate->id) && $estimate->id != '')													                                    $foo->addChild('Id',$estimate->id);
		if(isset($estimate->dateins) && $estimate->dateins != '')								                                    $foo->addChild('Data',$estimate->dateins);
		if(isset($estimate->datesca) && $estimate->datesca != '')							                                      $foo->addChild('Scadenza',$estimate->datesca);
		if(isset($estimate->note) && $estimate->note != '') 										                                    $foo->addChild('Note',$estimate->note);
		if(isset($estimate->content) && $estimate->content != '') 							                                    $foo->addChild('Contenuto',$estimate->content);
		$foo = $xml->addChild('Fornitore');
		$foo->addChild('Ragione_sociale',Config::get('settings.company_ragione_sociale'));
		$foo->addChild('Indirizzo',Config::get('settings.company_address'));
		$foo->addChild('P.Iva',Config::get('settings.partita_iva'));

		$foo = $xml->addChild('Cliente');
    if ($estimate->alt_thirdparty != '') {
      $foo->addChild('Anagrafica',$estimate->alt_thirdparty);
    } else {
      
      if(isset($thirdparty->id) && $thirdparty->id > 0)																	                        $foo->addChild('Id',$thirdparty->id);
      if(isset($thirdparty->name) && $thirdparty->name != '')																	                  $foo->addChild('Nome',$thirdparty->name);
      if(isset($thirdparty->street) && $thirdparty->street != '')															                  $foo->addChild('Via',$thirdparty->street);
      if(isset($thirdparty->city) && $thirdparty->city != '')															                      $foo->addChild('Città',$thirdparty->city);
      if(isset($thirdparty->zip_code) && $thirdparty->zip_code != '')														                $foo->addChild('CAP',$thirdparty->zip_code);
      if(isset($thirdparty->provincia) && $thirdparty->provincia != '')												                  $foo->addChild('Provincia',$thirdparty->provincia);
      if(isset($thirdparty->nation) && $thirdparty->nation != '')														                    $foo->addChild('Nazione',$thirdparty->nation);
      if(isset($thirdparty->email) && $thirdparty->email != '')														                      $foo->addChild('Email',$thirdparty->email);
      if(isset($thirdparty->telephone) && $thirdparty->telephone != '')														              $foo->addChild('Telefono',$thirdparty->telephone);
      if(isset($thirdparty->partita_iva) && $thirdparty->partita_iva != '')														          $foo->addChild('P.IVA',$thirdparty->partita_iva);
      if(isset($thirdparty->codice_fiscale) && $thirdparty->codice_fiscale != '')														    $foo->addChild('C.Fiscale',$thirdparty->codice_fiscale);
    }
    
		$pro = $xml->addChild('Articoli');
	
    foreach ($articles as $value) {
      $pro1 = $pro->addChild('Articolo');
      if(isset($value->id) && $value->id > 0)                                                                   $pro1->addAttribute('Id',$value->id);
      if(isset($value->note) && $value->note != '')																			                        $pro1->addChild('Note',$value->note);
      if(isset($value->content) && $value->content != '')															                          $pro1->addChild('Contenuto',$value->content);
      if(isset($value->price_unity) && $value->price_unity != '')															                  $pro1->addChild('Prezzo_unitario',$value->price_unity);
      if(isset($value->quantity) && $value->quantity != '')																                      $pro1->addChild('Quantità',$value->quantity);
      if(isset($value->price_total) && $value->price_total != '')															                  $pro1->addChild('Prezzo_totale',$value->price_total);
      if(isset($value->tax) && $value->tax != '')															                                  $pro1->addChild('Imponibile',$value->tax);
      if(isset($value->price_tax) && $value->price_tax != '')															                      $pro1->addChild('Prezzo_imponibile',$value->price_tax);
      if(isset($value->total) && $value->total != '')															                              $pro1->addChild('Totale',$value->total);
      
    }
  
    
		$output = $xml->asXML();
		header('Content-Type: text/xml');
		header('Content-Disposition: attachment;filename="Preventivo-'.$estimate->id.'-'.$estimate->dateins .'.xlm"');
		header('Cache-Control: max-age=0');
		header('Cache-Control: max-age=1');
		header('Expires: Mon, 26 Jul 2050 05:00:00 GMT');
		header('Last-Modified: ' . gmdate('D, d M Y H:i:s') . ' GMT');
		header('Cache-Control: cache, must-revalidate');
		header('Pragma: public');

		echo $output;
		die();

  }


}