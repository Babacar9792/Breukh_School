<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\DisciplineResource;
class DisciplineClasseResource extends JsonResource
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
                "libelle_discipline" => DisciplineResource::collection($this->DisciplineClasse)
        ];
    }
}
