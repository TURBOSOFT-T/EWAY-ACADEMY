<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BlogView extends Model
{
    use HasFactory;

     protected $fillable = ['blog_id', 'ip_address'];

      public function video()
    {
        return $this->belongsTo(Blog::class , 'blog_id', 'id');
    }
}
