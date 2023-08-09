<?php

namespace App\Models;

use Illuminate\Http\Request;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Estimatesarticle extends Model
{
  use HasFactory;
  public $timestamps = false;
  protected $table = 'estimates_articles';
  protected $appends = ['price_total','price_tax','article_total'];

  public $articlestotal;
  public $article_tax;

  public function __construct()
  {
    $this->article_tax = 10;
    $this->articlestotal = [];
  }


  public function getPriceTotalAttribute(){
    $foo = ($this->price_unity * $this->quantity);
    return $foo;
  }

  public function getPriceTaxAttribute(){
    $foo = ($this->price_unity * $this->quantity);
    $foo1 = ($foo * $this->article_tax)/100;
    return $foo1;
  }

  public function getArticleTotalAttribute(){
    $foo = ($this->price_unity * $this->quantity);
    $foo1 = ($foo * $this->article_tax)/100;
    $foo2 = $foo + $foo1;

    //$this->attributes['articlestotal'] = 'aaaa';
    $this->articlestotal[] = 'aaaaa';
    return $foo2;
  }

  public function sumArticles() {
    $this->articlestotal = ['7','8','9','10','11'];
    return $this->articlestotal;
    //return array_sum($this->articlestotal);
  }

}
