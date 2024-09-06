<?php

namespace App\Tests\Unit\Repositories;

use App\Entities\Author;
use App\Repositories\AuthorRepository;
use App\Interfaces\Core\DatabaseManagerInterface;
use PHPUnit\Framework\TestCase;
use PDO;
use PDOStatement;
use PHPUnit\Framework\Attributes\Test;

class AuthorRepositoryTest extends TestCase
{
    private AuthorRepository $authorRepository;
    private $mockDbManager;
    private $mockPDO;
    private $mockPDOStatement;
    private array $authorData;

    protected function setUp(): void
    {
        $this->mockPDOStatement = $this->createMock(PDOStatement::class);

        $this->mockPDO = $this->createMock(PDO::class);
        $this->mockPDO->method('prepare')->willReturn($this->mockPDOStatement);
        $this->mockPDO->method('lastInsertId')->willReturn('1');

        $this->mockDbManager = $this->createMock(DatabaseManagerInterface::class);
        $this->mockDbManager->method('getConnection')->willReturn($this->mockPDO);

        $this->authorRepository = new AuthorRepository($this->mockDbManager);

        $this->authorData = [
            'id' => 1,
            'name' => 'César',
            'last_name' => 'Escudero',
            'birth_day' => '1997-11-19',
            'biography' => 'Nació en Barinas'
        ];
    }

    #[Test]
    public function find(): void
    {
        $this->mockPDOStatement
            ->expects($this->once())
            ->method('execute')
            ->with(['id' => $this->authorData['id']]);

        $this->mockPDOStatement->method('fetch')->willReturn($this->authorData);

        $author = $this->authorRepository->find($this->authorData['id']);

        $this->assertInstanceOf(Author::class, $author);
        $this->assertEquals($this->authorData['id'], $author->getId());
    }

    #[Test]
    public function findReturnsNullIfNotFound(): void
    {
        $this->mockPDOStatement
            ->expects($this->once())
            ->method('execute')
            ->with(['id' => $this->authorData['id']]);

        $this->mockPDOStatement->method('fetch')->willReturn(null);

        $author = $this->authorRepository->find($this->authorData['id']);

        $this->assertNull($author);
    }

    #[Test]
    public function findAll(): void
    {
        $authorsData = [
            $this->authorData,
            [
                'id' => 2,
                'name' => 'Juan',
                'last_name' => 'Pérez',
                'birth_day' => '1950-12-24',  // Use string for date
                'biography' => 'Nació en Caracas'
            ]
        ];

        $this->mockPDOStatement->method('fetchAll')->willReturn($authorsData);

        $authors = $this->authorRepository->findAll();

        $this->assertCount(2, $authors);
        $this->assertInstanceOf(Author::class, $authors[0]);
        $this->assertInstanceOf(Author::class, $authors[1]);
        $this->assertEquals($authorsData[0]['name'], $authors[0]->getName());
        $this->assertEquals($authorsData[1]['name'], $authors[1]->getName());
    }

    #[Test]
    public function findAllReturnsEmptyArray(): void
    {
        $this->mockPDOStatement->method('fetchAll')->willReturn([]);

        $authors = $this->authorRepository->findAll();

        $this->assertIsArray($authors);
        $this->assertCount(0, $authors);
    }

    /**
     * @todo: Implement error throwing cases, and remaining repository methods
     */
}
