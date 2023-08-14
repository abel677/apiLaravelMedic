<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Person extends Model
{
    use HasFactory;

    public $timestamps = false;
    protected  $table = 'persons';
    protected $fillable =
    [
        'name', 'lastName', 'birthDate', 'typeBlood', 'idGender', 'direction', 'email',
        'phone', 'securityNumber', 'idUser'
    ];

    public function genders(): HasOne
    {
        return $this->hasOne(Gender::class, 'id');
    }

    public function patients(): HasOne
    {
        return $this->hasOne(Patient::class, 'id');
    }

    public function doctors(): HasOne
    {
        return $this->hasOne(Doctor::class, 'id');
    }
}
