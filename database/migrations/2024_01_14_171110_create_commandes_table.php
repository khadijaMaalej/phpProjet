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
        Schema::create('commandes', function (Blueprint $table) {
            $table->id();
            $table->datetime('datecreation');
            $table->unsignedBigInteger('NomFournisseur');
           
            $table->foreign('NomFournisseur')
                ->references('id')
                ->on('fournisseurs')
                ->onDelete('restrict')
                ->onUpdate('restrict');
            
                $table->unsignedBigInteger('Nom');
           
                $table->foreign('Nom')
                ->references('id')
                ->on('depot__voitures')
                ->onDelete('restrict')
                ->onUpdate('restrict');

            
      
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('commandes');
    }
};
