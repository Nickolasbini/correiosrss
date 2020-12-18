<?php 

require_once('config.php');

useFile(['functionsClass']);

$url    = ( isset($_POST['url']) ? $_POST['url'] : null);
$action = ( isset($_POST['action']) ? $_POST['action'] : null);

// Route for GEtList of determined Class
if(strpos($action, 'GetList')){
	$listHtml = getListFor($url, $action);
	return $listHtml;
}

/**
*Verify which list class to call
*
*@param <string> url    ( the type of form )
*@param <string> action ( the method or action intendend )
*
*@return <indexed array> 'success' => bool, 'content' => string
*/
function getListFor($url, $action){
	if(strpos($action, 'produto')){
		useFile(['produto','categoria']);
		$produto = new Produto();

		$categoria  = new Categoria();
		$categories = $categoria->fetchAll();

		$result = $produto->fetchCategoryForm($url, $categories);
		$response = [
			'success' => true,
			'content' => $result
		];
		
		echo json_encode($response);

	}else if(strpos($action, 'categoria')){
		useFile(['categoria']);
		$categoria = new Categoria();

		$result = $categoria->fetchCategoryForm($url);
		$response = [
			'success' => true,
			'content' => $result
		];
		
		echo json_encode($response);

	}else if(strpos($action, 'promocao')){
		return 'promocao';
	}


	return;
}	

