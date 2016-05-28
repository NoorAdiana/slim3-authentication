<?php

namespace App\Helpers;

use Slim\Handlers\Error;
use Monolog\Logger;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;

class ErrorHandler extends Error
{
    protected $logger;

    public function __construct(Logger $logger)
    {
        $this->logger = $logger;
    }

    public function __invoke(Request $request, Response $response, \Exception $exception)
    {
        $this->logger->critical($exception->getMessage());

        return parent::__invoke($request, $response, $exception);
    }
}