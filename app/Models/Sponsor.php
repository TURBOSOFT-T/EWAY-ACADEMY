<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sponsor extends Model
{
    use HasFactory;

    protected $fillable = [
        'titre',
      
        'description',
        'image',
        'lien',
        'telephone',
        'email',
        'logo'
    ];
   
}
