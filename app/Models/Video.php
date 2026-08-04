<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Video extends Model
{
    use HasFactory;
    protected $fillable = [
        'titre',

        'description',
        'video',
        'image',
        'path',
        'user_id',
        'views',
        'is_external',
        'is_file_upload',
        ' image_url',
        'image_public_id',
        'video_public_id'

    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function views()
    {
        return $this->hasMany(VideoView::class);
    }
}
