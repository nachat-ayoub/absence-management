<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void{
        Schema::create('presences', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('stagiaire_id');
            $table->unsignedBigInteger('classe_id');
            $table->date('date');
            $table->boolean('isPresence');

            $table->foreign('stagiaire_id')->references('id')->on('stagiaires')->onDelete(('cascade'));
            $table->foreign('classe_id')->references('id')->on('classes')->onDelete(('cascade'));
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void{
        Schema::dropIfExists('presences');
    }
};
