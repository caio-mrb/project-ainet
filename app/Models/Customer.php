<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;


class Customer extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'nif',
        'payment_type',
        'payment_ref',
    ];   

    public function user()
    {
        return $this->belongsTo(User::class, 'id', 'id');
    }

    public function purchases(): HasMany
    {
        return $this->hasMany(Purchase::class);
    }

}
