<?php

namespace App\Handlers;

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
        $error = [
            'Type' => get_class($exception),
            'Message' => $exception->getMessage(),
            'File' => $exception->getFile(),
            'Line' => $exception->getLine()
        ];
        $this->logger->critical(json_encode($error));

        return parent::__invoke($request, $response, $exception);
    }
}