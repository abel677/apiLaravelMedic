<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Doctor extends Model
{
    use HasFactory;

    public $timestamps = false;
    //protected  $table = 'doctors';
    //protected $fillable = ['idPerson', 'idSpecialties', 'idSchedule'];


    public function persons(): HasOne
    {
        return $this->hasOne(Person::class, 'id');
    }

    public function schedules(): HasMany
    {
        return $this->hasMany(Schedule::class, 'id');
    }


    public function specialties(): HasMany
    {
        return $this->hasMany(Specialties::class, 'id');
    }


    public function patients(): BelongsToMany
    {
        return $this->belongsToMany(Patient::class, 'id');
    }
}
