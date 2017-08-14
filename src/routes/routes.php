<?php

/**
Sets the URLS for the application 
**/

$app->get('/', 'HomeController:index')->setName('home');

//Registering Users
$app->get('/signup', 'PermissionController:getSignUp')->setName('auth.signup');
$app->post('/signup', 'PermissionController:postSignUp');

//Signing In
$app->get('/signin', 'PermissionController:getSignIn')->setName('auth.signin');
$app->post('/signin', 'PermissionController:postSignIn');

//Sign Out
$app->get('/signout', 'PermissionController:getSignOut')->setName('auth.signout');

//Submmiting Files

$app->get('/submit', 'SubmitController:getdownload')->setName('submit.download');
$app->post('/submit', 'SubmitController:postdownload');
