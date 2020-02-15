<?php

namespace Tests\Feature;

use App\Definition;
use App\Word;
use Facades\Tests\Setup\UserFactory;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ManageWordsTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function authorised_user_can_add_words_to_the_dictionary()
    {
        $this->withoutExceptionHandling();

        $katelo = UserFactory::create();

        $wordDefinition = $this->input();

        $this->actingAs($katelo)
            ->post(route('words.store'), $wordDefinition)
            ->assertRedirect();

        $this->assertDatabaseHas('words', [
            'title' => $wordDefinition['title'],
            'user_id' => $katelo->id
        ]);

        $this->assertDatabaseHas('definitions', [
            'description' => $wordDefinition['description']
        ]);
    }

    private function input()
    {
        $wordDefinition = raw(Word::class) + raw(Definition::class);

        unset($wordDefinition['user_id']);

        unset($wordDefinition['slug']);

        return $wordDefinition;
    }
}
