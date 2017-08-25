<?php

define('ROOT_PATH', dirname(dirname(__DIR__)));

/**
Dependancies loaded into App and added to container
 **/

session_start();

//Adds to autoload when App starts

require __DIR__ . '/../../vendor/autoload.php';


//DB connection Setting
$app = new \Slim\App(
    [
    'settings'=> [
        'displayErrorDetails' => true,
        'db' => [
            'driver' => 'mysql',
            'host' => 'localhost',
            'database' => 'markingdb',
            'username' => 'root',
            'password' => 'Earnshaw10',
            'charset' => 'utf8',
            'collation' => 'utf8_unicode_ci',
            'prefix' => '',
        ]
    ],
    ]
);

//Intialises Container for App

$container = $app->getContainer();

//Sets up DB connection
$capsule = new \Illuminate\Database\Capsule\Manager;

$capsule->addConnection($container['settings']['db']);
$capsule->setAsGlobal();
$capsule->bootEloquent();


$container['db'] = function ($container) use ($capsule) {
    return $capsule;
};

//Adds Authentication into App
$container['auth'] = function($container) {
    return new \App\authentication\Auth($container);
};

//Adds Submission Display Fuction
$container['submission'] = function($container) {
    return new \App\Submission\SubmissionDisplay($container);
};

//Adds Flash messages package to allow messages to be shown when criteria are hit 
$container['flash'] = function($container) {
    return new \Slim\Flash\Messages();
};

//Adds template pages to App to be displayed when URI is loaded
$container['view'] = function ($container) {
    $view = new \Slim\Views\Twig(
        __DIR__ . '/../templates', [
        'cache' => false,
        ]
    );

    $view->addExtension(
        new \Slim\Views\TwigExtension(
            $container->router,
            $container->request->getUri()
        )
    );

    //Checks user is logged in checks DB once and then loading user ID into Session

    $view->getEnvironment()->addGlobal(
        'auth', [
        'check' => $container->auth->signedIn(),
        'user' => $container->auth->user(),

        ]
    );

        $view->getEnvironment()->addGlobal('flash', $container->flash);

        return $view;
};

///////Start of Controllers


$container['PermissionController'] = function($container) {
    return new \App\controllers\auth\PermissionController($container);
};

$container['validator'] = function ($container) {

    return new \App\validation\validator;

};

$container['HomeController'] = function($container) {
    return new \App\controllers\HomeController($container);
};

$container['SubmitController'] = function($container) {
    return new \App\controllers\downloadfile\SubmitController($container);
};

$container['ResultController'] = function($container) {
    return new \App\controllers\downloadresults\ResultController($container);
};

$container['DownloadingController'] = function($container) {
    return new \App\controllers\downloadresults\DownloadingController($container);
};


///////End of Controlllers /////////

////// Authentication ////////////


///////Authentication /////////

//////Start of Middleware /////////

$app->add(new \App\middleware\validationMiddleware($container));

$app->add(new \App\middleware\persistantDataMiddleware($container));


////Custom validation rules/////


//Not in use currently

// v::with('App\\validation\\custom\\');


////End of Custom validation rules /////
//////End of Middleware ///////////


require __DIR__ . '/../routes/routes.php';
