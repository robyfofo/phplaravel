<?php

use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;


use App\Models\LeftMenu;


function leftmenu($allModulesActive)
{
  Route::get('/')->name('home');
  $outputmenu = ' <!-- Dashboard -->
  <li class="menu-item'.(Route::is('home') ? ' active' : ' noactive').'">
    <a href="/home" class="menu-link">
      <i class="menu-icon tf-icons bx bx-home-circle"></i>
      <div data-i18n="Analytics">Home</div>
    </a>
  </li>';

  $foo = LeftMenu::all()->sortBy("ordering")->where('active','=',1);
  foreach ($allModulesActive as $module) {
    $output = '';

    $menu = json_decode($module->code_menu) or die('Errore nel campo menu. Formato Json non valido!' . $module->code_menu);
    $havesubmenu = 0;
		if (isset($menu->submenus) && count($menu->submenus)) $havesubmenu = 1;
    
    $classAhrefMain = 'menu-link';
    $moduleName = (isset($module->name) ? $module->name : '');
    $moduleLabel = (isset($module->label) ? $module->label : '');
    
    $menuName = (isset($menu->name) ? $menu->name : '');
    $menuIcon = (isset($menu->icon) ? $menu->icon : '');
    $menuAction = (isset($menu->action) ? $menu->action : '');
    $menuLabel = (isset($menu->label) ? $menu->label : '');

    $classLiMain = 'menu-item';
    $mainLink = '';
    if (Route::is($module->name.'.*')) $mainLink = 'active';
    if (Route::is($module->name.'*')) $mainLink = 'active';
    
    if ($mainLink == 'active') $classLiMain .= ' active';

    $menuAhref = '/'.$moduleName;

    if ($havesubmenu == 1) {
      $classAhrefMain = 'menu-link menu-toggle';
      $menuAhref = 'javascript:void(0);';
      if ($mainLink == 'active') $classLiMain .= ' open';
    }
    $output .= '<li class="' . $classLiMain . '">
    <a class="' . $classAhrefMain . '" href="' . $menuAhref . '">' . $menuIcon;
    $output .= '<div data-i18n="' . $moduleName . '">' . $moduleLabel . '</div>' . PHP_EOL;
    $output .= '</a>';

    // crea submenu
    $suboutput = '';
    if (isset($menu->submenus) && is_array($menu->submenus) && count($menu->submenus) > 0) {
    
      $suboutput .= '<ul class="menu-sub">';
      foreach ($menu->submenus AS $submenu) {
        //dd($submenu);
        $submanuLabel = $submenu->label;
        $submenuName = (isset($submenu->name) ? $submenu->name : '');
        $submenuIcon = (isset($submenu->icon) ? $submenu->icon : '');
        $submenuAction = (isset($submenu->action) ? $submenu->action : '');
        $submenuUrl = '/'.$moduleName.$submenuAction;
        $suboutput .= '
        <li class="menu-item">
          <a href="'.$submenuUrl.'" title="'.$submanuLabel.'" class="menu-link">
            <div data-i18n="Basic Inputs">'.$submanuLabel.'</div>
          </a>  
        </li>';
      }
      $suboutput .= '</ul>';
    }
    $output .= $suboutput.'</li>' . PHP_EOL;

    // sostituiso il modulename con la localizzazione se esiste
    $output = preg_replace('/%LABEL%/', $moduleLabel, $output);
    $output = preg_replace('/%NAME%/', $moduleLabel, $output);

    $outputmenu .= $output;
  }
  return $outputmenu;
}

function lessorder($id, $table = '', $opt = array())
{
  $fieldParent = ($opt['fieldParent'] ?? array());
  $fieldParentValue = ($opt['fieldParentValue'] ?? array());

  $orderingFieldRif = 'ordering';
  if ($table == '') return false;

  // setto il where
  $opwhere = array();
  if (count($fieldParent) > 0) {
    foreach ($fieldParent as $key => $value) {
      $opwhere[] = array($fieldParent[$key], '=',  $fieldParentValue[$key]);
    }
  }

    
  // trovo l'ordering della voce indicata 

  $where = array();
  $where[] = array('id', '=', $id);
  $where = array_merge($where,$opwhere);

  $item = DB::table($table)->where($where)->get()->first();
  if (!isset($item->$orderingFieldRif) || (isset($item->$orderingFieldRif) && $item->$orderingFieldRif == 0)) {
    return false;
  }

  // controlla se vi sono voci con ordinamento inferiore

  $where = array();
  $where[] = array($orderingFieldRif, '<', $item->$orderingFieldRif);
  $where = array_merge($where,$opwhere);

  $items = DB::table($table)->where($where)->get();
  if (count($items) == 0) return false;

  // aumento +1 le voci con ordine superiore
  $foo = $item->$orderingFieldRif;

  $where = array();
  $where[] = array($orderingFieldRif, '=', $item->$orderingFieldRif - 1);
  $where = array_merge($where,$opwhere);

  DB::table($table)->where($where)->update([$orderingFieldRif => $foo]);

  // diminuisco -1 la voce selezionata
  $foo = $item->$orderingFieldRif - 1;
  $where = array();
  $where[] = array('id', '=', $id);
  $where = array_merge($where,$opwhere);
  DB::table($table)->where($where)->update([$orderingFieldRif => $foo]);

  return true;
}

