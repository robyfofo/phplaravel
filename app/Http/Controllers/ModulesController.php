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

  private $searchfromtable = '';
  private $orderType = 'ASC';

  public function index(Request $request)
  {
      
    // numero pagine
    if ( $request->session()->missing('modules itemsforpage') ) $request->session()->put('modules itemsforpage',10);  
    if (request()->input('itemsforpage')) $request->session()->put('modules itemsforpage',request()->input('itemsforpage'));  
    
    // ricerca 
    $request->session()->put('modules searchfromtable', '');
    if (request()->input('searchfromtable')) $request->session()->put('modules searchfromtable', request()->input('searchfromtable'));

    $appJavascriptLinks = array('<script src="js/modules/modules.index.20230612.js"></script>');
      
    $modules = Module::orderBy('ordering', $this->orderType)
      ->where(function($query) {
        $query->where('name', 'like', '%' . request()->session()->get('modules searchfromtable') . '%')
        ->orWhere('alias', 'like', '%' . request()->session()->get('modules searchfromtable') . '%')
        ->orWhere('label', 'like', '%' . request()->session()->get('modules searchfromtable') . '%')
        ->orWhere('content', 'like', '%' . request()->session()->get('modules searchfromtable') . '%');
      })
      ->paginate(request()->session()->get('pmodules itemsforpage'));

    return view('modules.index', ['modules' => $modules])
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
    $module = Module::FindOrNew(0);
    $module->active = 1;
    $module->ordering = 0;
    return view('modules.form')
    -> with('module', $module);
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
    if ($module->ordering == 0)  $module->ordering = getLastOrdering('modules', 'ordering',array()) + 1;
    $module->active = $request->input('active');
    $module->save();

    return to_route('modules.index');
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
    return view('modules.form',['module'=>$module]);
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
    if (!$request->has('active')) $request->merge(['active' => 0]);
    
    $module = Module::findOrFail($id);
		$module->name = $request->input('name');
		$module->label = $request->input('label');
		$module->alias = $request->input('alias');
		$module->content = $request->input('content');
		$module->code_menu = $request->input('code_menu');
		$module->active = $request->input('active');
		$module->ordering = $request->input('ordering');
    if ($module->ordering == 0)  $module->ordering = getLastOrdering('modules', 'ordering',array()) + 1;
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
