<?php

namespace App\Middleware;

class AuthMiddleware extends Middleware
{
    public function __invoke($request, $response, $next)
    {               
        if(!$this->auth->check()){
            $this->flash->addMessage('error', 'Please sign in before doing that.');
            return $response->withRedirect($this->router->pathFor('auth.signin'));
        }

        $response = $next($request, $response);
        return $response;
    }
}