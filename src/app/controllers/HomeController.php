<?php

namespace App\Controllers;

use App\controllers\BaseController;
use Slim\Views\Twig as View;
use App\models\user;


//Base Template Controller
class HomeController extends BaseController
{

    public function index($request, $response)
    {

        return $this->container->view->render($response, 'tutor/tutor.html');
    }
}