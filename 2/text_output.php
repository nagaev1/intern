<?php

enum TextColor: string
{
    case black = '0;30';
    case white = '1;37';
    case darkGrey = '1;30';
    case red = '0;31';
}

enum BackgroundColor: string
{
    case black = '40';
    case red = '41';
    case green = '42';
}

class BaseDisplay
{
    public function display(string $text): void
    {
        echo $text;
    }
}

class PrinterDisplay extends BaseDisplay
{
    public int $timer = 1;

    function __construct(int $timer)
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

class MonitorDisplay extends BaseDisplay
{

    public TextColor $textColor;
    public BackgroundColor $backgroundColor;

    function __construct(TextColor $textColor, BackgroundColor $backgroundColor)
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

$baseDisplay = new BaseDisplay();
$baseDisplay->display("base display\n");
$monitor = new MonitorDisplay(TextColor::red, BackgroundColor::green);
$monitor->display("Monitor display\n");
$printer = new PrinterDisplay(1);
$printer->display('printer display');