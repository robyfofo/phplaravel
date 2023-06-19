<?php

use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\DB;

//use App\Models\LeftMenu;

/*
function leftmenu()
{
  $leftMenu = LeftMenu::all();
  $outputmenu = '';
  foreach (LeftMenu::all() as $module) {
    $output = '';


    $menu = json_decode($module->code_menu) or die('Errore nel campo menu. Formato Json non valido!' . $module->code_menu);

    $classLiMain = ' class="nav-item"';
    $moduleName = (isset($module->name) ? $module->name : '');
    $moduleLabel = (isset($module->label) ? $module->label : '');

    $menuName = (isset($menu->name) ? $menu->name : '');
    $menuIcon = (isset($menu->icon) ? $menu->icon : '');
    $menuAction = (isset($menu->action) ? $menu->action : '');
    $menuLabel = (isset($menu->label) ? $menu->label : '');

    $output .= '<li' . $classLiMain . '><a class="nav-link" href="/' . $moduleName . '">' . $menuIcon . '<span>' . $menuLabel . '</span></a></li>' . PHP_EOL;

    // sostituiso il modulename con la localizzazione se esiste
    $output = preg_replace('/%LABEL%/', $moduleLabel, $output);
    $output = preg_replace('/%NAME%/', $moduleLabel, $output);

    $outputmenu .= $output;
  }
  return $outputmenu;
}
*/
function lessorder($id, $table = '', $opt = array())
{
  $orderingFieldRif = 'ordering';
  if ($table == '') return false;
  // trovo l'ordering della voce indicata 
  $item = DB::table($table)->where('id', '=', $id)->get()->first();
  if (!isset($item->$orderingFieldRif) || (isset($item->$orderingFieldRif) && $item->$orderingFieldRif == 0)) {
    return false;
  }
  // controlla se vi sono voci con ordinamento inferiore
  $items = DB::table($table)->where($orderingFieldRif, '<', $item->$orderingFieldRif)->get();
  if (count($items) == 0) return false;

  // aumento +1 le voci con ordine superiore
  $foo = $item->$orderingFieldRif;
  DB::table($table)->where($orderingFieldRif, '=', $item->$orderingFieldRif - 1)->update([$orderingFieldRif => $foo]);

  // diminuisco -1 la voce selezionata
  $foo = $item->$orderingFieldRif - 1;
  DB::table($table)->where('id', '=', $id)->update([$orderingFieldRif => $foo]);

  return true;
}

function moreorder($id, $table = '', $opt = array())
{

  $orderingFieldRif = 'ordering';
  if ($table == '') return false;
  // trovo l'ordering della voce indicata 
  $item = DB::table($table)->where('id', '=', $id)->get()->first();
  //dd($item);
  //echo 'item->ordering: '.$item->$orderingFieldRif;
  if (!isset($item->$orderingFieldRif) || (isset($item->$orderingFieldRif) && $item->$orderingFieldRif == 0)) {
    return false;
  }
  // controlla se vi sono voci con ordinamento superiore
  $items = DB::table($table)->where($orderingFieldRif, '>', $item->$orderingFieldRif)->get();
  //dd($items);
  if (count($items) == 0) return false;

  // dimuniusco -1 le voci con ordine superiore
  $foo = $item->$orderingFieldRif;
  DB::table($table)->where($orderingFieldRif, '=', $item->$orderingFieldRif + 1)->update([$orderingFieldRif => $foo]);

  // aumento +1 la voce selezionata
  $foo = $item->$orderingFieldRif + 1;
  DB::table($table)->where('id', '=', $id)->update([$orderingFieldRif => $foo]);
  return true;
}

function optimizeFieldOrdering($table = '', $fieldOrder = 'ordering', $fieldParent = array(), $fieldParentValue = array())
{
  if ($table == '') return false;
  // prelevo tutti i records
  $foo = DB::table($table)->get();
  if (count($foo) == 0) return false;
  $o = 1;
  foreach ($foo as $value) {
    DB::table($table)->where('id', '=', $value->id)->update([$fieldOrder => $o]);
    $o++;
  }
  return true;
}

function getLastOrdering($table, $field = 'ordering', $clause = '')
{
  if ($table == '') return false;
  $foo = DB::table($table)->max('id');
  return $foo;
}

function showUserAvatar($id,$alt,$class)
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