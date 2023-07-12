<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

use App\Models\DisciplineClasse;
class Evaluation extends Model
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
}
