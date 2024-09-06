<?php

namespace App\Interfaces\Repositories;

use App\Entities\Author;

interface AuthorRepositoryInterface
{
    public function find(int $id): ?Author;
    /** @return Author[] */
    public function findAll(): array;
    public function save(Author $author): void;
    public function delete(int $id): void;
}
