<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\DB;

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
    public function DisciplineClasse(): HasMany
    {
        return $this->hasMany(DisciplineClasse::class);
    }
    public function inscriptions() : HasMany
    {
        return $this->hasMany(Inscription::class);
    }

    public function Evenement(): BelongsToMany
    {
        return $this->belongsToMany(Evenement::class);
    }

    public function niass()
    {
        DB::table("classes");
    }

    public function eleves() : BelongsToMany
    {
        return $this->belongsToMany(Eleve::class, "inscriptions", "classe_id", "eleve_id");
    } 

}
