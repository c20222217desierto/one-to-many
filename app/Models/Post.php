<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $fillable = ['title', 'body'];

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    // optional lang if mag required si sir sang slug
    // amo ni na code ga generate sang unique slug
    // public static function boot()
    // {
    //         parent::boot();
    
    //         static::creating(function ($post) {
    //             $post->slug = $post->generateUniqueSlug();
    //         });
    // }

    //ari naman ya magpa out sang slug sa url sang filament 
    // example http://127.0.0.1:8000/admin/posts/arnel-slug nd na id ang gagwa
    // public function getRouteKeyName()
    // {
    //     return 'slug';
    // }
    
}
