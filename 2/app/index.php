<?php

use App\Displays\BaseDisplay;
use App\Displays\MonitorDisplay;
use App\Displays\PrinterDisplay;
use App\Colors\BackgroundColor;
use App\Colors\TextColor;

require_once realpath("vendor/autoload.php");

$baseDisplay = new BaseDisplay();
$baseDisplay->display("base display\n");
$monitor = new MonitorDisplay(TextColor::red, BackgroundColor::green);
$monitor->display("Monitor display\n");
$printer = new PrinterDisplay(1);
$printer->display('printer display');
