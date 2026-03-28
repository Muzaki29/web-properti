<?php

namespace App\Policies;

use App\Models\PropertyImage;
use App\Models\User;

class PropertyImagePolicy
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

    public function view(?User $user, PropertyImage $propertyImage): bool
    {
        return false;
    }

    public function create(?User $user): bool
    {
        return false;
    }

    public function update(?User $user, PropertyImage $propertyImage): bool
    {
        return false;
    }

    public function delete(?User $user, PropertyImage $propertyImage): bool
    {
        return false;
    }
}

