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
    $thirdpartiesCategory = new ThirdpartiesCategories;
    $ordering = getLastOrdering('thirdparties_categories', 'ordering', array());
    return view('thirdpartiescategories.create')
    ->with('ordering', $ordering)
    ->with('categories',$this->categories);
  }

  public function store(ThirdpartiesCategoryRequest $request)
  {

    if (!$request->has('active')) $request->merge(['active' => 0]);

    $thirdpartiesCategory = new ThirdpartiesCategories;
    $thirdpartiesCategory->title = $request->input('title');
    $thirdpartiesCategory->active = $request->input('active');
    $thirdpartiesCategory->ordering = $request->input('ordering');
    $thirdpartiesCategory->save();

    return to_route('thirdpartiescategories.index')->with('success', 'Categoria inserita!');
  }

  public function edit($id)
  {
    $thirdpartiesCategory = ThirdpartiesCategories::findOrFail($id);
    return view('thirdpartiescategories.edit', ['thirdpartiesCategory' => $thirdpartiesCategory])
    ->with('categories',$this->categories);
  }

  public function update(ThirdpartiesCategoryRequest $request, $id)
  {

    if (!$request->has('active')) {
      $request->merge(['active' => 0]);
    }

    $thirdpartiesCategory = ThirdpartiesCategories::findOrFail($id);
    $thirdpartiesCategory->title = $request->input('title');
    $thirdpartiesCategory->parent_id = $request->input('parent_id');
    $thirdpartiesCategory->active = $request->input('active');
    $thirdpartiesCategory->ordering = $request->input('ordering');
    $thirdpartiesCategory->save();

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
