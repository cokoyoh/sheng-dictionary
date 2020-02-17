<?php


namespace App\Traits;


trait ManageVotes
{
    public function liked()
    {
        $previousLike = $this->userVotesBuilder('likes');

        if ($previousLike->exists()) {
            return $previousLike->delete();
        }

        $previousDislike = $this->userVotesBuilder('dislikes');

        if ($previousDislike->exists()) {
            return $previousDislike->delete();
        }

        return $this->likes()->create(['user_id' => auth()->id()]);
    }

    public function disliked()
    {
        $previousDislike = $this->userVotesBuilder('dislikes');

        if ($previousDislike->exists()) {
            return $previousDislike->delete();
        }

        $previousLike = $this->userVotesBuilder('likes');

        if ($previousLike->exists()) {
            return $previousLike->delete();
        }

        return $this->dislikes()->create(['user_id' => auth()->id()]);
    }

    private function userVotesBuilder($votes)
    {
        return $this->$votes()->where('user_id', auth()->id());
    }
}
