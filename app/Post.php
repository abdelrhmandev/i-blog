<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $fillable=['title_en','title_ar','slug_en','slug_ar','description_en','description_ar','image','added_by','published'];


	
	public function tags()
			{
			return $this->belongsToMany(Tag::class, 'post_tag', 'post_id', 'tag_id');

			}
			
			
			

    public function cat_info(){
        return $this->hasOne('App\PostCategory','id','post_cat_id');
    }
 
    public function author_info(){
        return $this->hasOne('App\User','id','added_by');
    }
    public static function getAllPost(){
        return Post::with(['cat_info','author_info'])->orderBy('id','DESC')->paginate(10);
    }
    // public function get_comments(){
    //     return $this->hasMany('App\PostComment','post_id','id');
    // }
    public static function getPostBySlug($slug){
        return Post::with(['tag_info','author_info'])->where('slug',$slug)->where('published',1)->first();
    }

    public function comments(){
        return $this->hasMany(PostComment::class)->whereNull('parent_id')->where('published',1)->with('user_info')->orderBy('id','DESC');
    }
    public function allComments(){
        return $this->hasMany(PostComment::class)->where('published',1);
    }


    // public static function getProductByCat($slug){
    //     // dd($slug);
    //     return Category::with('products')->where('slug',$slug)->first();
    //     // return Product::where('cat_id',$id)->where('child_cat_id',null)->paginate(10);
    // }

    // public static function getBlogByCategory($id){
    //     return Post::where('post_cat_id',$id)->paginate(8);
    // }
    public static function getBlogByTag($slug){
        // dd($slug);
        return Post::where('tags',$slug)->paginate(8);
    }

    public static function countPublishedPost(){
        $data = Post::where('published',1)->count();
        if($data){
            return $data;
        }
        return 0;
    }
}
