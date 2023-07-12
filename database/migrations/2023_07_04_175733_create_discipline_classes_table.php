<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\Classe;
use App\Models\Discipline;
use App\Models\Evaluation;
use App\Models\AnnneScolaire;
use App\Models\Semestre;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('discipline_classes', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Classe::class)->constrained();
            $table->foreignIdFor(Evaluation::class)->constrained();
            $table->foreignIdFor(AnnneScolaire::class)->constrained();
            $table->foreignIdFor(Discipline::class)->constrained();
            $table->foreignIdFor(Semestre::class)->constrained();
            $table->integer("archive")->default(0);
            $table->integer("note_maximale");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('discipline_classes');
    }
};
