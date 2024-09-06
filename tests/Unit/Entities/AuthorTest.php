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
            'name' => 'César',
            'lastName' => 'Escudero',
            'birthDay' => new DateTime('1997-11-19'),
            'biography' => 'Nació en Barinas'
        ];
    }

    #[Test]
    public function canBeCreatedWithRequiredFields(): void
    {
        $author = new Author(
            $this->authorData['name'],
            $this->authorData['lastName'],
            $this->authorData['birthDay']
        );

        $this->assertEquals($this->authorData['name'], $author->getName());
        $this->assertEquals($this->authorData['lastName'], $author->getLastName());
        $this->assertEquals($this->authorData['birthDay'], $author->getBirthDay());
        $this->assertNull($author->getBiography());
    }

    #[Test]
    public function canBeCreatedWithOptionalBiography(): void
    {
        $author = new Author(
            $this->authorData['name'],
            $this->authorData['lastName'],
            $this->authorData['birthDay'],
            $this->authorData['biography']
        );

        $this->assertEquals($this->authorData['name'], $author->getName());
        $this->assertEquals($this->authorData['lastName'], $author->getLastName());
        $this->assertEquals($this->authorData['birthDay'], $author->getBirthDay());
        $this->assertEquals($this->authorData['biography'], $author->getBiography());
    }

    #[Test]
    public function setters(): void
    {
        $author = new Author(
            $this->authorData['name'],
            $this->authorData['lastName'],
            $this->authorData['birthDay'],
            $this->authorData['biography']
        );

        $id = 1;
        $newName = 'Daniel';
        $newLastName = 'Camacho';
        $newBirthDay = new DateTime('1997-12-20');
        $newBiography = 'Updated biography';

        $author->setId($id);
        $author->setName($newName);
        $author->setLastName($newLastName);
        $author->setBirthDay($newBirthDay);
        $author->setBiography($newBiography);

        $this->assertEquals($id, $author->getId());
        $this->assertEquals($newName, $author->getName());
        $this->assertEquals($newLastName, $author->getLastName());
        $this->assertEquals($newBirthDay, $author->getBirthDay());
        $this->assertEquals($newBiography, $author->getBiography());
    }
}
