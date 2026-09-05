<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

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
// Dans App\Models\Formation.php

public function responsable(): BelongsTo
{
    // Remplacez 'user_id' si la colonne dans la table 'formations' porte un autre nom (ex: 'teacher_id')
    return $this->belongsTo(User::class, 'user_id');
}

public function evaluations(): HasMany
{
    // On précise explicitement 'teacher_id' (clé étrangère dans teacher_evaluations)
    // et 'user_id' (clé locale dans formations désignant l'enseignant)
    return $this->hasMany(TeacherEvaluation::class, 'teacher_id', 'user_id');
}

     public function inscrit()
    {
        return $this->hasMany(ContenuInscription::class, 'formation_id');
    }

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

public function evaluationForUser($userId)
{
    return $this->hasOneThrough(
        TeacherEvaluation::class,
        User::class, // ou le Modèle Enseignant
        'id', // Clef étrangère sur la table intermédiaire
        'teacher_id', // Clef étrangère sur la table teacher_evaluations
        'responsable_id', // Clef locale sur formations
        'id' // Clef locale sur la table intermédiaire
    )->where('student_id', $userId);
}

}
