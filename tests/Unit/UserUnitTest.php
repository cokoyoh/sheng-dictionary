<?php

namespace Tests\Unit;

use App\User;
use App\Word;
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
}
