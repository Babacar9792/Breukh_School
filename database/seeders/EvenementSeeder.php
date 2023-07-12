<?php

namespace Database\Seeders;

use App\Models\Evenement;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class EvenementSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $evenement = [
            ["libelle_evenement" => "FOSCO 2023",
                "initiateur_id" => 1],
            ["libelle_evenement" => "Devoir",
            "initiateur_id" => 1],
            ["libelle_evenement" => "Matinée",
            "initiateur_id" => 2]
        ];
        Evenement::insert($evenement);
    }
}
