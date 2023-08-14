<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class AppointmentRequest extends Model
{
    use HasFactory;

    public $timestamps = false;
    protected  $table = 'doctor_patient';
    protected $fillable =
    ['patient_id', 'doctor_id', 'currentDate', 'appointmentDate', 'description', 'state'];

    // public function patients():HasMany
    // {
    //     return $this->hasMany(Patient::class, 'id');
    // }
    // public function doctors(): HasMany
    // {
    //     return $this->hasMany(Doctor::class, 'id');
    // }
}
