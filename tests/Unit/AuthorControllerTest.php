<?php

namespace Tests\Feature;

use App\Models\Author;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AuthorControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_can_create_author()
    {
        $data = [
            'name' => 'John Doe',
            'bio' => 'An example bio',
            'birth_date' => '1980-01-01',
        ];

        $response = $this->postJson('/api/authors', $data);

        $response->assertStatus(201)
            ->assertJsonFragment($data);
        $this->assertDatabaseHas('authors', $data);
    }

    public function test_can_retrieve_author()
    {
        $author = Author::factory()->create();

        $response = $this->getJson("/api/authors/{$author->id}");

        $response->assertStatus(200)
            ->assertJsonFragment(['name' => $author->name]);
    }

    public function test_can_update_author()
    {
        $author = Author::factory()->create();
        $data = ['name' => 'Updated Name'];

        $response = $this->putJson("/api/authors/{$author->id}", $data);

        $response->assertStatus(200)
            ->assertJsonFragment($data);
        $this->assertDatabaseHas('authors', $data);
    }

    public function test_can_delete_author()
    {
        $author = Author::factory()->create();

        $response = $this->deleteJson("/api/authors/{$author->id}");

        $response->assertStatus(204);
        $this->assertDatabaseMissing('authors', ['id' => $author->id]);
    }

    public function test_can_retrieve_books_by_author()
    {
        $author = Author::factory()->create();
        $book = $author->books()->create([
            'title' => 'Sample Book',
            'description' => 'A book description',
            'publish_date' => '2022-01-01'
        ]);

        $response = $this->getJson("/api/authors/{$author->id}/books");

        $response->assertStatus(200)
            ->assertJsonFragment(['title' => $book->title]);
    }
}
