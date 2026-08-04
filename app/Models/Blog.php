<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Blog extends Model
{
    use HasFactory,SoftDeletes;

    protected $fillable = [
        'title',
      //  'slug',
        'seo_title',
        'excerpt',
        'body',
        'views',
        'meta_description',
        'description',
        'meta_keywords',
        'active',
        'image',
        'user_id',
        'category_id'
    ];



    /**
     * Get user of the Post
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

       public function views()
    {
        return $this->hasMany(BlogView::class, 'blog_id', 'id');
    }

    /**
     * Get all categories for the post
     *
     * @return \Illuminate\Database\Eloquent\Relations\belongsToMany
     */
    public function categories()
    {
        return $this->belongsTo(Category::class, 'category_id', 'id');
    }
    public function comments()
    {
        return $this->hasMany(Comment::class);
    }
    
    public function comment()
    {
        return $this->hasMany(Comment::class, 'blod_id','id');
    }

    /**
     * Get all valid comments for the post
     *
     * @return \Illuminate\Database\Eloquent\Relations\hasMany
     */
    public function validComments()
    {
        return $this->comments()->whereHas('user', function ($query) {
            $query->whereValid(true);
        });
    }
    public function validComments1()
    {
        return $this->hasMany(Comment::class)->where('is_valid', true);
    }
}
