<?php

namespace App\Controllers;

use App\controllers\BaseController;
use Slim\Views\Twig as View;


class HomeController extends BaseController
{

	public function index($request, $response)
	{

		return $this->container->view->render($response, 'base.html');
	
	}
}