<?php

namespace Database\Seeders;

use App\Models\Initiateur;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class InitiateurSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $initiateur = [
            ["nom_initiateur" => "Diogal"],
            ["nom_initiateur" => "Moussa sagna"]
        ];
        Initiateur::insert($initiateur);
    }
}
