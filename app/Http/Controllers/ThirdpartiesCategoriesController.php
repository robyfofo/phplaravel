<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;

use Illuminate\Http\Request;


use App\Models\ThirdpartiesCategories;

use App\Http\Requests\ThirdpartiesCategoriesRequest;


class ThirdpartiesCategoriesController extends Controller
{

  private $itemsforpage = 2;
  private $page = 1;
  private $searchFromTable = '';
  private $orderType = 'ASC';

  public function __construct()
  {

  }

  public function index()
  {
    $categories = ThirdpartiesCategories::tree();


    $appCssLinks = array(
      '<link href="/plugins/jquery.treegrid/jquery.treegrid.css" rel="stylesheet">'
    );
    $appJavascriptLinks = array(
      '<script src="/plugins/jquery.cookie/jquery.cookie.js" type="text/javascript"></script>',
      '<script src="/plugins/jquery.treegrid/jquery.treegrid.min.js" type="text/javascript"></script>',
      '<script src="js/modules/thirdpartiescategories.index.20230612.js"></script>'
    );

    return view('thirdpartiescategories.index',['categories' => $categories])
    ->with('appCssLinks', $appCssLinks)
    ->with('appJavascriptLinks', $appJavascriptLinks);

  }

  public function create()
  {

  }

  public function edit()
  {
    
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
