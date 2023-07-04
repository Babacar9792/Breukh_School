<?php

use App\Models\Eleve;
use App\Models\Classe;
use App\Models\AnnneScolaire;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('inscriptions', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Classe::class)->constrained()->cascadeOnDelete();
            $table->foreignIdFor(Eleve::class)->constrained()->cascadeOnDelete();
            $table->foreignIdFor(AnnneScolaire::class)->constrained()->cascadeOnDelete();
            $table->dateTime("date_inscription");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('inscriptions');
    }
};
