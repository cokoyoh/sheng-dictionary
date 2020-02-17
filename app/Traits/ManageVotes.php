<?php


namespace App\Traits;


trait ManageVotes
{
    public function liked()
    {
        $previousLike = $this->userVotesBuilder('likes')->exists();

        if ($previousLike) {
            return $this->userVotesBuilder('likes')->delete();
        }

        return $this->likes()->create(['user_id' => auth()->id()]);
    }

    public function disliked()
    {
        $previousLike = $this->userVotesBuilder('dislikes')->exists();

        if ($previousLike) {
            return $this->userVotesBuilder('dislikes')->delete();
        }

        return $this->dislikes()->create(['user_id' => auth()->id()]);
    }

    private function userVotesBuilder($votes)
    {
        return $this->$votes()->where('user_id', auth()->id());
    }
}
