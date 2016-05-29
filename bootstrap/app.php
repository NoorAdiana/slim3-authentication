<?php

use Respect\Validation\Validator as v;

session_start();

require __DIR__ . '/../vendor/autoload.php';

$settigs = require __DIR__ . '/../app/settings.php';
$app = new Slim\App($settigs);

// Set up dependencies  
require __DIR__ . '/../app/dependencies.php';

// Set up middleware  
require __DIR__ . '/../app/middleware.php';

// Setting Custom Validation
v::with('App\\Validation\\Rules\\');

// Set up router
require __DIR__ . '/../app/routes.php';

