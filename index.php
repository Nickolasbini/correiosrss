<?php

require_once("vendor/autoload.php");

$app = new \Slim\Slim();

$app->get('/', function(){
	require_once('user.php');
});

$app->get('/admin', function(){
	require_once('admin.php');
});

$app->run();


?>

