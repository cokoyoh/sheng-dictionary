<?php

namespace Tests\Feature;

use App\User;
use App\Word;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ManageVotesTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function authorised_user_can_like_a_word_definition()
    {
        $word = create(Word::class);

        $this->actingAs(create(User::class))
            ->get(route('words.like', $word))
            ->assertRedirect();

        $this->assertCount(1, $word->likes);
    }

    /** @test */
    public function authorised_user_can_dislikes_word_definition()
    {
        $word = create(Word::class);

        $this->actingAs(create(User::class))
            ->get(route('words.dislike', $word))
            ->assertRedirect();

        $this->assertCount(1, $word->dislikes);
    }
}
