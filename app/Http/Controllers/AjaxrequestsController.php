<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\Models\Project;

class AjaxrequestsController extends Controller
{

  public function getprojecttimecards(Request $request) {
    $token = $request->input('_token', '');
    $id = $request->input('id', 0);
    if (csrf_token() !== $token) {
      return 'Non hai passato il token corretto!';
    }
    $totaltime = Project::getprojecttimecardsum($id);
    $totaltimemc = Project::getprojecttimecardsummc($id);
    $totaltimemp = Project::getprojecttimecardsummp($id);
    $output = '<table class="table table-striped table-condensed"><tbody><tr><td>Tempo lavorato totale:</td><td class="text-end">'.$totaltime.'</td></tr><tr><td><strong>Tempo lavorato mese corrente:</strong></td><td class="text-end"><strong>'.$totaltimemc.'</strong></td></tr><tr><td>Tempo lavorato mese precedente:</td><td class="text-end">'.$totaltimemp.'</td></tr></tbody></table>';
    return $output;
  }

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

  public function getcityjsonfromdb(Request $request)
  {
    $cities_id = $request->input('location_cities_id', 0);
    $token = $request->input('_token', '');
    if (csrf_token() !== $token) {
      echo json_encode( array('error' => 1,'message' => 'Non hai passato il token corretto!') );
      die();
    }
    if ($cities_id == 0) {
      echo json_encode( array('error' => 1,'message' => 'Non hai passato la citta!') );
      die();
    }


    $foo = DB::table('location_cities')->where('id','=',$cities_id)->where('active','=',1)->first();

    echo json_encode( array('error' => 0,'message' => '','data' => $foo) );
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
