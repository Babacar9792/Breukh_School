<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Evaluation;

class EvaluationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $evaluations = [
            ["libelle_evaluation" => "Ressource"],
            ["libelle_evaluation" => "Examen"]
        ];
        Evaluation::insert($evaluations);
    }
}
