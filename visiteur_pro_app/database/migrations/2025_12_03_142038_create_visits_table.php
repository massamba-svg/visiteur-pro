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
        Schema::create('visits', function (Blueprint $table) {
            $table->id();
            $table->string('visitor_name');        // Nom du visiteur
            $table->foreignId('client_id')->constrained('clients')->onDelete('cascade');
            $table->string('person_met');          // Personne rencontrée
            $table->string('reason');              // Motif de visite
            $table->dateTime('arrival_time');      // Heure d'arrivée
            $table->dateTime('departure_time')->nullable(); // Heure de départ
            $table->string('status')->default('in_progress'); // in_progress, completed
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade'); // Utilisateur qui enregistre
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('visits');
    }
};
