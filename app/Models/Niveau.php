<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Classe;
use App\Traits\JoinQueryParams;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Niveau extends Model
{
  

    protected $hidden = [
        "created_at",
        "updated_at",
        
    ];
    protected $fillable = [
        'libelle_niveau', 
    ];
    use HasFactory; 

    public function Classes() : HasMany
    {
        return $this->hasMany(Classe::class);
    }

   
}
