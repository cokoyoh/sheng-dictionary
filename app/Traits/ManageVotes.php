<?php


namespace App\Traits;


trait ManageVotes
{
    public function liked()
    {
        $this->likes()
            ->create(['user_id' => auth()->id()]);
    }
}
