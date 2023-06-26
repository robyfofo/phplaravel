<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Controllers\PermissionsController;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

use App\Models\Level;
use App\Http\Requests\LevelRequest;

class LevelsController extends Controller
{
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Contracts\View\View
   */

  private $itemsforpage = 2;
  private $page = 1;
  private $searchFromTable = '';
  private $orderType = 'ASC';

  public function index(Request $request)
  {
      
    // numero pagine
    if ( $request->session()->missing('levels itemsforpage') ) $request->session()->put('levels itemsforpage',10);  
    if (request()->input('itemsforpage')) $request->session()->put('levels itemsforpage',request()->input('itemsforpage'));  
    
    // paginazione
    if ( $request->session()->missing('levels page') ) $request->session()->put('levels page',1);  
    if (request()->input('page')) $request->session()->put('levels page',request()->input('page'));  

    if ( $request->session()->has('levels itemsforpage') ) $this->itemsforpage = $request->session()->get('levels itemsforpage');
    if ( $request->session()->has('levels page') ) $this->page = $request->session()->get('levels page');

    // ricerca 
    if ( $request->session()->missing('levels searchFromTable') ) $request->session()->put('levels searchFromTable','');  
    if (request()->input('searchFromTable')) {
        $request->session()->put('levels searchFromTable',request()->input('searchFromTable'));  
    } else {
        $request->session()->put('levels searchFromTable','');   
    }
    if ( $request->session()->has('levels searchFromTable') ) $this->searchFromTable = $request->session()->get('levels searchFromTable');

    $where = array();
    $fieldsSearch = array('title');
    if ($this->searchFromTable != '') {
      $words = explode(',', $this->searchFromTable);
      if (count($fieldsSearch) > 0) {
        foreach ($fieldsSearch as $key => $value) {
          if (count($words) > 0) {
            foreach ($words as $value1) {
              $where[] = array($value, 'LIKE', '%' . $value1 . '%');
            }
          }
        }
      }
    }

    $appJavascriptLinks = array('<script src="js/levels/levels.index.20230612.js"></script>');
      
    $levels = Level::orderBy('title', $this->orderType)
      ->where($where)
      ->paginate($this->itemsforpage);



    // ciclo per integrare la lista moduli
    foreach($levels AS $key=>$row) {
      
      $level_modules_rigths = (new PermissionsController)->getLevelModulesRights($row->id);
      $modules = array();
      foreach ($level_modules_rigths AS $k1=>$v1) {	
        if ($v1->read_access == 1 || $v1->write_access == 1) {
          $modules[] = $k1;   	
        } 
      }
      $row->modules = implode(', ',$modules);

      $levels[$key] = $row;
    }


    return view('levels.index', ['levels' => $levels])
      ->with('itemsforpage', $this->itemsforpage)
      ->with('searchFromTable', $this->searchFromTable)
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
    $allModulesActive = app('allModulesActive');

    $level = new Level;
    $ordering = getLastOrdering('levels', 'ordering', array());
    return view('levels.create')->with('ordering', $ordering);
  }

  /**
     * Store a newly created resource in storage.
     *
     * @param  LevelRequest  $request
     * @return \Illuminate\Http\RedirectResponse
  */
  public function store(LevelRequest $request)
  {
    if (!$request->has('active')) $request->merge(['active' => 0]);

    $level = new Level;
    $level->title = $request->input('title');
    $level->modules = $request->input('modules');
    $level->active = $request->input('active');
    $level->save();

    // salva le associazioni livello
    $allModulesActive = app('allModulesActive');
    $users_id = 0;

    foreach($allModulesActive AS $module) {		
      $accessread = 0;
      if (isset($request->get('modules_read')[$module->id])) $accessread = $request->get('modules_read')[$module->id];
      $accesswrite = 0;
      if (isset($request->get('modules_write')[$module->id])) $accesswrite = $request->get('modules_write')[$module->id];
      // salva nel database
      DB::insert('insert into modules_levels_access (modules_id, levels_id, users_id, read_access, write_access) values (?, ?, ?, ?, ? )', [$module->id,$level->id,$users_id,$accessread,$accesswrite]);
    }

    return to_route('levels.index');
  }

  /**
   * Display the specified resource.
   *
   * @param  int  $id
   * @return \Illuminate\Contracts\View\View
   */
  public function show($id)
  {
      $level = Level::findOrFail($id);
      return view('levels.show',['module'=>$level]);
  }

  /**
   * Show the form for editing the specified resource.
   *
   * @param  int  $id
   * @return \Illuminate\Contracts\View\View
   */
  public function edit($id)
  {
    $level_modules_rigths = (new PermissionsController)->getLevelModulesRights($id);
    //var_dump($level_modules_rigths);die();

    $allModulesActive = app('allModulesActive');
    $level = Level::findOrFail($id);

    return view('levels.edit',['level'=>$level])->with('level_modules_rigths',$level_modules_rigths);
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  LevelRequest  $request
   * @param  int  $id
   * @return \Illuminate\Http\RedirectResponse
   */
  public function update(LevelRequest $request,$id)
  {
    if (!$request->has('active')) {
      $request->merge(['active' => 0]);
    }

    // salva le associazioni livello
    $allModulesActive = app('allModulesActive');
    $users_id = 0;
     // asserra i record con lo stesso livello
     DB::insert('delete from modules_levels_access where levels_id = ?', [$id]);

    foreach($allModulesActive AS $module) {		
      $accessread = 0;
      if (isset($request->get('modules_read')[$module->id])) $accessread = $request->get('modules_read')[$module->id];
      $accesswrite = 0;
      if (isset($request->get('modules_write')[$module->id])) $accesswrite = $request->get('modules_write')[$module->id];
      // salva nel database
      DB::insert('insert into modules_levels_access (modules_id, levels_id, users_id, read_access, write_access) values (?, ?, ?, ?, ? )', [$module->id,$id,$users_id,$accessread,$accesswrite]);
    }
    
    $level = Level::findOrFail($id);
    $level->title = $request->input('title');
    $level->modules = $request->input('modules');
		$level->active = $request->input('active');
    $level->save();
    return to_route('levels.index')->with('success', 'Livello modificato!');
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  int  $id
   * @return \Illuminate\Http\RedirectResponse
   */
  public function destroy($id)
  {
    // cancella associazioni livello
    DB::table('modules_levels_access')->where('levels_id', $id)->delete();

    $level = Level::findOrFail($id);
    //$level->delete();
    return to_route('levels.index')->with('success', 'Livello cancellato!');
  }

}
