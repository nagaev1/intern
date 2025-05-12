<?php

// phpinfo();

ini_set('display_errors', 1);
require_once realpath('vendor/autoload.php');

\App\Core\Database::connect();
\App\Core\Database::createTable();

include './helpers.php';
require_once './web.php';