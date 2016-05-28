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
$container['view'] = function ($container){
    $settings = $container->settings;
    $view = new Slim\Views\Twig($settings['view']['template_path'], $settings['view']['twig']);
    $view->addExtension(new Slim\Views\TwigExtension(
        $container->router,
        $container->request->getUri()
    ));
    $view->addExtension(new Twig_Extension_Debug());
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
    return new App\Helpers\ErrorHandler($container->logger);
};

// -----------------------------------------------------------------------------
// Controller factories
// -----------------------------------------------------------------------------
$container['HomeController'] = function ($container) {
    return new App\Controllers\HomeController($container);
};