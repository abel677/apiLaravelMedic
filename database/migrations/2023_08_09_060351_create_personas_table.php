<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('persons', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('lastName');
            $table->date('birthDate');
            $table->string('typeBlood');
            $table->string('direction');
            $table->string('phone');

            $table->foreignId('idUser')
                ->unique()
                ->constrained('users')
                ->cascadeOnDelete()
                ->cascadeOnUpdate();

            $table->foreignId('idGender')->constrained('genders')
                ->cascadeOnDelete()
                ->cascadeOnUpdate();
        });
    }
    public function down(): void
    {
        Schema::dropIfExists('persons');
    }
};
