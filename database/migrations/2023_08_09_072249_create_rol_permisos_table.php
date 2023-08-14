<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up(): void
    {
        Schema::create('permissionsRoles', function (Blueprint $table) {
            $table->id();
            $table->foreignId('idRole')->constrained('roles')
            ->cascadeOnDelete()
            ->cascadeOnUpdate();

            $table->foreignId('idPage')->constrained('pages')
            ->cascadeOnDelete()
            ->cascadeOnUpdate();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('permissionsRoles');
    }
};
