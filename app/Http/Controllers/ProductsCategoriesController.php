<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;

use Illuminate\Http\Request;


use App\Models\ProductsCategories;

use App\Http\Requests\ProductsCategoryRequest;


class ProductsCategoriesController extends Controller
{

  private $itemsforpage = 2;
  private $page = 1;
  private $searchfromtable = '';
  private $orderType = 'ASC';

  private  $categories;

  public function __construct()
  {
    $this->categories = ProductsCategories::tree();
  }

  public function index()
  {
    $appCssLinks = array(
      '<link href="/plugins/jquery.treegrid/jquery.treegrid.css" rel="stylesheet">'
    );
    $appJavascriptLinks = array(
      '<script src="/plugins/jquery.cookie/jquery.cookie.js" type="text/javascript"></script>',
      '<script src="/plugins/jquery.treegrid/jquery.treegrid.min.js" type="text/javascript"></script>',
      '<script src="js/modules/productscategories.index.20230612.js"></script>'
    );
    return view('productscategories.index',['categories' => $this->categories])
    ->with('appCssLinks', $appCssLinks)
    ->with('appJavascriptLinks', $appJavascriptLinks);
  }

  public function create()
  {
    $category = ProductsCategories::findOrNew(0);
    $category->parent_id = '';
    $category->active = 1;
    $category->ordering = 0;   
    return view('productscategories.form')
    ->with('category', $category)
    ->with('categories',$this->categories);
  }

  public function store(ProductsCategoryRequest $request)
  {
    if (!$request->has('active')) $request->merge(['active' => 0]);
    $category = new ProductsCategories;
    $category->parent_id = $request->input('parent_id');
    $category->title = $request->input('title');
    $category->active = $request->input('active');
    $category->ordering = $request->input('ordering');
    if ($category->ordering == 0)  $category->ordering = getLastOrdering('categories', 'ordering', $category->parent_id, array()) + 1;
    $category->save();
    return to_route('productscategories.index')->with('success', 'Categoria inserita!');
  }

  public function edit($id)
  {
    $category = ProductsCategories::findOrFail($id);
    return view('productscategories.form', ['category' => $category])
    ->with('categories',$this->categories);
  }

  public function update(ProductsCategoryRequest $request, $id)
  {
    if (!$request->has('active')) {
      $request->merge(['active' => 0]);
    }
    $category = ProductsCategories::findOrFail($id);
    $old_parent_id = $category->getOriginal('parent_id');
    $category->title = $request->input('title');
    $category->parent_id = $request->input('parent_id');
    $category->active = $request->input('active');
    $category->ordering = $request->input('ordering');
    if (($category->parent_id <> $old_parent_id) || ($category->ordering == 0 ))  $category->ordering = getLastOrdering('categories', 'ordering', $category->parent_id, array()) + 1;
    $category->save();
    return to_route('categories.index')->with('success', 'Categoria modificata!');
  }

  public function destroy($id)
  {
    // controlla se è possibile cancellare
    if (ProductsCategories::isfreetodelete($id) == false) {
      return to_route('categories.index')->with('error', 'Non è possibile cancellare la categoria!');
    }
    $category = ProductsCategories::findOrFail($id);
    $category->delete();
    // sistema ordering
    optimizeFieldOrdering($table = 'categories', $fieldOrder = 'ordering', $fieldParent = array('parent_id'), $fieldParentValue = array($category->parent_id));
    return to_route('categories.index')->with('success', 'Categoria cancellata!');
  }

  public function lessordering($id, $foo)
  {
    $category = ProductsCategories::findOrFail($id);
    $result = lessorder($id,$table = 'products_categories', 
      $opt = array(
        'fieldParent' => array('parent_id'), 
        'fieldParentValue' => array($category->parent_id)
      )
    );

    if ($result == false) {
      return to_route('productscategories.index')->with('error', 'Categoria NON spostata.');
    }
    return to_route('productscategories.index')->with('success', 'Categoria spostata.');
  }


  public function moreordering($id, $foo)
  {
    $category = ProductsCategories::findOrFail($id);
    $result = moreorder(
      $id, 
      $table = 'products_categories', 
      $opt = array(
        'fieldParent' => array('parent_id'), 
        'fieldParentValue' => array($category->parent_id)
      )
    );

    if ($result == false) {
      return to_route('productscategories.index')->with('error', 'Categoria NON spostata.');
    }
    return to_route('productscategories.index')->with('success', 'Categoria spostata.');
  }

}
