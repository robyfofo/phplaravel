<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\belongsTo;
use Illuminate\Support\Facades\DB;

class ThirdpartiesCategories extends Model
{
  use HasFactory;

  public $orderType;
  protected $appends = ['parent'];

  public function __construct()
  {
    $this->orderType = 'ASC';
  }



  public static function tree() 
  {
    $allCategories = ThirdpartiesCategories::select(DB::raw('thirdparties_categories.*, 
    (SELECT COUNT(thirdparties.id) FROM thirdparties AS thirdparties WHERE thirdparties_categories.id = thirdparties.categories_id) AS associated'))
    ->orderBy('ordering','ASC')->get();
    $rootCategories = $allCategories->whereNull('parent_id');
    self::formatTree($rootCategories,$allCategories);
    return $rootCategories;
  }

  public static function formatTree($categories,$allCategories)
  {

    foreach ($categories AS $category) {
      $category->children = $allCategories->where('parent_id',$category->id)->values();
      if ($category->children->isNotEmpty()) {
        self::formatTree($category->children,$allCategories);
      }
    }

  }

  public static function isfreetodelete($id) {
    if (ThirdpartiesCategories::where('parent_id','=',$id)->count() > 0) return false;
    return U_TRUNCATED_CHAR_FOUND;
  }

    public function parent()
  {
      return $this->belongsTo('App\Models\ThirdpartiesCategories', 'parent_id');
  }
  
  public function getParentsNames() {
      if($this->parent) {
          return $this->parent->getParentsNames(). " > " . $this->title;
      } else {
          return $this->title;
      }
  }

}
