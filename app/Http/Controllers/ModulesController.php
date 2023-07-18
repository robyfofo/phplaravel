<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;


use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

use App\Models\Module;
use App\Http\Requests\ModuleRequest;

class ModulesController extends Controller
{
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Contracts\View\View
   */

  private $itemsforpage = 2;
  private $page = 1;
  private $searchfromtable = '';
  private $orderType = 'ASC';

  public function index(Request $request)
  {
      
    // numero pagine
    if ( $request->session()->missing('modules itemsforpage') ) $request->session()->put('modules itemsforpage',10);  
    if (request()->input('itemsforpage')) $request->session()->put('modules itemsforpage',request()->input('itemsforpage'));  
    
    // paginazione
    if ( $request->session()->missing('modules page') ) $request->session()->put('modules page',1);  
    if (request()->input('page')) $request->session()->put('modules page',request()->input('page'));  

    if ( $request->session()->has('modules itemsforpage') ) $this->itemsforpage = $request->session()->get('modules itemsforpage');
    if ( $request->session()->has('modules page') ) $this->page = $request->session()->get('modules page');

    // ricerca 
    if ( $request->session()->missing('projeks searchfromtable') ) $request->session()->put('projeks searchfromtable','');  
    if (request()->input('searchfromtable')) {
        $request->session()->put('projeks searchfromtable',request()->input('searchfromtable'));  
    } else {
        $request->session()->put('projeks searchfromtable','');   
    }
    if ( $request->session()->has('projeks searchfromtable') ) $this->searchfromtable = $request->session()->get('projeks searchfromtable');

    $where = array();
    $fieldsSearch = array('name','label','alias','content');
    if ($this->searchfromtable != '') {
      $words = explode(',',$this->searchfromtable);
      if (count($fieldsSearch) > 0) {
        foreach($fieldsSearch AS $key=>$value){					
          if (count($words) > 0) {
            foreach($words AS $value1){
              $where[] = array($value, 'LIKE', '%'.$value1.'%');
            }
          }		
        }			
      }
    }

    $appJavascriptLinks = array('<script src="js/modules/modules.index.20230612.js"></script>');
      
    $modules = Module::orderBy('ordering', $this->orderType)
      ->where($where)
      ->paginate($this->itemsforpage);

    return view('modules.index', ['modules' => $modules])
      ->with('itemsforpage', $this->itemsforpage)
      ->with('searchfromtable', $this->searchfromtable)
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
    $project = new Module;
    $ordering = getLastOrdering('modules', 'ordering', array());
    return view('modules.create')->with('ordering', $ordering);
  }

  /**
     * Store a newly created resource in storage.
     *
     * @param  ModuleRequest  $request
     * @return \Illuminate\Http\RedirectResponse
  */
  public function store(ModuleRequest $request)
  {
    if (!$request->has('active')) $request->merge(['active' => 0]);

    $module = new Module;
    $module->name = $request->input('name');
    $module->label = $request->input('label');
    $module->alias = $request->input('alias');
    $module->content = $request->input('content');
    $module->code_menu = $request->input('code_menu');
    $module->ordering = $request->input('ordering');
    $module->active = $request->input('active');
    $module->save();

    return to_route('modules.index');
  }

  /**
   * Display the specified resource.
   *
   * @param  int  $id
   * @return \Illuminate\Contracts\View\View
   */
  public function show($id)
  {
      $module = Module::findOrFail($id);
      return view('modules.show',['module'=>$module]);
  }

  /**
   * Show the form for editing the specified resource.
   *
   * @param  int  $id
   * @return \Illuminate\Contracts\View\View
   */
  public function edit($id)
  {
      $module = Module::findOrFail($id);
      return view('modules.edit',['module'=>$module]);
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  ModuleRequest  $request
   * @param  int  $id
   * @return \Illuminate\Http\RedirectResponse
   */
  public function update(ModuleRequest $request,$id)
  {
    if (!$request->has('active')) {
      $request->merge(['active' => 0]);
    }
    
    $module = Module::findOrFail($id);
		$module->name = $request->input('name');
		$module->label = $request->input('label');
		$module->alias = $request->input('alias');
		$module->content = $request->input('content');
		$module->code_menu = $request->input('code_menu');
		$module->ordering = $request->input('ordering');
		$module->active = $request->input('active');
    $module->save();
    return to_route('modules.index')->with('success', 'Modulo modificato!');
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  int  $id
   * @return \Illuminate\Http\RedirectResponse
   */
  public function destroy($id)
  {
    $module = Module::findOrFail($id);
    $module->delete();
    optimizeFieldOrdering($table = 'modules', $fieldOrder = 'ordering', $fieldParent = array(), $fieldParentValue = array());
    return to_route('modules.index')->with('success', 'Modulo cancellato!');
  }

  public function moreordering($id, $foo)
  {
    $result = moreorder($id, $table = 'modules', $opt = array());
    if ($result == false) {
      return to_route('modules.index')->with('error', 'Modulo NON spostato.');
    }
    return to_route('modules.index')->with('success', 'Modulo spostato.');
  }

  public function lessordering($id, $foo)
  {
    $result = lessorder($id, $table = 'modules', $opt = array());
    if ($result == false) {
      return to_route('modules.index')->with('error', 'Modulo NON spostato.');
    }
    return to_route('modules.index')->with('success', 'Modulo spostato.');
  }





}