function moreorder($id, $table = '', $opt = array())
{

  $fieldParent = ($opt['fieldParent'] ?? array());
  $fieldParentValue = ($opt['fieldParentValue'] ?? array());

  $orderingFieldRif = 'ordering';
  if ($table == '') return false;

  // setto il where
  $opwhere = array();
  if (count($fieldParent) > 0) {
    foreach ($fieldParent as $key => $value) {
      $opwhere[] = array($fieldParent[$key], '=',  $fieldParentValue[$key]);
    }
  }

  // trovo l'ordering della voce indicata 
  $where = array();
  $where[] = array('id', '=', $id);
  $where = array_merge($where,$opwhere);
  $item = DB::table($table)->where($where)->get()->first();
  if (!isset($item->$orderingFieldRif) || (isset($item->$orderingFieldRif) && $item->$orderingFieldRif == 0)) {
    return false;
  }

  // controlla se vi sono voci con ordinamento superiore
  $where = array();
  $where[] = array($orderingFieldRif, '>', $item->$orderingFieldRif);
  $where = array_merge($where,$opwhere);
  $items = DB::table($table)->where($where)->get();
  if (count($items) == 0) return false;

  // dimuniusco -1 le voci con ordine superiore
  $foo = $item->$orderingFieldRif;
  $where = array();
  $where[] = array($orderingFieldRif, '=', $item->$orderingFieldRif + 1);
  $where = array_merge($where,$opwhere);
  DB::table($table)->where($where)->update([$orderingFieldRif => $foo]);

  // aumento +1 la voce selezionata
  $foo = $item->$orderingFieldRif + 1;
  $where = array();
  $where[] = array('id', '=', $id);
  $where = array_merge($where,$opwhere);
  DB::table($table)->where($where)->update([$orderingFieldRif => $foo]);
  return true;
}

function optimizeFieldOrdering($table = '', $fieldOrder = 'ordering', $fieldParent = array(), $fieldParentValue = array())
{
  if ($table == '') return false;
  // prelevo tutti i records
  $where = array();
  if (count($fieldParent) > 0) {
    foreach ($fieldParent as $key => $value) {
      $where[] = array($fieldParent[$key], '=',  $fieldParentValue[$key]);
    }
  }
  $foo = DB::table($table)
  ->where($where)
  ->get();

  if (count($foo) == 0) return false;
  $o = 1;
  foreach ($foo as $value) {
    DB::table($table)->where('id', '=', $value->id)->update([$fieldOrder => $o]);
    $o++;
  }
  return true;
}

function getLastOrdering($table, $field = 'ordering', $clause = array())
{
  $field = ($clause['field'] ?? '');
  $fieldValue = ($clause['fieldValue'] ?? '');

  if ($table == '') return false;
  $foo = DB::table($table)
  ->where(function($query) use($field,$fieldValue) {
    if ($field != '' && $fieldValue > 0) {
      $query->where($field, '=', $fieldValue);
    }
  })
  ->max('ordering');
  return $foo;
}

function showImageUserAvatar($id,$alt,$class)
{
  $avatar_info = '';
  $avatar = '';
  if ($id > 0) {
    $item = DB::table('users')->where('id', '=', $id)->get()->first();
    if (isset($item->id)) {
      $avatar = $item->avatar;
      $avatar_info = unserialize($item->avatar_info);

      if (isset($avatar_info['mimeType'])) {
        $src = 'data: ' . $avatar_info['mimeType'] . ';base64,' . $avatar;
        echo '<img src="' . $src . '" class="'.$class.'" alt="' . $alt . '">';
      }
    }
  }
}

function getImageUserAvatar($id)
{
  $avatar_info = '';
  $avatar = '';
  if ($id > 0) {
    $item = DB::table('users')->where('id', '=', $id)->get()->first();
    if (isset($item->id)) {
      $avatar = $item->avatar;
      $avatar_info = unserialize($item->avatar_info);

      if (isset($avatar_info['mimeType'])) {
        $src = 'data: ' . $avatar_info['mimeType'] . ';base64,' . $avatar;
        echo $src;
      }
    }
  }
}

function sumTheTime($times) 
{
  $seconds = 0;
  $sum_time = '00:00:00';
  if (isset($times) && is_array($times) && count($times) > 0) {
    foreach ($times as $time) {
      list($hour,$minute,$second) = explode(':', $time);
      $seconds += $hour*3600;
      $seconds += $minute*60;
      $seconds += $second;
    }
    $hours = floor($seconds/3600);
    $seconds -= $hours*3600;
    $minutes  = floor($seconds/60);
    $seconds -= $minutes*60;
    $sum_time = sprintf('%02d:%02d:%02d', $hours, $minutes, $seconds); // Thanks to Patrick
  }
  return $sum_time;
}