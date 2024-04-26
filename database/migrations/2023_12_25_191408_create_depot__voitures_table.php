<?php

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
        Schema::create('depot__voitures', function (Blueprint $table) {
            $table->id();
            $table->string('Nom');
            $table->string('Marque',255);
            $table->string('Voiturecompatible',255);
            $table->integer('Quantite');
            $table->double('Prix',20);
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('depot__voitures');
    }
};