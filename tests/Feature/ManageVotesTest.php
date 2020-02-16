<?php

namespace Tests\Feature;

use App\User;
use App\Word;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ManageVotesTest extends TestCase
{
    use RefreshDatabase;

//    /** @test */
    public function authorised_user_can_like_a_word_definition()
    {
        $user = create(User::class);

        $word = create(Word::class);
    }
}
