<?php

$container = $app->getContainer();

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
// Controller factories
// -----------------------------------------------------------------------------
$container['HomeController'] = function ($container) {
    return new App\Controllers\HomeController($container->view);
};