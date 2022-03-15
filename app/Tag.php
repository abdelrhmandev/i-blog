<?php

namespace App;

 

use Illuminate\Database\Eloquent\Model;

 

class Tag extends Model

{

    /**

     * Get all of the posts that are assigned this tag.

     */

 

 
 public function posts()
			{
			return $this->belongsToMany(Tag::class, 'post_tag', 'tag_id', 'post_id');

			}
			

}
