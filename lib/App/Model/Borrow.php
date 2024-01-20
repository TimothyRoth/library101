<?php

namespace App\Model;

class Borrow
{
    public int $user_id;
    public int $book_id;
    public string $start;
    public string $end;
    public int $id;
}