<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $fillable = ['user_id', 'facility_id', 'categories', 'title', 'slug', 'content', 'featured_image', 'likes'];
}
