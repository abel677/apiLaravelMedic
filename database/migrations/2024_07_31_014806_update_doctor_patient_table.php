<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('doctor_patient', function (Blueprint $table) {
            // Cambiar el tipo de dato de 'description' de string a longText
            $table->longText('description')->nullable()->change();
        });
    }

    public function down(): void
    {
        Schema::table('doctor_patient', function (Blueprint $table) {
            // Revertir los cambios realizados en la migración 'up'
            $table->string('description')->nullable()->change();
        });
    }
};
