<?php
namespace App\Displays;

use App\Colors\TextColor;
use App\Colors\BackgroundColor;

class MonitorDisplay extends BaseDisplay
{
    public TextColor $textColor;
    public BackgroundColor $backgroundColor;

    public function __construct(TextColor $textColor, BackgroundColor $backgroundColor)
    {
        $this->textColor = $textColor;
        $this->backgroundColor = $backgroundColor;
    }

    public function display(string $text): void
    {
        $text = "\e[{$this->textColor->value};{$this->backgroundColor->value}m$text\e[0m\n";
        parent::display($text);
    }
}
