<?php

namespace App\Policies;

use App\User;
use App\Word;
use Illuminate\Auth\Access\HandlesAuthorization;

class ManageWordsPolicy
{
    use HandlesAuthorization;

    public function storeWord(User $authUser, Word $word)
    {
        return $authUser->id == $word->user_id;
    }

    public function updateWord(User $user, Word $word)
    {
        return $user->id == $word->user_id;
    }
}
