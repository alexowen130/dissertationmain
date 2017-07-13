<?php

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


$container['HomeController'] = function($container) {
	return new \App\controllers\HomeController($container);
};

$container['PermissionController'] = function($container) {
	return new \App\controllers\auth\PermissionController($container);
};




require __DIR__ . '/../routes/routes.php';
