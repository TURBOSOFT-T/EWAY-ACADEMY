<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PackFormation extends Model
{
    protected $fillable = ['titre', 'description', 'prix', 'image', 'active'];

    public function formations()
    {
        return $this->belongsToMany(
            Formation::class,
            'formation_pack_formation',
            'pack_formation_id',
            'formation_id'
        );
    }
}