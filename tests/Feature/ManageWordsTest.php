<?php

namespace Tests\Feature;

use App\Definition;
use App\User;
use App\Word;
use Facades\Tests\Setup\UserFactory;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ManageWordsTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function unauthorised_users_cannot_manage_words()
    {
        $this->get(route('words.create'))->assertRedirect('login');
        $this->post(route('words.store'), [])->assertRedirect('login');
    }

    /** @test */
    public function authorised_users_can_view_page_to_add_a_new_word()
    {
        $this->withoutExceptionHandling();
        $this->actingAs(create(User::class))
            ->get(route('words.create'))
            ->assertOk();
    }

    /** @test */
    public function word_title_is_required_when_adding_a_word_definition()
    {
        $this->actingAs(create(User::class))
            ->post(route('words.store'), [])
            ->assertSessionHasErrors('title');
    }

    /** @test */
    public function word_description_is_required_when_adding_a_word_definition()
    {
        $this->actingAs(create(User::class))
            ->post(route('words.store'), [])
            ->assertSessionHasErrors('description');
    }

    /** @test */
    public function authorised_user_can_add_words_to_the_dictionary()
    {
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
