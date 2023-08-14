<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up(): void
    {
        Schema::create('usersRoles', function (Blueprint $table) {
            $table->id();
            $table->foreignId('IdRole')->constrained('roles')
                ->cascadeOnDelete()
                ->cascadeOnUpdate();
            $table->foreignId('IdUser')->constrained('users')
                ->cascadeOnDelete()
                ->cascadeOnUpdate();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('usersRoles');
    }
};
