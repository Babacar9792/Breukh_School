<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
// use App\Models\Niveau;

class Classe extends Model
{

    use HasFactory;
    protected $hidden = [
        "created_at",
        "updated_at",
        
    ];
    protected $fillable = [
        'libelle_classe', 
        'niveau_id'
    ];

    public function Inscriptions() : HasMany
    {
        return $this->hasMany(Inscription::class);
    }

}
