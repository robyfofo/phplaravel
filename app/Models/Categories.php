<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Categories extends Model
{
  use HasFactory;

  public static function tree() 
  {
  $allCategories = Categories::get();
  
    $rootCategories = $allCategories->whereNull('parent_id');
    foreach ($rootCategories AS $rootCategory) {
      $rootCategoriy->children = $allCategories->where('parent_id',$rootCategory->id);
    }

    return $rootCategories;

  }
}
