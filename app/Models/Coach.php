<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Coach extends Model
{
    use HasFactory;

    protected $fillable = [
        'nom',
          'prenom',
           'date_naissance',
           'adresse',
           'phone',
            'email',
            'photo',

    ];
   
}
