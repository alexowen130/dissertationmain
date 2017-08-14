<?php

namespace App\middleware;

class persistantDataMiddleware extends middleware
{

    public function __invoke($request, $response, $next)
    {
        //Calls Data that was set from session
        $this->container->view->getEnvironment()->addGlobal('persistant', $_SESSION['persistant']);

        //Uses Data entered in field
        $_SESSION['persistant'] = $request->getParams();

        //Calls next middleware
        $response = $next($request, $response);
        return $response;

    }

}