<?php 

require_once('config.php');

useFile(['functionsClass','categoria','produto']);

$url    = ( isset($_POST['url']) ? $_POST['url'] : null);
$action = ( isset($_POST['action']) ? $_POST['action'] : null);

/**
Method responsible by removing a Product
*/
if(strpos($action, 'removeProdutct')){
	
	$productId = isset($_POST['productId']) ? $_POST['productId'] : null;

	$produto = new Produto();

	$result = $categoria->remove($productId);
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

	$productId          = isset($_POST['parameters']['productId']) ? $_POST['parameters']['productId'] : null;
	$productPhoto       = isset($_POST['parameters']['productPhoto']) ? $_POST['parameters']['productPhoto'] : null;
	$productTitle       = isset($_POST['parameters']['productTitle']) ? $_POST['parameters']['productTitle'] : null;
	$productDescription = isset($_POST['parameters']['productDescription']) ? $_POST['parameters']['productDescription'] : null;
	$categoryId         = isset($_POST['parameters']['categoryId']) ? $_POST['parameters']['categoryId'] : null;
	$productPrice       = isset($_POST['parameters']['productPrice']) ? $_POST['parameters']['productPrice'] : null;
	
	$productWk = new Produto();
	
	if(!is_null($productId)){	
		$productWk->setId($productId);
	}

	$productWk->setProdutoPhoto($productPhoto);
	$productWk->setTitulo($productTitle);
	$productWk->setDescricao($productDescription);
	$productWk->setCategoria($categoryId);
	$productWk->setPreco($productPrice);
	$result = $productWk->save();
	
	echo json_encode($result);
	return json_encode($result);
}