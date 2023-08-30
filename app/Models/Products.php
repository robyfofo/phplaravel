<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

use App\Models\Categories;

class Products extends Model
{
  use HasFactory;
  protected $appends = ['category'];

  public function getCategoryAttribute()
  {
    if ($this->categories_id != '') {
      $foo = Categories::where('id','=',$this->categories_id)->where('active','=',1)->first();
      return $foo->title;
    } else {
      return false;
    }
  }

}
