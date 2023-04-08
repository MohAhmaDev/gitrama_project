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
        Schema::create('employes', function (Blueprint $table) {
            $table->id();
            $table->string('numero_securite_social')->unique();
            $table->string('fonction');
            $table->string('nom');
            $table->string('prenom');
            $table->string('sexe');
            $table->date('date_naissance');
            $table->date('date_recrutement');
            $table->string('contract');
            $table->string('temp_occuper');
            $table->boolean('handicape');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('employes');
    }
};
