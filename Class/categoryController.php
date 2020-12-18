<?php 

require_once('config.php');

useFile(['functionsClass','categoria']);

$url    = ( isset($_POST['url']) ? $_POST['url'] : null);
$action = ( isset($_POST['action']) ? $_POST['action'] : null);
$parameters = ( isset($_POST['parameters']) ? $_POST['parameters'] : null);

/**
Method responsible by removing a not in use Category
*/
if(strpos($action, 'removeCategory')){
	
	$categoria = new Categoria();

	$parameters = explode(' ', $parameters);

	$result = $categoria->remove($parameters[0]);
	if(!$result){
		$response = [
			'success' => false,
			'content' => 'Um erro ocorreu, tente novamente mais tarde!'
		];
		echo json_encode($response);
		return json_encode($response);
	}

	$response = [
		'success' => true,
		'content' => 'Removido com sucesso'
	];
	echo json_encode($response);
	return json_encode($response);
}


/**
Save
*/
if(strpos($action, 'save') || strpos($action, 'saveNew')){

	$categoryId   = isset($_POST['categoryId'])   ? $_POST['categoryId'] : null;
	$categoryName = isset($_POST['categoryName']) ? $_POST['categoryName'] : null;

	$categoriaWk = new Categoria();
	
	if(!is_null($categoryId)){	
		$categoriaWk->setId($categoryId);
	}
	$categoriaWk->setNomeCategoria($categoryName);
	$result = $categoriaWk->save();
	
	echo json_encode($result);
	return json_encode($result);
}
