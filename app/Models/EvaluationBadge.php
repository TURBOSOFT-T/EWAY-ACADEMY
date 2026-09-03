<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class EvaluationBadge extends Pivot
{
    /**
     * Nom de la table pivot.
     *
     * @var string
     */
    protected $table = 'evaluation_badge';

    /**
     * Indique si la table pivot utilise les timestamps.
     *
     * @var bool
     */
    public $timestamps = false;

    /**
     * Les attributs assignables en masse.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'teacher_evaluation_id',
        'badge_id',
    ];

    /**
     * L'évaluation associée.
     */
    public function evaluation(): BelongsTo
    {
        return $this->belongsTo(TeacherEvaluation::class, 'teacher_evaluation_id');
    }

    /**
     * Le badge associé.
     */
    public function badge(): BelongsTo
    {
        return $this->belongsTo(Badge::class, 'badge_id');
    }
}