<?php

session_start();

require __DIR__ . '/../vendor/autoload.php';

$settigs = require __DIR__ . '/../app/settings.php';
$app = new Slim\App($settigs);

// Set up dependencies  
require __DIR__ . '/../app/dependencies.php';

require __DIR__ . '/../app/routes.php';

