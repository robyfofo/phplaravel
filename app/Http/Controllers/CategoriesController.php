<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;


use App\Models\Categories;



class CategoriesController extends Controller
{

  public function index()
  {
     $foo = Categories::tree();
     dd($foo);

  }

  

}
