<?php

namespace App\Policies;

use App\Models\Article;
use App\Models\User;

class ArticlePolicy
{
    public function update(User $user, Article $article): bool
    {
        return $user->id === $article->user_id;
    }

    public function delete(User $user, Article $article): bool
    {
        return $user->id === $article->user_id;
    }

    public function create(User $user): bool
    {
        return $user->articles()->count() < 3;
    }

    public function edit(User $user, Article $article): bool
    {
        return $user->id === $article->user_id;
    }
}
