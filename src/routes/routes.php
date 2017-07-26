<?php


$app->get('/', 'HomeController:index')->setName('home');

//Registering Users
$app->get('/signup', 'PermissionController:getSignUp')->setName('auth.signup');
$app->post('/signup', 'PermissionController:postSignUp');

//Signing In
$app->get('/signin', 'PermissionController:getSignIn')->setName('auth.signin');
$app->post('/signin', 'PermissionController:postSignIn');

//Sign Out
$app->get('/signout', 'PermissionController:getSignOut')->setName('auth.signout');


