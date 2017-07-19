<?php

use Respect\Validation\Validator as v;

session_start();

require __DIR__ . '/../../vendor/autoload.php';


$app = new \Slim\App([
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
]);


$container = $app->getContainer();

$capsule = new \Illuminate\Database\Capsule\Manager;

$capsule->addConnection($container['settings']['db']);
$capsule->setAsGlobal();
$capsule->bootEloquent();


$container['db'] = function ($container) use ($capsule) {
	return $capsule;
};

$container['view'] = function ($container) {
	$view = new \Slim\Views\Twig(__DIR__ . '/../templates', [
		'cache' => false,
		]);
	$view->addExtension(new \Slim\Views\TwigExtension(
		$container->router,
		$container->request->getUri()
		));
		return $view;
};

///////Start of Controllers


$container['PermissionController'] = function($container) {
	return new \App\controllers\auth\PermissionController($container);
};

$container['validator'] = function ($container){

	return new \App\validation\validator;

};

$container['HomeController'] = function($container) {
	return new \App\controllers\HomeController($container);
};

///////End of Controlllers


//////Start of Middleware /////////

$app->add(new \App\middleware\validationMiddleware($container));

$app->add(new \App\middleware\persistantDataMiddleware($container));


////Custom validation rules/////
v::with('app\\validation\\rules\\');

////End of Custom validation rules /////
//////End of Middleware ///////////

require __DIR__ . '/../routes/routes.php';
