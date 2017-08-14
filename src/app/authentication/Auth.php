<?php

/**
Controls Authentication of App
**/

namespace App\Authentication;

use App\models\user;

//Talks to DB to setup and check user
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

    //For User to attempt to log in
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

    //Logs Out
    public function logout()
    {
        unset($_SESSION['user']);

    }
}