<?php

namespace App\Model;

class Book
{
    public int $id;
    public string $title;
    public string $description;
    public string $author;
    public string $publishing_year;
    public bool $is_available;
}