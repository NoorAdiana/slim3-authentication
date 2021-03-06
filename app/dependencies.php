<?php

$container = $app->getContainer();

// -----------------------------------------------------------------------------
// Illuminate Eloquent Capsule
// -----------------------------------------------------------------------------
$capsule = new Illuminate\Database\Capsule\Manager;
$capsule->addConnection($container->settings['db']);
$capsule->setAsGlobal();
$capsule->bootEloquent();

// -----------------------------------------------------------------------------
// Twig
// -----------------------------------------------------------------------------

// Authentication
$container['auth'] = function ($container) {
    return new App\Auth\Authentication;
};

// Flash Message
$container['flash'] = function () {
    return new \Slim\Flash\Messages();
};

// View
$container['view'] = function ($container){
    $settings = $container->settings;
    $view = new Slim\Views\Twig($settings['view']['template_path'], $settings['view']['twig']);
    $view->addExtension(new Slim\Views\TwigExtension(
        $container->router,
        $container->request->getUri()
    ));
    $view->addExtension(new Twig_Extension_Debug());

    $view->getEnvironment()->addGlobal('auth', [
        'check' => $container->auth->check(),
        'user' => $container->auth->user(),
    ]);

    $view->getEnvironment()->addGlobal('flash', $container->flash);

    return $view;
};


// -----------------------------------------------------------------------------
// Service factories
// -----------------------------------------------------------------------------

// Database
$container['db'] = function ($container) use ($capsule) {
    return $capsule;
};

// Monolog
$container['logger'] = function ($c) {
    $settings = $c->get('settings');
    $logger = new Monolog\Logger($settings['logger']['name']);
    $logger->pushProcessor(
        new Monolog\Processor\UidProcessor()
    );
    $logger->pushHandler(
        new Monolog\Handler\StreamHandler($settings['logger']['path'], 
        Monolog\Logger::DEBUG)
    );
    return $logger;
};

// Error Handlers
$container['errorHandler'] = function ($container) {
    return new App\Handlers\ErrorHandler($container->logger);
};

// Validation
$container['validator'] = function ($container) {
    return new App\Validation\Validator;
};

// Slim CSRF
$container['csrf'] = function ($container) {
    return new Slim\Csrf\Guard;
};

// -----------------------------------------------------------------------------
// Controller factories
// -----------------------------------------------------------------------------
$container['HomeController'] = function ($container) {
    return new App\Controllers\HomeController($container);
};

$container['AuthController'] = function ($container) {
    return new App\Controllers\Auth\AuthController($container);
};

$container['PasswordController'] = function ($container) {
    return new App\Controllers\Auth\PasswordController($container);
};
