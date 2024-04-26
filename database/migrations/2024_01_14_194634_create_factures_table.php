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
        Schema::create('factures', function (Blueprint $table) {
            $table->id();
            $table->decimal('Total', 20, 3);
            $table->integer('Remise');
            $table->decimal('TotalTTC', 20, 3);
            $table->datetime('DateCreation');
            $table->unsignedBigInteger('Immatriculation');
            $table->unsignedBigInteger('Nom');

            $table->foreign('Immatriculation')
                ->references('id')
                ->on('articles')
                ->onDelete('restrict')
                ->onUpdate('restrict');

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
        Schema::dropIfExists('factures');
    }
};