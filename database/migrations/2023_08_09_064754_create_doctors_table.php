<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up(): void
    {
        Schema::create('doctors', function (Blueprint $table) {
            $table->id();

            

            $table->unsignedBigInteger('idPerson')->unique();
            $table->foreign('idPerson')->references('id')->on('persons')->onDelete('cascade');
            
            
            $table->foreignId('idSpecialty')->constrained('specialties')
            ->cascadeOnDelete()
            ->cascadeOnUpdate();
            
            
            $table->foreignId('idSchedule')->constrained('schedules')
            ->cascadeOnDelete()
            ->cascadeOnUpdate();

            $table->boolean('state')->default(true);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('doctors');
    }
};
