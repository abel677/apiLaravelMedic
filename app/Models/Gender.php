<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Gender extends Model
{
    use HasFactory;

    public $timestamps = false;
    protected  $table = 'genders';
    protected $fillable = ['gender'];


    public function persons(): HasOne
    {
        return $this->hasOne(Person::class);
    }
}
