<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Gear;

class GearPolicy
{
    public function viewAny(User $user)
    {
        return true;
    }

    public function view(User $user, Gear $gear)
    {
        return true;
    }

    public function create(User $user)
    {
        return $user->isAdmin();
    }

    public function update(User $user, Gear $gear)
    {
        return $user->id === $gear->created_by || $user->isAdmin();
    }

    public function delete(User $user, Gear $gear)
    {
        return $user->id === $gear->created_by || $user->isAdmin();
    }
}
