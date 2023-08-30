<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;

use Illuminate\Http\Request;


use App\Models\Categories;

use App\Http\Requests\CategoryRequest;


class CategoriesController extends Controller
{

  private $itemsforpage = 2;
  private $page = 1;
  private $searchfromtable = '';
  private $orderType = 'ASC';

  private  $categories;

  public function __construct()
  {
    $this->categories = Categories::tree();
  }

  public function index()
  {
    $appCssLinks = array(
      '<link href="/plugins/jquery.treegrid/jquery.treegrid.css" rel="stylesheet">'
    );
    $appJavascriptLinks = array(
      '<script src="/plugins/jquery.cookie/jquery.cookie.js" type="text/javascript"></script>',
      '<script src="/plugins/jquery.treegrid/jquery.treegrid.min.js" type="text/javascript"></script>',
      '<script src="js/modules/categories.index.20230612.js"></script>'
    );
    return view('categories.index',['categories' => $this->categories])
    ->with('appCssLinks', $appCssLinks)
    ->with('appJavascriptLinks', $appJavascriptLinks);
  }

  public function create()
  {
    $category = Categories::findOrNew(0);
    $category->parent_id = '';
    $category->active = 1;
    $category->ordering = 0;   
    return view('categories.form')
    ->with('category', $category)
    ->with('categories',$this->categories);
  }

  public function store(CategoryRequest $request)
  {
    if (!$request->has('active')) $request->merge(['active' => 0]);
    $category = new Categories;
    $category->parent_id = $request->input('parent_id');
    $category->title = $request->input('title');
    $category->active = $request->input('active');
    $category->ordering = $request->input('ordering');
    if ($category->ordering == 0)  $category->ordering = getLastOrdering('categories', 'ordering', $category->parent_id, array()) + 1;
    $category->save();
    return to_route('categories.index')->with('success', 'Categoria inserita!');
  }

  public function edit($id)
  {
    $category = Categories::findOrFail($id);
    return view('categories.form', ['category' => $category])
    ->with('categories',$this->categories);
  }

  public function update(CategoryRequest $request, $id)
  {
    if (!$request->has('active')) {
      $request->merge(['active' => 0]);
    }
    $category = Categories::findOrFail($id);
    $old_parent_id = $category->getOriginal('parent_id');
    $category->title = $request->input('title');
    $category->parent_id = $request->input('parent_id');
    $category->active = $request->input('active');
    $category->ordering = $request->input('ordering');
    if ($category->parent_id <> $old_parent_id)  $category->ordering = getLastOrdering('categories', 'ordering', $category->parent_id, array()) + 1;
    $category->save();
    return to_route('categories.index')->with('success', 'Categoria modificata!');
  }

  public function destroy($id)
  {
    // controlla se è possibile cancellare
    if (Categories::isfreetodelete($id) == false) {
      return to_route('categories.index')->with('error', 'Non è possibile cancellare la categoria!');
    }
    $category = Categories::findOrFail($id);
    $category->delete();
    // sistema ordering
    optimizeFieldOrdering($table = 'categories', $fieldOrder = 'ordering', $fieldParent = array('parent_id'), $fieldParentValue = array($category->parent_id));
    return to_route('categories.index')->with('success', 'Categoria cancellata!');
  }

  public function lessordering($id, $foo)
  {
    $category = Categories::findOrFail($id);
    $result = lessorder($id,$table = 'categories', 
      $opt = array(
        'fieldParent' => array('parent_id'), 
        'fieldParentValue' => array($category->parent_id)
      )
    );

    if ($result == false) {
      return to_route('categories.index')->with('error', 'Categoria NON spostata.');
    }
    return to_route('categories.index')->with('success', 'Categoria spostata.');
  }


  public function moreordering($id, $foo)
  {
    $category = Categories::findOrFail($id);
    $result = moreorder(
      $id, 
      $table = 'categories', 
      $opt = array(
        'fieldParent' => array('parent_id'), 
        'fieldParentValue' => array($category->parent_id)
      )
    );

    if ($result == false) {
      return to_route('categories.index')->with('error', 'Categoria NON spostata.');
    }
    return to_route('categories.index')->with('success', 'Categoria spostata.');
  }

}
