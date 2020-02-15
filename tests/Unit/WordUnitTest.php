<?php

namespace Tests\Unit;

use App\Word;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Facades\Tests\Setup\WordFactory;
use Tests\TestCase;

class WordUnitTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function a_word_has_definitions()
    {
        $word = WordFactory::withDefinitions(2)->create();

        $this->assertCount(2, $word->definitions);
    }

    /** @test */
    public function a_word_can_add_its_own_definition()
    {
        $word = create(Word::class, ['title' => 'hocus pocus']);

        $word->addDefinition([
            'description' => 'hocus pocus is just meaningless word!'
        ]);

        $this->assertCount(1, $word->definitions);
    }
}
