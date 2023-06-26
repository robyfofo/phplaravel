<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class PermissionsController extends Controller
{
  /**
   * Create a new controller instance.
   *
   * @return void
   */
  public function __construct()
  {
  }

  public function getLevelModulesRights($id)
  {
    $foo = DB::table('modules_levels_access')
    ->join('modules', 'modules_levels_access.modules_id', '=', 'modules.id')
    ->select('modules_levels_access.*', 'modules.name AS module')
    ->where('modules_levels_access.levels_id', '=', $id)
    ->get()
    ->keyBy('module');
    return $foo;
  }
}
