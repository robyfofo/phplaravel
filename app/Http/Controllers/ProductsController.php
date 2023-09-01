<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;

use Illuminate\Http\Request;


use App\Models\Products;
use App\Models\ProductsCategories;

use App\Http\Requests\ProductRequest;


class ProductsController extends Controller
{
  private $searchfromtable = '';
  private $orderType = 'ASC';
  private $uploadpath;

  public function __construct()
  {
    $this->uploadpath = public_path('uploads/products/');
    !is_dir($this->uploadpath) && mkdir($this->uploadpath, 0777, true);
  }

  /**
   * Display a listing of the resource.
   */
  public function index(Request $request)
  {

    // numero pagine
    if ($request->session()->missing('products itemsforpage')) $request->session()->put('products itemsforpage', 10);
    if (request()->input('itemsforpage')) $request->session()->put('products itemsforpage', request()->input('itemsforpage'));

    // ricerca 
    $request->session()->put('products searchfromtable', '');
    if (request()->input('searchfromtable')) $request->session()->put('products searchfromtable', request()->input('searchfromtable'));

    // categoria
    $request->session()->put('products categories_id', '');
    if (request()->input('categories_id')) $request->session()->put('products categories_id', request()->input('categories_id'));

    $categories = ProductsCategories::tree();

    //dd($categories);

    $appJavascriptLinks = array('<script src="js/modules/products.index.20230612.js"></script>');

    $products = Products::orderBy('id', $this->orderType)
      ->where(function($query) { 
        if (request()->session()->get('products categories_id') != '') {
          $query->where('categories_id','=',request()->session()->get('products categories_id'));
        }
      })
      ->where(function($query) {
        $query->where('title', 'like', '%' . request()->session()->get('products searchfromtable') . '%')
        ->orWhere('content', 'like', '%' . request()->session()->get('products searchfromtable') . '%');
      })
      ->paginate(request()->session()->get('products itemsforpage'));

    return view('products.index', ['products' => $products])
    ->with('orderType', $this->orderType)
    -> with('categories', $categories)
    ->with('appJavascriptLinks', $appJavascriptLinks);
  }

  /**
   * Show the form for creating a new resource.
   */
  public function create()
  {
    $categories = ProductsCategories::tree();

    $product = Products::FindOrNew(0);
    $product->category_id = '';
		$product->active = 1;
		$product->ordering = 0;
    return view('products.form')
    -> with('product', $product)
    -> with('categories', $categories);
  }

  /**
   * Store a newly created resource in storage.
   */
  public function store(ProductRequest $request)
  {

    if (!$request->has('active')) $request->merge(['active' => 0]);

    $product = new Products;

    $fileName = time() . '.' . $request->image->extension();
    $request->image->move($this->uploadpath,$fileName);

    $product->content = $request->input('content');
    $product->title = $request->input('title');
    $product->price_unity = $request->input('price_unity');
    $product->active = $request->input('active');
    $product->categories_id = $request->input('categories_id');

    $product->image = $fileName;
    
    if ($product->ordering == 0)  $product->ordering = getLastOrdering('products', 'ordering',array('field'=>'categories_id','fieldValue'=>$product->categories_id)) + 1;
    $product->save();
    return to_route('products.index')->with('success', 'Prodotto inserito!');
  }

  /**
   * Show the form for editing the specified resource.
   */
  public function edit(string $id)
  {
    $categories = ProductsCategories::tree();
    $product = Products::findOrFail($id);
    return view('products.form', ['product' => $product])    
    -> with('categories', $categories);    
  }

  /**
   * Update the specified resource in storage.
   */
  public function update(ProductRequest $request, $id)
  {
    if (!$request->has('active')) $request->merge(['active' => 0]);
    $product = Products::findOrFail($id);
    $old_categories_id = $product->getOriginal('categories_id');
    $old_image = $product->getOriginal('image');
    if ($request->has('image')) {  
    $fileName = time() . '.' . $request->image->extension();
    $request->image->move($this->uploadpath,$fileName);
    $product->image = $fileName;
    // cancello quello vecchio  
    if(Storage::exists('public/images', $old_image)){
      Storage::delete($this->uploadpath.$old_image);
    }
    }

    // cancella se selezionato
    if ($request->has('deleteimage')) {
      if(File::exists($this->uploadpath.$old_image)){
        File::delete($this->uploadpath.$old_image);
      }
      $product->image = '';
    }
    
    $product->content = $request->input('content');
    $product->title = $request->input('title');
    $product->price_unity = $request->input('price_unity');
    $product->active = $request->input('active');
    $product->categories_id = $request->input('categories_id');


    if (($product->categories_id <> $old_categories_id) || ($product->ordering == 0))  $product->ordering = getLastOrdering('products', 'ordering',array('field'=>'categories_id','fieldValue'=>$product->categories_id)) + 1;
    $product->save();
    return to_route('products.index')->with('success', 'Prodotto modificato!');
  }

  /**
   * Remove the specified resource from storage.
   */
  public function destroy(string $id)
  {
    $product = Products::findOrFail($id);

    if(File::exists($this->uploadpath.$product->image)){
      File::delete($this->uploadpath.$product->image);
    }

    $product->delete();
    optimizeFieldOrdering($table = 'products', $fieldOrder = 'ordering', $fieldParent = array('categories_id'), $fieldParentValue = array($product->categories_id));
    return to_route('products.index')->with('success', 'Prodotto cancellato!');
  }

  public function lessordering($id, $foo)
  {
    $product = Products::findOrFail($id);
    $result = lessorder($id,$table = 'products', 
      $opt = array(
        'fieldParent' => array('categories_id'), 
        'fieldParentValue' => array($product->categories_id)
      )
    );

    if ($result == false) {
      return to_route('products.index')->with('error', 'Prodotto NON spostato.');
    }
    return to_route('products.index')->with('success', 'Prodotto spostato.');
  }


  public function moreordering($id, $foo)
  {
    $product = Products::findOrFail($id);
    $result = moreorder(
      $id, 
      $table = 'products', 
      $opt = array(
        'fieldParent' => array('categories_id'), 
        'fieldParentValue' => array($product->categories_id)
      )
    );

    if ($result == false) {
      return to_route('products.index')->with('error', 'Prodotto NON spostato.');
    }
    return to_route('products.index')->with('success', 'Prodotto spostato.');
  }
}
