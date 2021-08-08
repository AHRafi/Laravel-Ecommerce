<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
  protected   $fillable=['Name','Category_Photo'];
   use SoftDeletes;
}
