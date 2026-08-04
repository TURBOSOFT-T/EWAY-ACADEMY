<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class config extends Model
{
    use HasFactory;
    protected $table = 'configs';

    protected $fillable = [
        'logo',
        'logoHeader',
        'telephone',
        'addresse',
        'email',
        'description',
        'frais',
        'icon',
        'logocontact',
        'imagecontact',
        'imageevent',
        'imageformation',
        'facebook',
        'twitter',
        'instagram',
        'youtube',
        'linkedin',
        'tiktok',
        'fax',
        'twitter',
      
        'des_apropos',
        'photos',
        'image_apropos',
        'titre_apropos',
        'imageblog',
        'imageenteteabout',

        'image1_home',
        'image2_home',
        'titre_home',
        'sous_titre_home',
        'des_home',
        'biographie',
        'localisation',

         'titre_apropos3',
            'des_apropos3',
            'image_apropos3',
            'annees_experience'

        
    ];

    protected $casts = [
    'photos' => 'array',
];

}
