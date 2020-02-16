<?php

namespace Tests\Feature;

use App\Definition;
use App\User;
use App\Word;
use Facades\Tests\Setup\UserFactory;
use Facades\Tests\Setup\WordFactory;
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
        $this->post(route('words.update', 1), [])->assertRedirect('login');
    }

    /** @test */
    public function authorised_users_can_view_page_to_add_a_new_word()
    {
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

    /** @test */
    public function unauthorised_users_cannot_edit_words_they_did_not_author()
    {
        $author = create(User::class);

        $anonymous = create(User::class);

        $word = WordFactory::addedBy($author)->create();

        $this->actingAs($anonymous)
            ->post(route('words.update', $word), $this->input())
            ->assertForbidden();
    }

    /** @test */
    public function authorised_users_can_update_a_word_definition()
    {
        $author = create(User::class);

        $word = WordFactory::addedBy($author)->create();

        $this->actingAs($author)
            ->post(route('words.store', $word), $updatedWord = $this->input())
            ->assertRedirect();

        $this->assertDatabaseHas('words', ['title' => $updatedWord['title']]);
    }

    private function input()
    {
        return [
            'title' => "hocus pocus",
            'description' => 'some description'
        ];
    }
}
