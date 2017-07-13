<?php

$app->get('/', 'HomeController:index');
$app->get('/signup', 'PermissionController:getSignUp')->setName('auth.signup');