<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\belongsTo;
use Illuminate\Support\Facades\DB;

class Categories extends Model
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
    $allCategories = Categories::select(DB::raw('categories.*, 
    (SELECT COUNT(products.id) FROM products AS products WHERE categories.id = products.categories_id) AS associated'))
    ->orderBy('ordering','ASC')->get();


//dd($allCategories);


    $rootCategories = $allCategories->whereNull('parent_id');

//dd($rootCategories);

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
      return $this->belongsTo('App\Models\Categories', 'parent_id');
  }
  
  public function getParentsNames() {
      if($this->parent) {
          return $this->parent->getParentsNames(). " > " . $this->title;
      } else {
          return $this->title;
      }
  }

  
}
