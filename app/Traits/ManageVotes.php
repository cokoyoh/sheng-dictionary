<?php


namespace App\Traits;


trait ManageVotes
{
    public function liked()
    {
        $this->likes()
            ->create(['user_id' => auth()->id()]);
    }

    public function disliked()
    {
        $this->dislikes()
            ->create(['user_id' => auth()->id()]);
    }
}
