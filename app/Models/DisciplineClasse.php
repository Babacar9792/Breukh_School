<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use App\Models\Discipline;
use App\Models\AnnneScolaire;
use App\Models\Classe;
use App\Models\Evaluation;




use Illuminate\Database\Eloquent\Relations\BelongsTo;

class DisciplineClasse extends Model
{
    protected $hidden = [
        "created_at",
        "updated_at",
        
    ];
    use HasFactory;
   
    public function disciplineExisteInClasse($idDiscipline, $idClasse)
    {
        return DB::table('discipline_classes')->whereRaw('discipline_id= ? AND classe_id = ?', [$idDiscipline, $idClasse])->get();
    }
    public function Discipline(): BelongsTo
    {
        return $this->belongsTo(Discipline::class);
    }

    public function Classe(): BelongsTo
    {
        return $this->belongsTo(Classe::class);
    }

    public function Evaluation(): BelongsTo
    {
        return $this->belongsTo(Evaluation::class);
    }

    public function AnnneScolaire(): BelongsTo
    {
        return $this->belongsTo(AnnneScolaire::class);
    }
}
