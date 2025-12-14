<?php

namespace App\Policies;

use App\Models\Post;
use App\Models\User;

class PostPolicy
{
    /**
     * Determine whether the user own the model.
     */
    public function owner(User $user, Post $post): bool
    {
        return $user -> id === $post -> user_id;
    }
}
