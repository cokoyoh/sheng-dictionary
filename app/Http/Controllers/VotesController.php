<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Apis\ApiController;
use App\Word;

class VotesController extends ApiController
{
    public function like(Word $word)
    {
        $word->liked();

        return $this->respondSuccess(['message' => 'word was liked']);
    }

    public function dislike(Word $word)
    {
        $word->disliked();

        return $this->respondSuccess(['message' => 'word was disliked']);
    }
}
