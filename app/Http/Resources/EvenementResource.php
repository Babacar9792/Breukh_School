<?php

namespace App\Http\Resources;

use App\Models\Initiateur;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class EvenementResource extends JsonResource
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
            "libelle_evenement" => $this->libelle_evenement,
            "date_creation_evenement" => $this->date_creation_evenement,
            "initiateur" => new InitiateurResource($this->initiateur)
        ];
    }
}
