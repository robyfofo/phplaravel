<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;

use Illuminate\Http\Request;


use App\Models\ThirdpartiesCategories;

use App\Http\Requests\ThirdpartiesCategoryRequest;


class ThirdpartiesCategoriesController extends Controller
{

  private $itemsforpage = 2;
  private $page = 1;
  private $searchfromtable = '';
  private $orderType = 'ASC';

  private  $categories;

  public function __construct()
  {
    $this->categories = ThirdpartiesCategories::tree();
  }

  public function index()
  {
    $appCssLinks = array(
      '<link href="/plugins/jquery.treegrid/jquery.treegrid.css" rel="stylesheet">'
    );
    $appJavascriptLinks = array(
      '<script src="/plugins/jquery.cookie/jquery.cookie.js" type="text/javascript"></script>',
      '<script src="/plugins/jquery.treegrid/jquery.treegrid.min.js" type="text/javascript"></script>',
      '<script src="js/modules/thirdpartiescategories.index.20230612.js"></script>'
    );
    return view('thirdpartiescategories.index',['categories' => $this->categories])
    ->with('appCssLinks', $appCssLinks)
    ->with('appJavascriptLinks', $appJavascriptLinks);
  }

  public function create()
  {
    $category = ThirdpartiesCategories::findOrNew(0);
    $category->parent_id = '';
    $category->active = 1;
    $category->ordering = 0;  
    return view('thirdpartiescategories.form')
    ->with('category', $category)
    ->with('categories',$this->categories);
  }

  public function store(ThirdpartiesCategoryRequest $request)
  {
    if (!$request->has('active')) $request->merge(['active' => 0]);
    $category = new ThirdpartiesCategories;
    $category->parent_id = $request->input('parent_id');
    $category->title = $request->input('title');
    $category->active = $request->input('active');
    $category->ordering = $request->input('ordering');
    if ($category->ordering == 0)  $category->ordering = getLastOrdering('thirdyparties_categories', 'ordering', $category->parent_id, array()) + 1;
    $category->save();
    return to_route('thirdpartiescategories.index')->with('success', 'Categoria inserita!');
  }

  public function edit($id)
  {
    $category = ThirdpartiesCategories::findOrFail($id);
    return view('thirdpartiescategories.form', ['category' => $category])
    ->with('categories',$this->categories);
  }

  public function update(ThirdpartiesCategoryRequest $request, $id)
  {
    if (!$request->has('active')) {
      $request->merge(['active' => 0]);
    }
    $category = ThirdpartiesCategories::findOrFail($id);
    $old_parent_id = $category->getOriginal('parent_id');
    $category->title = $request->input('title');
    $category->parent_id = $request->input('parent_id');
    $category->active = $request->input('active');
    $category->ordering = $request->input('ordering');
    if ($category->parent_id <> $old_parent_id)  $category->ordering = getLastOrdering('thirdparties_categories', 'ordering', $category->parent_id, array()) + 1;
    $category->save();
    return to_route('thirdpartiescategories.index')->with('success', 'Categoria modificata!');
  }

  public function destroy($id)
  {
    // controlla se è possibile cancellare
    if (ThirdpartiesCategories::isfreetodelete($id) == false) {
      return to_route('thirdpartiescategories.index')->with('error', 'Non è possibile cancellare la categoria!');
    }
    $thirdpartiesCategories = ThirdpartiesCategories::findOrFail($id);
    $thirdpartiesCategories->delete();
    // sistema ordering
    optimizeFieldOrdering($table = 'thirdparties_categories', $fieldOrder = 'ordering', $fieldParent = array('parent_id'), $fieldParentValue = array($thirdpartiesCategories->parent_id));
    return to_route('thirdpartiescategories.index')->with('success', 'Categoria cancellata!');
  }

  public function lessordering($id, $foo)
  {
    $thirdpartiesCategories = ThirdpartiesCategories::findOrFail($id);
    $result = lessorder($id,$table = 'thirdparties_categories', 
      $opt = array(
        'fieldParent' => array('parent_id'), 
        'fieldParentValue' => array($thirdpartiesCategories->parent_id)
      )
    );

    if ($result == false) {
      return to_route('thirdpartiescategories.index')->with('error', 'Categoria NON spostata.');
    }
    return to_route('thirdpartiescategories.index')->with('success', 'Categoria spostata.');
  }


  public function moreordering($id, $foo)
  {
    $thirdpartiesCategories = ThirdpartiesCategories::findOrFail($id);
    $result = moreorder(
      $id, 
      $table = 'thirdparties_categories', 
      $opt = array(
        'fieldParent' => array('parent_id'), 
        'fieldParentValue' => array($thirdpartiesCategories->parent_id)
      )
    );

    if ($result == false) {
      return to_route('thirdpartiescategories.index')->with('error', 'Categoria NON spostata.');
    }
    return to_route('thirdpartiescategories.index')->with('success', 'Categoria spostata.');
  }

}
