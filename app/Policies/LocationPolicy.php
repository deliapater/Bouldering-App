<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Location;

class LocationPolicy
{
    public function viewAny(User $user)
    {
        return true;
    }

    public function view(User $user, Location $location)
    {
        return true;
    }

    public function create(User $location)
    {
        return $user->isAdmin();
    }

    public function update(User $user, Location $location)
    {
        return $user->id === $location->created_by || $user->isAdmin();
    }

    public function delete(User $user, Location $location)
    {
        return $user->id === $location->created_by || $user->isAdmin();
    }
}
