<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Support\Facades\Log;

class AdministrativePolicy
{
    public function before(?User $user, string $ability): bool|null
    {
        return true;
    }
}
