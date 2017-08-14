<?php

namespace App\middleware;

class validationMiddleware extends middleware
{

    //Adds errors to container and Session using error variable
    public function __invoke($request, $response, $next)
    {
        $this->container->view->getEnvironment()->addGlobal('errors', $_SESSION['errors']);

        unset($_SESSION['errors']);

        $response = $next($request, $response);
        return $response;

    }

}