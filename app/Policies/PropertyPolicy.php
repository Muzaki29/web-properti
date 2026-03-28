<?php

namespace App\Policies;

use App\Models\Property;
use App\Models\User;

class PropertyPolicy
{
    public function before(?User $user, string $ability): ?bool
    {
        if ($user && $user->role === 'admin') {
            return true;
        }

        return null;
    }

    public function viewAny(?User $user): bool
    {
        return false;
    }

    public function view(?User $user, Property $property): bool
    {
        return false;
    }

    public function create(?User $user): bool
    {
        return false;
    }

    public function update(?User $user, Property $property): bool
    {
        return false;
    }

    public function delete(?User $user, Property $property): bool
    {
        return false;
    }
}

