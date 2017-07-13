<?php

namespace App\Controllers\auth;

use App\controllers\BaseController;
use Slim\Views\Twig as View;
use App\models\user;

class PermissionController extends BaseController
{

	public function getSignUp($request, $response)
	 {
	 	return $this->container->view->render($response, 'permissions/signup.html');


	}

}