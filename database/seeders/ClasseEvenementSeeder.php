<?php

namespace Database\Seeders;

use App\Models\ClasseEvenement;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ClasseEvenementSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $classe = [
            ["classe_id" => 2,
            "evenement_id" => 2]
        ];
        ClasseEvenement::insert($classe);
    }
}
