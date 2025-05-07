<?php
namespace App\Displays;

class PrinterDisplay extends BaseDisplay
{
    public int $timer = 1;

    public function __construct(int $timer)
    {
        $this->timer = $timer;
    }

    public function display(string $text): void
    {
        foreach (str_split($text) as $letter) {
            parent::display($letter);
            sleep($this->timer);
        }
    }
}