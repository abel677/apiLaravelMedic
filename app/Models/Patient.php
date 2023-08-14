<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Patient extends Model
{
    use HasFactory;

    public $timestamps = false;
    protected  $table = 'patients';
    protected $fillable =  ['idPerson', 'securityNumber'];




    public function persons(): HasOne
    {
        return $this->hasOne(Person::class, 'id');
    }


    public function doctors(): BelongsToMany
    {
        return $this->belongsToMany(Doctor::class);
    }
}
