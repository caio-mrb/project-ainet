<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Genre extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'name',
    ];     

    public $timestamps = false;

    protected $primaryKey = 'code';

    public $incrementing = false;

    protected $keyType = 'string';

    public function movies(): HasMany
    {
        return $this->hasMany(Movie::class);
    }
}
