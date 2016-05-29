<?php

namespace App\Controllers;

use App\Controllers\Controller;
use App\Models\User;
use Slim\Views\Twig as View;
use Psr\Log\LoggerInterface;

class HomeController extends Controller
{
    public function index($request, $response){ 
        return $this->view->render($response, 'home.twig');
    }
}