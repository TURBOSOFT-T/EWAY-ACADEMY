<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Formation extends Model
{
    use HasFactory;

    protected $fillable = [
        'titre',
        'description',
        'meta_description',
        'image',
        'date_debut',
        'date_fin',
        'category_id',
        'user_id',
        'type'
    ];

    public function exams()
{
    return $this->hasMany(Examen::class, 'formation_id','id');
}


    public function inscriptions()
    {
        return $this->hasMany(Inscription::class);
    }

    public function documents()
{
    return $this->hasMany(  Document::class , 'user_id' , 'id');
}

    public function online_classes()
    {
        return $this->hasMany(Online_classe::class);
    }

    public function categories()
    {
        return $this->belongsTo(Category::class, 'category_id', 'id');
    }
public function user()
{
    return $this->belongsTo(User::class , 'user_id', 'id');
}

}
