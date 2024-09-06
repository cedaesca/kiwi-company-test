<?php

namespace App\Entities;

use DateTime;

class User
{
    private string $name;
    private string $lastName;
    private string $email;
    private DateTime $createdAt;

    public function __construct(string $name, string $lastName, string $email, DateTime $createdAt)
    {
        $this->name = $name;
        $this->lastName = $lastName;
        $this->email = $email;
        $this->createdAt = $createdAt;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function setLastName(string $lastName): self
    {
        $this->lastName = $lastName;

        return $this;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function setCreatedAt(DateTime $createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getLastName(): string
    {
        return $this->lastName;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function getCreatedAt(): DateTime
    {
        return $this->createdAt;
    }
}
