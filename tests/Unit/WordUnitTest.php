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

        $this->assertInstanceOf(Definition::class, $word->definition);
    }

    /** @test */
    public function a_word_can_add_its_own_definition()
    {
        $word = create(Word::class, ['title' => 'hocus pocus']);

        $word->addDefinition([
            'description' => 'hocus pocus is just meaningless word!'
        ]);

        $this->assertInstanceOf(Definition::class, $word->definition);
    }

    /** @test */
    public function a_word_belong_to_a_user()
    {
        $word = create(Word::class);

        $this->assertInstanceOf(User::class, $word->user);
    }
}
