<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Badge extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'icon',
        'color',
    ];

    /**
     * Les évaluations qui possèdent ce badge.
     */
    public function evaluations(): BelongsToMany
    {
        return $this->belongsToMany(TeacherEvaluation::class, 'evaluation_badge');
    }
}