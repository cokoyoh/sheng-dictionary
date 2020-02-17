<?php

namespace Tests\Unit;

use App\User;
use App\Word;
use Facades\Tests\Setup\WordFactory;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Facades\Tests\Setup\UserFactory;
use Tests\TestCase;


class UserUnitTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_can_have_an_associated_social_account()
    {
        $user = UserFactory::withSocialAccount()->create();

        $this->assertEquals($user->socialAccounts()->count(), 1);
    }

    /** @test */
    public function a_user_has_words()
    {
        $user = create(User::class);

        create(Word::class, ['user_id' => $user->id], 2);

        $this->assertEquals(2, $user->words()->count());
    }

    /** @test */
    public function user_can_add_a_word()
    {
        $user = create(User::class);

        $user->addWord(['title' => 'hoccus poccus']);

        $this->assertEquals(1, $user->words()->count());
    }

    /** @test */
    public function a_user_can_retrieve_their_avatar_url()
    {
        $user = create(User::class);

        $this->assertNotNull($user->avatar);
    }

    /** @test */
    public function it_fetches_a_users_latest_vote_for_a_given_word()
    {
        $user = $this->signIn();

        $word = WordFactory::addedBy($user)->liked()->create(); //the user liked a word they created

        $vote = $user->getVoteFor($word);

        $this->assertEquals('like', $vote);
    }

    /** @test */
    public function it_removes_like_count_when_user_likes_the_same_word_again()
    {
        $this->signIn();

        $word = create(Word::class);

        $word->liked();

        $word->liked();

        $this->assertEquals(0, $word->likes()->count());
    }

    /** @test */
    public function it_removes_dislikes_count_when_a_user_dislikes_the_same_word_again()
    {
        $this->signIn();

        $word = create(Word::class);

        $word->disliked();

        $word->disliked();

        $this->assertEquals(0, $word->dislikes()->count());
    }

    /** @test */
    public function it_counts_one_like_when_a_user_likes_a_word_dislikes_the_same_word_and_likes_it_again()
    {
        $this->signIn();

        $word = create(Word::class);

        $word->liked();

        $word->disliked();

        $word->liked();

        $this->assertEquals(1, $word->likes()->count());
    }
}
