<?php

namespace App\Entities;

use DateTime;

class Author
{
    private int $id;
    private string $name;
    private string $lastName;
    private DateTime $birthDay;
    private ?string $biography;

    public function __construct(int $id, string $name, string $lastName, DateTime $birthDay, ?string $biography = null)
    {
        $this->id = $id;
        $this->name = $name;
        $this->lastName = $lastName;
        $this->birthDay = $birthDay;
        $this->biography = $biography;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getLastName(): string
    {
        return $this->lastName;
    }

    public function getBirthDay(): DateTime
    {
        return $this->birthDay;
    }

    public function getBiography(): ?string
    {
        return $this->biography;
    }
}
