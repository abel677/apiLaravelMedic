<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up(): void
    {
        Schema::create('patients', function (Blueprint $table) {
            $table->id();

            $table->foreignId('idPerson')
                ->unique()
                ->constrained('persons')
                ->cascadeOnDelete()
                ->cascadeOnUpdate();

            $table->string('securityNumber');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('patients');
    }
};
