<?php

namespace App\Interfaces\Repositories;

use App\Entities\Book;

interface BookRepositoryInterface
{
    public function find(int $id): ?Book;
    /** @return Book[] */
    public function findAll(): array;
    public function save(Book $book): void;
    public function delete(int $id): void;
}
