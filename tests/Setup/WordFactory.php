<?php


namespace Tests\Setup;


use App\Definition;
use App\Like;
use App\User;
use App\Word;

class WordFactory
{
    private $count = null;
    private $user = null;
    private $liked = false;

    public function create()
    {
        $user = $this->user ? $this->user : create(User::class);

        $word = create(Word::class, ['user_id' => $user->id]);

        if ($this->liked) {
            create(Like::class, ['user_id' => $user->id, 'word_id' => $word->id]);
        }

        if ($this->count) {
            create(Definition::class, [
                'word_id' => $word->id
            ], $this->count);
        }

        return $word;
    }

    public function withDefinitions($counts)
    {
        $this->count = $counts;

        return $this;
    }

    public function addedBy($user = null)
    {
        $this->user = $user ? $user : create(User::class);

        return $this;
    }

    public function liked()
    {
        $this->liked = true;

        return $this;
    }
}
