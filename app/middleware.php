<?php
// Validation input user
$app->add(new App\Middleware\ValidationErrorsMiddleware($container));

// Get old data input from user
$app->add(new App\Middleware\OldInputMiddleware($container));

// CSRF View
$app->add(new App\Middleware\CsrfViewMiddleware($container));

// Slim CSRF
$app->add($container->csrf);