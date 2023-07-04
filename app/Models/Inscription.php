<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Inscription extends Model
{
    use HasFactory;
    public function Eleves() : BelongsTo
    {
        return $this->belongsTo(Eleve::class);
    }

    public function Classes() : BelongsTo
    {
        return $this->belongsTo(Classe::class);
    }
    
}
