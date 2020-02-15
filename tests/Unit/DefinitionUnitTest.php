<?php

namespace Tests\Unit;

use App\Definition;
use App\Word;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class DefinitionUnitTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function a_definition_belong_to_a_word()
    {
        $definition = create(Definition::class);

        $this->assertInstanceOf(Word::class, $definition->word);
    }
}
