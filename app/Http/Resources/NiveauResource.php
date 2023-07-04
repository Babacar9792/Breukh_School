<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\ClasseResource;
// use Illuminate\Http\Request;

class NiveauResource extends JsonResource
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
            "libelle_niveau" => $this->libelle_niveau,
            "classe" => ClasseResource::collection($this->Classes)
        ];
        
    }
}
