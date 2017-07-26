<?php

namespace App\Authentication;

use App\models\user;

class Auth
{

	public function user()
	{

		return User::find($_SESSION['user']);
	}

	public function signedIn()
	{

		return isset($_SESSION['user']);

	}


	public function attempt($username, $password)
	{

		$user = User::where('username', $username)->first();

		if (!$user) {

			return false;
		}

		if (password_verify($password, $user->password)) {

			$_SESSION['user'] = $user->id;
			return true;
		}

		return false;

	}

	public function logout()
	{
		unset($_SESSION['user']);


	}
}