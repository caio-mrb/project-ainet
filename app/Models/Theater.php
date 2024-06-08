<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Theater extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'photo_filename',
    ];

    public function seats(): HasMany
    {
        return $this->hasMany(Seat::class);
    }

    public function movie(): BelongsTo
    {
        return $this->belongsTo(Movie::class);
    }
}
