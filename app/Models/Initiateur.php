<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Initiateur extends Model
{
    use HasFactory;
    public function evenement(): HasMany
    {
        return $this->hasMany(Evenement::class);
    }
}
