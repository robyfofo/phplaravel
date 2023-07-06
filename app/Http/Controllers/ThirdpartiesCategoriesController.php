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
  private $searchFromTable = '';
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
    //$thirdpartiesCategory->ordering = $request->input('ordering');
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
    //optimizeFieldOrdering($table = 'projects', $fieldOrder = 'ordering', $fieldParent = array(), $fieldParentValue = array());
    return to_route('thirdpartiescategories.index')->with('success', 'Categoria cancellata!');
  }

}
