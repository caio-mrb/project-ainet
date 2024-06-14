<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Configuration extends Model
{
    protected $table = 'configuration';

    protected $fillable = [
        'ticket_price',
        'registered_customer_ticket_discount',
    ];

    public $timestamps = false;
}
