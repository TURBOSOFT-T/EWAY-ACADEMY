<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Document extends Model
{
    use HasFactory;

    
    //protected $guarded=[];
    public $fillable = ['formation_id', 'certification_id','event_id', 'user_id', 'titre', 'description', 'file'];
   public function events()
    {
        return $this->belongsTo(Event::class, 'event_id');
    }

    public function formations()
    {
        return $this->belongsTo(Formation::class, 'formation_id');
    }

      public function certifications()
    {
        return $this->belongsTo(Certification::class, 'certification_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
