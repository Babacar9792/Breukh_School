<?php

namespace App\Http\Resources;

use App\Models\DisciplineClasse;
use App\Http\Resources\DisciplineClasseResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

use App\Http\Resources\InscriptionResource;

class ClasseResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        // return parent::toArray($request);
        return [
            "id" => $this->id,
            "libelle_classe" => $this->libelle_classe,
            "eleves" =>  InscriptionResource::collection($this->Inscriptions) 
             // "disciplines" => DisciplineClasseResource::collection($this->Classe)
        ];
    }
}
