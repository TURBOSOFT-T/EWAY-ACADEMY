<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Certification extends Model
{
    use HasFactory;

    
    protected $fillable = [

         'titre',
        'description',
        'meta_description',
        'image',
        'date_debut',
        'date_fin',
        'start',
        'end',
        'category_id',
        'titre',
      
        'limit',
        'description',
        'image',
        'user_id',
      
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
        return $this->hasMany(Inscription::class);
    }

    public function online_classes()
    {
        return $this->hasMany(Online_classe::class);
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

    public function documents()
{
    return $this->hasMany(Document::class , 'user_id' , 'id');
}
}
