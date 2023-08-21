<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Thirdparty extends Model
{
  use HasFactory;
  protected $appends = ['nation','provincia','city'];


  public function getNationAttribute()
  {
    if ($this->location_nations_id > 0) {
      $foo = DB::table('location_nations')->where('id','=',$this->location_nations_id)->where('active','=',1)->first();
      return $foo->title_it;
    }
    return false;
  }

  public function getProvinciaAttribute()
  {
    if ($this->location_province_id > 0) {
      $foo = DB::table('location_province')->where('id','=',$this->location_province_id)->where('active','=',1)->first();
      return $foo->nome;
    } else if ($this->provincia_alt != '') {
      return $this->provincia_alt;
    } else {
      return 'n.d';
    }
    return false;
  }

  public function getCityAttribute()
  {
    if ($this->location_cities_id > 0) {
      $foo = DB::table('location_cities')->where('id','=',$this->location_cities_id)->where('active','=',1)->first();
      return $foo->nome;
    } else if ($this->city_alt != '') {
      return $this->city_alt;
    } else {
      return 'n.d';
    }
    return false;
  }

}
