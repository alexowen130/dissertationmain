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

			'username' => v::noWhitespace()->notEmpty(),
			'password' => v::noWhitespace()->notEmpty(),

		]);

		if ($validation->failed()){

			return $response->withRedirect($this->container->router->pathFor('auth.signup'));

		}


		$user = User::create([

			'username' => $request->getParam('username'),
			'password' => password_hash($request->getParam('password'), PASSWORD_DEFAULT),

			]);

		$this->container->auth->attempt($user->username, $request->getParam('password'));

		return $response->withRedirect($this->container->router->pathFor('home'));
		
	}


	public function getSignIn($request, $response)
	{

		return $this->container->view->render($response, 'permissions/signin.html');

	}

	public function postSignIn($request, $response)
	{

		$auth = $this->container->auth->attempt(

			$request->getParam('username'),
			$request->getParam('password')

			);

		if (!$auth) {

			return $response->withRedirect($this->container->router->pathFor('auth.signin'));
		}

		return $response->withRedirect($this->container->router->pathFor('home'));

	}

	public function getSignOut($request, $response)
	{
		$this->container->auth->logout();

		return $response->withRedirect($this->container->router->pathFor('home'));
	}

}