<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use App\Models\DisciplineClasse;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Discipline extends Model
{
    protected $hidden = [
        "created_at",
        "updated_at",
        
    ];
    use HasFactory;
    public function DisciplineClasse(): HasMany
    {
        return $this->hasMany(DisciplineClasse::class);
    }


    public function disciplineExiste($discipline)
    {
        return DB::table('disciplines')->whereRaw('libelle_discipline = ?', [$discipline])->get();
    }
    
}
