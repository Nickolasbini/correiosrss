<?php

spl_autoload_register(function($class_name){

	$filename = $class_name . '.php';

	if(file_exists($filename)){
		require_once($filename);
	}

});

function useFile($nameArray){
	$routes = [
		'functionsClass' => require_once('functionClass.php'),
		'promocao'       => require_once('promocao.php'),
		'categoria'      => require_once('categoria.php'),
		'produto'        => require_once('produto.php'),
	];

	foreach($routes as $route => $required){
		foreach($nameArray as $name){
			if(in_array($name, $routes)){
				return $required;
			}
		}
	}
}

?>