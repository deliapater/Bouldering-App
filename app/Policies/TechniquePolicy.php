<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Technique;

class TechniquePolicy
{
    public function viewAny(User $user)
    {
        return true;
    }

    public function view(User $user, Technique $technique)
    {
        return true;
    }

    public function create(User $user)
    {
        return $user->isAdmin();
    }

    public function update(User $user, Technique $technique)
    {
        return $user->id === $technique->created_by || $user->isAdmin();
    }

    public function delete(User $user, Technique $technique)
    {
        return $user->id === $technique->created_by || $user->isAdmin();
    }
}
