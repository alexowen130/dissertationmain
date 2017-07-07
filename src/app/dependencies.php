<?php

session_start();


require __DIR__ . '/../../vendor/autoload.php';


$app = new \Slim\App([
	'settings'=> [
		'displayErrorDetails' => true,
		]
]);


$container = $app->getContainer();

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


require __DIR__ . '/../routes/routes.php';