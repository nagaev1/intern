<?php

namespace App\Models;

use App\Core\Model;

class Post extends Model
{
    protected static string $table = 'posts';

    public int $id;
    public string $text;
}
