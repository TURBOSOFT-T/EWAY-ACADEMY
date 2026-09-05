<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class TeacherEvaluation extends Model
{
    use HasFactory;

    /**
     * Les attributs assignables en masse.
     *
     * @var array<int, string>
     */

    protected $guarded = [];

    protected $fillable = [
        'student_id',
        'teacher_id',
        'rating',
        'comment',
        'is_approved',
        'is_anonymous',
    ];

    /**
     * Les attributs à convertir (casting).
     *
     * @var array<string, string>
     */
    protected $casts = [
        'rating' => 'integer',
        'is_approved' => 'boolean',
        'is_anonymous' => 'boolean',
    ];

    /* ==========================================
     | RELATIONS ELOQUENT
     + ========================================== */

    /**
     * L'étudiant qui a laissé l'évaluation.
     */
    public function student(): BelongsTo
    {
        return $this->belongsTo(User::class, 'student_id');
    }

    /**
     * L'enseignant concerné par l'évaluation.
     */
    public function teacher(): BelongsTo
    {
        return $this->belongsTo(User::class, 'teacher_id');
    }

    /**
     * Les badges associés à cette évaluation.
     */
    public function badges(): BelongsToMany
    {
        return $this->belongsToMany(Badge::class, 'evaluation_badge');
    }

    /* ==========================================
     | SCOPES (Filtres de requêtes)
     + ========================================== */

    /**
     * Filtre uniquement les avis approuvés.
     */
    public function scopeApproved($query)
    {
        return $query->where('is_approved', true);
    }

    /**
     * Filtre les avis pour un enseignant spécifique.
     */
    public function scopeForTeacher($query, int $teacherId)
    {
        return $query->where('teacher_id', $teacherId);
    }



// Dans App\Models\Badge.php
public function evaluations(): BelongsToMany
{
    return $this->belongsToMany(TeacherEvaluation::class, 'evaluation_badge')
                ->using(EvaluationBadge::class);
}


  

   



}