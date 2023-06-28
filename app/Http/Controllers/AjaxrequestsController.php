<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AjaxrequestsController extends Controller
{

  public function getcitiesjsonfromdb(Request $request)
  {
    $province_id = $request->input('location_province_id', 0);
    $comuniArray[] = array('nome'=>'Altra città','id'=>0);

    if ($province_id > 0) {

      $foo = DB::table('location_cities')
      ->where('location_province_id', '=', $province_id)
      ->where('active','=',1)
      ->get();

      foreach ($foo AS $row) {
        $comuniArray[] = array('nome'=>$row->nome,'id'=>$row->id);
      }
      
    }
    echo json_encode($comuniArray);
    die();
  }


  public function setdbrowactive(Request $request)
  {
    $token = $request->input('_token', '');
    $table = $request->input('table', '');
    $id = $request->input('id', 0);
    $label = $request->input('label', 'Voce');
    $labelsex = $request->input('labelsex', 'a');
    $icon = 'fa fa-exclamation-triangle';
    $value = 0;

    $foo = csrf_token();

    if ($foo !== $token) {
      $response = array(
        'error' => 1,
        'icon' => $icon,
        'message' => 'Non hai passato il token corretto!',
        'title' => 'Non hai passato il token corretto!',
        'value' => $value
      );
      echo json_encode($response);
      die();
    }



    if ($id == 0  || $table == '') {
      $response = array(
        'error' => 1,
        'icon' => $icon,
        'message' => 'Non hai passato i parametri corretti!',
        'title' => 'Non hai passato i parametri corretti!',
        'value' => $value
      );
      echo json_encode($response);
      die();
    }

    // prende il valore corrente
    $foo = $user = DB::table($table)->find($id);
    //dd($foo);
    if (!isset($foo->id) || (isset($foo->id) && $foo->id == 0)) {
      $response = array(
        'error' => 1,
        'icon' => $icon,
        'message' => 'Nessuna voce trovata!',
        'title' => 'Nessuna voce trovata!',
        'value' => $value
      );
      echo json_encode($response);
      die();
    }

    $value = 0;
    $icon = 'bx bx-lock-alt text-danger';
    $message = ucfirst(preg_replace('/%ITEM%/', $label, '%ITEM% disattivato')) . '!';
    $title = ucfirst(preg_replace('/%ITEM%/', $label, 'attiva %ITEM%'));
    if ($labelsex == 'a') $message = ucfirst(preg_replace('/%ITEM%/', $label, '%ITEM% disattivata')) . '!';

    if ($foo->active == 0) {
      $value = 1;
      $icon = 'bx bx-lock-open-alt text-success';
      $message = ucfirst(preg_replace('/%ITEM%/', $label, '%ITEM% attivato')) . '!';
      $title = ucfirst(preg_replace('/%ITEM%/', $label, 'disattiva %ITEM%'));
      if ($labelsex == 'a') $message = ucfirst(preg_replace('/%ITEM%/', $label, '%ITEM% attivato')) . '!';
    }

    $affected = DB::table($table)
      ->where('id', $id)
      ->update(['active' => $value]);



    $response = array(
      'error' => 0,
      'icon' => $icon,
      'message' => $message,
      'title' => $title,
      'value' => $value
    );
    echo json_encode($response);
    die();
  }
}
