<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TeacherProfile extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'bio',
        'grade',
        'experience_years',
        'highest_degree',
        'certifications',
        'speciality',
        'cv_path',
    ];

    /**
     * Cast du champ certifications pour le traiter comme un tableau PHP
     */
 // 🔴 OBLIGATOIRE : Transformer le JSON de la BDD en tableau PHP
    protected $casts = [
        'certifications' => 'array',
        'social_links'   => 'array',
    ];

    /**
     * Relation inverse vers l'utilisateur
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    // app/Models/TeacherProfile.php

public function badge()
{
    return $this->belongsTo(Badge::class, 'badge_id');
}
}
