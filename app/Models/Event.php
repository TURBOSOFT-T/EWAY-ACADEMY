<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;

    protected $fillable = [
        'titre',
        'start',
        'end',
        'limit',
        'description',
        'image',
        'user_id',
        'category_id',
        'telephone',
        'heure',
        'location',
        'country',
        'type',
        'adresse',
        'active',
        'meta_description',
        'autre_description',
        'autre_description1',

    ];
   
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function seances()
{
    return $this->hasMany(Seance::class, 'scence_id', 'id');
}

public function inscriptions()
{
    return $this->hasMany(Inscription::class, 'event_id', 'id');
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
    public function online_classes()
    {
        return $this->hasMany(Online_classe::class, 'event_id', 'id');
    }
}
