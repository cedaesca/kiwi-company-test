<?php

namespace Tests\Unit\Entities;

use App\Entities\Author;
use PHPUnit\Framework\TestCase;
use DateTime;
use PHPUnit\Framework\Attributes\Test;

class AuthorTest extends TestCase
{
    private array $authorData;

    protected function setUp(): void
    {
        $this->authorData = [
            'id' => 1,
            'name' => 'César',
            'lastName' => 'Escudero',
            'birthDay' => new DateTime('1997-11-19'),
            'biography' => 'Nació en Barinas'
        ];
    }

    #[Test]
    public function authorCanBeCreatedWithRequiredFields(): void
    {
        $author = new Author(
            $this->authorData['id'],
            $this->authorData['name'],
            $this->authorData['lastName'],
            $this->authorData['birthDay']
        );

        $this->assertEquals($this->authorData['id'], $author->getId());
        $this->assertEquals($this->authorData['name'], $author->getName());
        $this->assertEquals($this->authorData['lastName'], $author->getLastName());
        $this->assertEquals($this->authorData['birthDay'], $author->getBirthDay());
        $this->assertNull($author->getBiography());
    }

    #[Test]
    public function authorCanBeCreatedWithOptionalBiography(): void
    {
        $author = new Author(
            $this->authorData['id'],
            $this->authorData['name'],
            $this->authorData['lastName'],
            $this->authorData['birthDay'],
            $this->authorData['biography']
        );

        $this->assertEquals($this->authorData['id'], $author->getId());
        $this->assertEquals($this->authorData['name'], $author->getName());
        $this->assertEquals($this->authorData['lastName'], $author->getLastName());
        $this->assertEquals($this->authorData['birthDay'], $author->getBirthDay());
        $this->assertEquals($this->authorData['biography'], $author->getBiography());
    }
}
