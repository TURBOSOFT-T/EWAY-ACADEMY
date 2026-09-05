<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class contenu_inscription extends Model
{
    use HasFactory;
    protected $table ='contenu_inscriptions';
        protected $fillable = [
            'formation_id',
            'inscription_id',
            'event_id',
            'pack_formation_id',
            'commercial_id'
        ];
        public function commercial(){
        return $this->belongsTo(User::class ,'commercial_id')->withDefault();
    }

        public function formations(){
            return $this->belongsTo(Formation::class ,'formation_id')->withDefault();
        }
        public function event(){
            return $this->belongsTo(Event::class ,'event_id')->withDefault();
        }
    
       /*  public function inscriptions(){
            return $this->belongsTo(Inscription::class ,'inscription_id');
        }
        */
      
    
}
