<?php

namespace App\Entities;

use DateTime;
use App\Entities\Author;

class Book
{
    private string $title;
    private Author $author;
    private string $isbn;
    private DateTime $publishDate;

    public function __construct(string $title, Author $author, string $isbn, DateTime $publishDate)
    {
        $this->title = $title;
        $this->author = $author;
        $this->isbn = $isbn;
        $this->publishDate = $publishDate;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }

    public function setAuthor(Author $author): self
    {
        $this->author = $author;

        return $this;
    }

    public function setIsbn(string $isbn): self
    {
        $this->isbn = $isbn;

        return $this;
    }

    public function setPublishDate(DateTime $publishDate): self
    {
        $this->publishDate = $publishDate;

        return $this;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function getAuthor(): Author
    {
        return $this->author;
    }

    public function getIsbn(): string
    {
        return $this->isbn;
    }

    public function getPublishDate(): DateTime
    {
        return $this->publishDate;
    }
}
