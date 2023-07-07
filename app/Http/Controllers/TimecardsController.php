<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;

use Illuminate\Http\Request;


use App\Models\Timecard;

use App\Http\Requests\TimecarsRequest;


class TimecardsController extends Controller
{
  function index(Request $request)
  {

    $result = Timecard::getCalendar();
    foreach($result AS $value) {

      echo $value->content;
      echo $value->level;
    }
    die();
   
  }
}
