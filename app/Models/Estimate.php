<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

use App\Models\Estimatesarticle;

use Carbon\Carbon;
use Config;


class Estimate extends Model
{
    use HasFactory;

    protected $appends = ['articles_total','total','tax','total_tax'];


  public function getArticlestotalAttribute(){
    $foo = Estimatesarticle::where('estimate_id','=',$this->id)->get()->sum('total');
    return $foo;
  }

  public function getTaxAttribute(){
    $foo = Config::get('settings.estimate_tax');
    return $foo;
  }

  public function getTotaltaxAttribute(){
    $foo = ($this->articles_total * $this->tax) / 100;
    return $foo;
  }
  public function getTotalAttribute(){
    $foo = $this->articles_total + $this->total_tax;
    return $foo;
  }

   
}
