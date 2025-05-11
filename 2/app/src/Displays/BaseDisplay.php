<?php
namespace App\Displays;

class BaseDisplay
{
    public function display(string $text): void
    {
        echo $text;
    }
}