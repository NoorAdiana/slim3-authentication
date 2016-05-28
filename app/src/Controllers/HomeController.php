<?php

namespace App\Controllers;

use Slim\Views\Twig as View;
use Psr\Log\LoggerInterface;

class HomeController
{
    protected $view;
    protected $logger;

    public function __construct(View $view, LoggerInterface $logger){
        $this->view = $view;
        $this->logger = $logger;
    }

    public function index($request, $response){
        $this->logger->info("Home page action dispatched");
        return $this->view->render($response, 'home.twig');
    }
}