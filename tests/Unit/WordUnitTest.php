<?php

namespace Tests\Unit;

use App\Definition;
use App\User;
use App\Word;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Facades\Tests\Setup\WordFactory;
use Tests\TestCase;

class WordUnitTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function a_word_has_a_definition()
    {
        $word = WordFactory::withDefinitions(1)->create();
        
        $this->assertInstanceOf(Definition::class, $word->definition()->first());
    }

    /** @test */
    public function a_word_can_add_its_own_definition()
    {
        $word = create(Word::class, ['title' => 'hocus pocus']);

        $word->addDefinition([
            'description' => 'hocus pocus is just meaningless word!'
        ]);

        $this->assertInstanceOf(Definition::class, $word->definition()->first());
    }

    /** @test */
    public function a_word_belong_to_a_user()
    {
        $word = create(Word::class);

        $this->assertInstanceOf(User::class, $word->user);
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

    /** @test */
    public function it_counts_one_dislike_when_a_user_likes_a_word_dislikes_the_same_word_and_likes_it_again_and_dislikes_it_last_time()
    {
        $this->signIn();

        $word = create(Word::class);

        $word->liked();
        $this->assertEquals(1, $word->likes()->count());

        $word->disliked();
        $this->assertEquals(1, $word->dislikes()->count());
        $this->assertEquals(0, $word->likes()->count());

        $word->liked();
        $this->assertEquals(1, $word->likes()->count());
        $this->assertEquals(0, $word->dislikes()->count());

        $word->disliked();
        $this->assertEquals(1, $word->dislikes()->count());
    }
}
