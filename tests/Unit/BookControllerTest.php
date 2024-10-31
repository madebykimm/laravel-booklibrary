<?php

namespace Tests\Feature;

use App\Models\Author;
use App\Models\Book;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class BookControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_can_create_book_with_valid_data()
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

    public function test_cannot_create_book_with_invalid_data()
    {
        $data = [
            'title' => '',  // Title is required
            'publish_date' => 'invalid-date',  // Invalid date
            'author_id' => 9999,  // Non-existent author
        ];

        $response = $this->postJson('/api/books', $data);

        $response->assertStatus(422)
            ->assertJsonValidationErrors(['title', 'publish_date', 'author_id']);
    }

    public function test_can_update_book_with_valid_data()
    {
        $book = Book::factory()->create();
        $data = ['title' => 'Updated Title'];

        $response = $this->putJson("/api/books/{$book->id}", $data);

        $response->assertStatus(200)
            ->assertJsonFragment($data);
        $this->assertDatabaseHas('books', $data);
    }

    public function test_cannot_update_book_with_invalid_data()
    {
        $book = Book::factory()->create();
        $data = ['author_id' => 9999];  // Invalid author_id

        $response = $this->putJson("/api/books/{$book->id}", $data);

        $response->assertStatus(422)
            ->assertJsonValidationErrors(['author_id']);
    }

    public function test_can_delete_book()
    {
        $book = Book::factory()->create();

        $response = $this->deleteJson("/api/books/{$book->id}");

        $response->assertStatus(204);
        $this->assertDatabaseMissing('books', ['id' => $book->id]);
    }
}
