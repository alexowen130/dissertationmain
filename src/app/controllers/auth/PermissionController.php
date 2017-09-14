<?php

namespace App\Controllers\auth;

use App\controllers\BaseController;
use App\models\user;
use Respect\Validation\Validator as v;

class PermissionController extends BaseController
{

    //Returns Sign In Page
    public function getSignUp($request, $response)
    {
        return $this->container->view->render($response, 'permissions/signup.html');

    }

    //Gets Info from user to create new user
    public function postSignUp($request, $response)
    {

            $validation = $this->container->validator->validate(
                $request, [

                'username' => v::noWhitespace()->notEmpty(),
                'password' => v::noWhitespace()->notEmpty(),

                ]
            );

            //If validation fails tells user what issue is present
        if ($validation->failed()) {

                return $response->withRedirect($this->container->router->pathFor('auth.signup'));

        }

            //Creates new user in DB
            $user = User::create(
                [

                'username' => $request->getParam('username'),
                'password' => password_hash($request->getParam('password'), PASSWORD_DEFAULT),

                ]
            );

            //Flash message for account setup Sucess
            $this->container->flash->addMessage('info', 'Welcome, You have created an Account');

            $this->container->auth->attempt($user->username, $request->getParam('password'));

            return $response->withRedirect($this->container->router->pathFor('home'));
    }

    // Gets Sign In Page
    public function getSignIn($request, $response)
    {

        return $this->container->view->render($response, 'permissions/signin.html');

    }

    //Checks Log In attempt information
    public function postSignIn($request, $response)
    {

        $auth = $this->container->auth->attempt(
            $request->getParam('username'),
            $request->getParam('password')
        );

        if (!$auth) {

            $this->container->flash->addMessage('error', 'Could not authorise your details, please try again');

            return $response->withRedirect($this->container->router->pathFor('auth.signin'));

        }

        //Flash message confirming LogIn
        $this->container->flash->addMessage('info', 'Welcome, You have signed in');

        //Redirects back to home
        return $response->withRedirect($this->container->router->pathFor('home'));

    }

    //Logs User Out
    public function getSignOut($request, $response)
    {
        $this->container->auth->logout();

        $this->container->flash->addMessage('info', 'You have signed out sucessfully');

        return $response->withRedirect($this->container->router->pathFor('home'));
    }

}