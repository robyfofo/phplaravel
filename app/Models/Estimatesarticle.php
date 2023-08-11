<?php

namespace App\Models;

use Illuminate\Http\Request;
use Config;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Estimatesarticle extends Model
{
  use HasFactory;
  public $timestamps = false;
  protected $table = 'estimates_articles';
  protected $appends = ['price_total','tax','price_tax','total'];

  public function __construct()
  {
  }


  public function getPriceTotalAttribute(){
    $foo = ($this->price_unity * $this->quantity);
    return $foo;
  }

  public function getTaxAttribute(){
    $foo = Config::get('settings.estimate_article_tax');
    return $foo;
  }

  public function getPriceTaxAttribute(){
    $foo = ($this->price_unity * $this->quantity);
    $foo1 = ($foo * $this->tax)/100;
    return $foo1;
  }

  public function getTotalAttribute(){
    $foo = ($this->price_unity * $this->quantity);
    $foo1 = ($foo * $this->tax)/100;
    $foo2 = $foo + $foo1;
    return $foo2;
  }

}
