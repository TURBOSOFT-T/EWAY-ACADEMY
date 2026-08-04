<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Seance extends Model
{
    protected $fillable = [
        'event_id', 'titre', 'description', 'date', 'heure_debut', 'heure_fin',
    ];

    public function event()
    {
        return $this->belongsTo(Event::class,'event_id', 'id');
    }
}

