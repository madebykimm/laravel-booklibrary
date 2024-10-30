# Library Management System API

This project is a RESTful API for managing books and authors using Laravel 11. The API provides CRUD operations for authors and books, as well as relational handling between them.

## Features
- **Authors**: CRUD operations, and the ability to retrieve all books by a specific author.
- **Books**: CRUD operations and association with authors.

---

## Requirements
- PHP 8.1+
- Composer
- MySQL or PostgreSQL
- Laravel 11

---

## Setup Instructions

### 1. Clone the Repository
```bash
git clone https://github.com/madebykimm/laravel-booklibrary
cd LibraryManagementSystem
```

### 2. Install Dependencies

```bash
composer install
```

### 3. Set Up Environment
#### Copy .env.example to .env:

```bash
cp .env.example .env

```
#### Update database credentials in .env:

```bash
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=your_database
DB_USERNAME=your_username
DB_PASSWORD=your_password
```

### 4. Generate Application Key
```bash
php artisan key:generate

```

### 5. Run Migrations
```bash
php artisan migrate

```

### 6. Run the Application
```bash
php artisan serve

```


# API Endpoints

```bash
Authors
GET /api/authors - Retrieve all authors
POST /api/authors - Create a new author
GET /api/authors/{id} - Retrieve a specific author
PUT /api/authors/{id} - Update an author
DELETE /api/authors/{id} - Delete an author
GET /api/authors/{id}/books - Retrieve all books by a specific author

Books
GET /api/books - Retrieve all books
POST /api/books - Create a new book
GET /api/books/{id} - Retrieve a specific book
PUT /api/books/{id} - Update a book
DELETE /api/books/{id} - Delete a book
```


# Testing
This project includes unit tests for AuthorController and BookController to ensure core functionality and relationships work as expected.

Run Tests
To execute the tests, run:
```bash
php artisan test
```
