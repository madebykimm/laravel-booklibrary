<?php

namespace Tests\Feature;

use App\Models\Author;
use App\Models\Book;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class BookControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_can_create_book()
    {
        $author = Author::factory()->create();
        $data = [
            'title' => 'Sample Book',
            'description' => 'A book description',
            'publish_date' => '2022-01-01',
            'author_id' => $author->id,
        ];

        $response = $this->postJson('/api/books', $data);

        $response->assertStatus(201)
            ->assertJsonFragment(['title' => 'Sample Book']);
        $this->assertDatabaseHas('books', $data);
    }

    public function test_can_retrieve_book()
    {
        $book = Book::factory()->create();

        $response = $this->getJson("/api/books/{$book->id}");

        $response->assertStatus(200)
            ->assertJsonFragment(['title' => $book->title]);
    }

    public function test_can_update_book()
    {
        $book = Book::factory()->create();
        $data = ['title' => 'Updated Title'];

        $response = $this->putJson("/api/books/{$book->id}", $data);

        $response->assertStatus(200)
            ->assertJsonFragment($data);
        $this->assertDatabaseHas('books', $data);
    }

    public function test_can_delete_book()
    {
        $book = Book::factory()->create();

        $response = $this->deleteJson("/api/books/{$book->id}");

        $response->assertStatus(204);
        $this->assertDatabaseMissing('books', ['id' => $book->id]);
    }
}
