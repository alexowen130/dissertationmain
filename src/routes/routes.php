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

//Displaying FIles uploaed
$app->get('/results', 'ResultController:getResults')->setName('results.download');

//Download Coding Standards Results
$app->get('/results/{filename}', 'DownloadingController:getDownload')->setName('downloading.download');

//Downloads Original File
$app->get('/results/file/{filename}', 'DownloadingController:getFile')->setName('downloading.file');


$app->get('/unittest', 'UnittestController:getTest')->setName('unittest.file');
$app->post('/unittest', 'UnittestController:postTestDownload');

//Get example Doc PHP
$app->get('/unittest/PHP', 'examplephpController:getFilePHP')->setName('unittest.getPHP');

//Get JavaScript example Doc
$app->get('/unittest/JS', 'exampleJSController:getFileJS')->setName('unittest.getJS');