<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\belongsTo;

class ThirdpartiesCategories extends Model
{
  use HasFactory;

  protected $appends = ['level'];

  public static function tree() 
  {
    $level = 0;
    $allCategories = ThirdpartiesCategories::get();
    $rootCategories = $allCategories->whereNull('parent_id');
   
    self::formatTree($rootCategories,$allCategories,$level);
    return $rootCategories;
  }

  public static function formatTree($categories,$allCategories,$level)
  {

    foreach ($categories AS $category) {
      $level++;
      $category->children = $allCategories->where('parent_id',$category->id)->values();

      $category->children->level = $level;

      if ($category->children->isNotEmpty()) {
        self::formatTree($category->children,$allCategories,$level);
      }
    
    }

  }


  public static function isfreetodelete($id) {
    if (ThirdpartiesCategories::where('parent_id','=',$id)->count() > 0) return false;
    return U_TRUNCATED_CHAR_FOUND;
  }
}
