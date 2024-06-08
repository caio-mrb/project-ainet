<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Customer extends Model
{
    use HasFactory;

    protected $fillable = [
        'nif',
        'payment_type',
        'payment_ref',
    ];   

    public function user(): HasOne
    {
        return $this->hasOne(User::class);
    }
}
