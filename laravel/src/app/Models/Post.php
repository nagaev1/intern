<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Post extends Model
{
    use HasFactory;
    protected $fillable = ['text', 'image'];

    public function hasString(string $string): bool
    {
        return str_contains(
            strtolower($this->text),
            strtolower($string)
        );
    }
}
