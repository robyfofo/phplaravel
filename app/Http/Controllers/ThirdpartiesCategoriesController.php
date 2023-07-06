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

  public function aaaindex(Request $request)
  {
    if ($request->session()->missing('thirdpartiescat itemsforpage')) $request->session()->put('thirdpartiescat itemsforpage', 10);
    if (request()->input('itemsforpage')) $request->session()->put('thirdpartiescat itemsforpage', request()->input('itemsforpage'));
    if ($request->session()->missing('thirdpartiescat page')) $request->session()->put('thirdpartiescat page', 1);
    if (request()->input('page')) $request->session()->put('thirdpartiescat page', request()->input('page'));
    if ($request->session()->has('thirdpartiescat itemsforpage')) $this->itemsforpage = $request->session()->get('thirdpartiescat itemsforpage');
    if ($request->session()->has('thirdpartiescat page')) $this->page = $request->session()->get('thirdpartiescat page');
    if ($request->session()->missing('thirdpartiescat searchFromTable')) $request->session()->put('thirdpartiescat searchFromTable', '');
    if (request()->input('searchFromTable')) {
      $request->session()->put('thirdpartiescat searchFromTable', request()->input('searchFromTable'));
    } else {
      $request->session()->put('thirdpartiescat searchFromTable', '');
    }
    if ($request->session()->has('thirdpartiescat searchFromTable')) $this->searchFromTable = $request->session()->get('thirdpartiescat searchFromTable');

    $appJavascriptLinks = array('<script src="js/modules/thirdpartiescategories.index.20230612.js"></script>');

    $categories = ThirdpartiesCategories::orderBy('id', $this->orderType)
    ->where(function($query) {
      $query->where('title', 'like', '%' . $this->searchFromTable . '%');
    })
    ->paginate($this->itemsforpage);

    return view('thirdpartiescategories.index',['categories' => $categories])
    ->with('itemsforpage', $this->itemsforpage)
    ->with('searchFromTable', $this->searchFromTable)
    ->with('orderType', $this->orderType)
    ->with('appJavascriptLinks', $appJavascriptLinks);
  }

  public function index()
  {
    $categories = ThirdpartiesCategories::tree();

    //dd($categories);die();

    return view('thirdpartiescategories.index',['categories' => $categories]);




  }

  /*
  public function multiLevelCategory(){
    $categories = Category::with('children')->get();
    $this->generateCategories($categories);
}
public function generateCategories($categories){
    foreach ($categories as $category) {
        echo '';
            echo '
' . $category->category . '
';
            if (count($category->children) > 0) {
                        $this->generateCategories($category->children);
            }
            echo '

';
    }
}
*/


  public function create()
  {

  }

}
