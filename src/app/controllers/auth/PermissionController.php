<?php

namespace App\Controllers\auth;

use App\controllers\BaseController;
use App\models\user;
use Respect\Validation\Validator as v;

class PermissionController extends BaseController
{

	public function getSignUp($request, $response)
	 {
	 	return $this->container->view->render($response, 'permissions/signup.html');

	}


	public function postSignUp($request, $response)
	{

			$validation = $this->container->validator->validate($request,[

			'username' => v::noWhitespace()->notEmpty()->usernameAvailible(),
			'password' => v::noWhitespace()->notEmpty(),

		]);

		if ($validation->failed()){

			return $response->withRedirect($this->container->router->pathFor('auth.signup'));

		}


		$user = User::create([

			'username' => $request->getParam('username'),
			'password' => password_hash($request->getParam('password'), PASSWORD_DEFAULT),

			]);

		return $response->withRedirect($this->container->router->pathFor('home'));

		
	}

}