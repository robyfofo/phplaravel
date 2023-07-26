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

}
