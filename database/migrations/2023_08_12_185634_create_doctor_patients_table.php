<?php


use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('doctor_patient', function (Blueprint $table) {
            $table->id();
            $table->foreignId('patient_id')->constrained('patients')
                ->cascadeOnDelete()
                ->cascadeOnUpdate();

            $table->foreignId('doctor_id')->constrained('doctors')
                ->cascadeOnDelete()
                ->cascadeOnUpdate();

            $table->dateTime('currentDate')->default(Carbon::now());
            $table->dateTime('appointmentDate')->default(Carbon::now());
            $table->string('description')->nullable();
            $table->boolean('state')->default(false);
        });
    }


    public function down(): void
    {
        Schema::dropIfExists('doctorPatients');
    }
};
