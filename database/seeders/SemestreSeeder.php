<?php

namespace Database\Seeders;

use App\Models\Discipline;
use App\Models\Semestre;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;


class SemestreSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $evaluations = [
            ["libelle_semestre" => "Semestre 1",
                "niveau_id" => 2],
            ["libelle_semestre" => "Semestre 2", 
            "niveau_id" => 2]
        ];
        Semestre::insert($evaluations);
    }
}
