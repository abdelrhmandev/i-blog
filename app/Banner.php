<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Banner extends Model
{
    protected $fillable=['title_en','title_ar','slug_en','slug_ar','description_en','description_ar','image','published'];
}
