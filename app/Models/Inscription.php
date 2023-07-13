<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Inscription extends Model
{
    protected $hidden = [
        "created_at",
        "updated_at",
        
    ];
    use HasFactory;
    public function eleves() : BelongsTo
    {
        return $this->belongsTo(Eleve::class);
    }


    public function classes() : BelongsTo
    {
        return $this->belongsTo(Classe::class,'classe_id');
    }


    
}
