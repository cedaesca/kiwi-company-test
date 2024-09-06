<?php

namespace App\Interfaces\Repositories;

use App\Entities\User;

interface UserRepositoryInterface
{
    public function find(int $id): ?User;
    /** @return User[] */
    public function findAll(): array;
    public function save(User $book): void;
    public function delete(int $id): void;
}
