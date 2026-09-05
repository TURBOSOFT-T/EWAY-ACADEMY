<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Inscription extends Model
{
    use HasFactory;

    protected $fillable = [
     'formation_id',
        'nom',
        'prenom',
        'addresse',
        'ville',
        'message',
        'telephone',
        'whatsapp',
      
        'email',
        'staut',
        'etat',
        'mode',
        'note',
        'user_id',
        'event_id',
        'type',
        'country_id',
        'state_id',
        'city_id',

        'langue_source',
    'langue_destination',

    // Champs Test officiel
    'test_officiel',

    // Champs Cours
    'type_cours',

    // Champs Études
    'diplome_plus_eleve',
    'domaine_etude',
    'specialite',
    'projet_etudes',
    'domaine_etudes_visees',
    'specialite_visee',
    'motivation_etudes_canada',
    ];

    public function contenus(): HasMany
    {
        return $this->hasMany(ContenuInscription::class, 'inscription_id');
    }

        public function country(){
        return $this->belongsTo(Country::class,'country_id');
    }

    public function state(){
        return $this->belongsTo(State::class,'state_id');
    }
    public function city(){
        return $this->belongsTo(City::class,'city_id');
    }

     public function formation()
    {
        return $this->belongsTo(Formation::class , 'formation_id', 'id');
    }

      public function certification()
    {
        return $this->belongsTo(Certification::class , 'certification_id', 'id');
    }

    public function event()
    {
        return $this->belongsTo(Event::class , 'event_id', 'id');
    }
 
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

   
public function pack()
    {
        return $this->belongsTo(PackFormation::class, 'pack_formation_id', 'id');
    }

}
