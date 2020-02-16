<?php

namespace Tests\Unit;


use App\Word;
use Facades\Tests\Setup\WordFactory;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ManageLikesTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_is_an_instance_of_like()
    {
        $word = WordFactory::liked()->create();

        $this->assertInstanceOf( Collection::class, $word->likes);
    }

    /** @test */
    public function it_is_an_instance_of_dislike()
    {
        $word = WordFactory::disliked()->create();

        $this->assertInstanceOf( Collection::class, $word->dislikes);
    }

    /** @test */
    public function an_authenticated_user_can_like_a_word()
    {
        $user = $this->signIn();

        $word = create(Word::class);

        $word->liked();

        $this->assertEquals($word->likes()->first()->user_id, $user->id);
    }

    /** @test */
    public function an_authenticated_user_can_dislike_a_word()
    {
        $user = $this->signIn();

        $word = create(Word::class);

        $word->disliked();

        $this->assertEquals($word->dislikes()->first()->user_id, $user->id);
    }
}
