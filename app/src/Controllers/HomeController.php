<?php

namespace App\Controllers;

use App\Controllers\Controller;
use Slim\Views\Twig as View;
use Psr\Log\LoggerInterface;

class HomeController extends Controller
{
    public function index($request, $response){
        $this->logger->info("Home page action dispatched");
        return $this->view->render($response, 'home.twig');
    }
}