<?php

namespace App\Repositories;

use App\Core\BaseRepository;
use App\Entities\Author;
use App\Interfaces\Repositories\AuthorRepositoryInterface;
use PDO;

class AuthorRepository extends BaseRepository implements AuthorRepositoryInterface
{
    public function find(int $id): ?Author
    {
        $stmt = $this->dbManager->getConnection()->prepare('SELECT * FROM authors WHERE id = :id');
        $stmt->execute(['id' => $id]);
        $data = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$data) {
            return null;
        }

        return $this->mapToAuthor($data);
    }

    /** @return Author[] */
    public function findAll(): array
    {
        $stmt = $this->dbManager->getConnection()->prepare('SELECT * FROM authors');
        $stmt->execute();
        $data = $stmt->fetchAll(PDO::FETCH_ASSOC);

        if (!$data) {
            return [];
        }

        return array_map([$this, 'mapToAuthor'], $data);
    }

    public function save(Author $author): void
    {
        if ($author->getId()) {
            $this->update($author);

            return;
        }

        $this->insert($author);
    }

    public function delete(int $id): void
    {
        $stmt = $this->dbManager->getConnection()->prepare('DELETE FROM authors WHERE id = :id');
        $stmt->execute(['id' => $id]);
    }

    private function insert(Author $author): void
    {
        $stmt = $this->dbManager->getConnection()->prepare(
            'INSERT INTO authors (name, last_name, birth_day, biography) VALUES (:name, :last_name, :birth_day, :biography)'
        );
        $stmt->execute([
            'name' => $author->getName(),
            'last_name' => $author->getLastName(),
            'birth_day' => $author->getBirthDay()->format('Y-m-d'),
            'biography' => $author->getBiography()
        ]);

        $author->setId((int) $this->dbManager->getConnection()->lastInsertId());
    }

    private function update(Author $author): void
    {
        $stmt = $this->dbManager->getConnection()->prepare(
            'UPDATE authors SET name = :name, last_name = :last_name, birth_day = :birth_day, biography = :biography WHERE id = :id'
        );

        $stmt->execute([
            'name' => $author->getName(),
            'last_name' => $author->getLastName(),
            'birth_day' => $author->getBirthDay()->format('Y-m-d'),
            'biography' => $author->getBiography(),
            'id' => $author->getId()
        ]);
    }

    private function mapToAuthor(array $data): Author
    {
        return new Author(
            $data['name'],
            $data['last_name'],
            new \DateTime($data['birth_day']),
            $data['biography'] ?? null,
            $data['id'] ?? null
        );
    }
}
