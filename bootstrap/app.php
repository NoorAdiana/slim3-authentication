<?php

session_start();

require __DIR__ . '/../vendor/autoload.php';

$settigs = require __DIR__ . '/../app/settings.php';
$app = new \Slim\App();

require __DIR__ . '/../app/routes.php';

