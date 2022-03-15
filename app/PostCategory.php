<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Post;
class PostCategory extends Model
{
    protected $fillable=['title_en','title_ar','slug_en','slug_ar','published'];

    public function post(){
        return $this->hasMany('App\Post','post_cat_id','id')->where('published',1);
    }

    public static function getBlogByCategory($slug){
        return PostCategory::with('post')->where('slug',$slug)->first();
    }
}
