<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Specialties extends Model
{
    use HasFactory;

    public $timestamps = false;
    protected  $table = 'specialties';
    protected $fillable = ['specialty'];

    public function doctors(): BelongsTo
    {
        return $this->belongsTo(Doctor::class, 'id');
    }
}
