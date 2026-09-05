<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ContenuInscription extends Model
{
    use HasFactory;

    protected $table = 'contenu_inscriptions';

    protected $fillable = [
        'inscription_id',
        'type',
        'pack_formation_id',
        'formation_id',
        'prix',
        'event_id',
        'commercial_id'

    ];

    /**
     * Relation avec l'inscription parente.
     */
    public function inscription(): BelongsTo
    {
        return $this->belongsTo(Inscription::class);
    }

    /**
     * Relation avec le pack souscrit (si applicable).
     */
    public function packFormation(): BelongsTo
    {
        return $this->belongsTo(PackFormation::class, 'pack_formation_id');
    }

    /**
     * Relation avec la formation souscrite (si applicable).
     */
    public function formation(): BelongsTo
    {
        return $this->belongsTo(Formation::class, 'formation_id');
    }

    /**
     * Relation avec l'événement associé (si applicable).
     */
    public function event(): BelongsTo
    {
        return $this->belongsTo(Event::class, 'event_id');
    }

    /**
     * Relation avec le commercial associé (si applicable).
     */
    public function commercial(): BelongsTo
    {
        return $this->belongsTo(User::class, 'commercial_id');
    }
    

}