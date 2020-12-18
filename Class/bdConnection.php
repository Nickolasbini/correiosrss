<?php

/**
 * 
 */
class bdConnection extends PDO{

	public function __construct(){
		$bdObject = new PDO("mysql:host=localhost;dbname=peixaria", "root", "");
		$this->setConnection($bdObject);
	}

	private $connection;

	private $className;

	// Columns name to INSERT or ALTER
	private $columnsName;

	// Values for INSERT or ALTER
	private $columnsValue;

	// Query for different purposes
	private $customQuery;

	public function getConnection(){
		return $this->connection;
	}
	
	public function setConnection($connection){
		$this->connection = $connection;
	}

	public function getClassName(){
		return $this->className;
	}
	
	public function setClassName($className){
		$this->className = $className;
	}


	public function getColumnsName(){
		return $this->columnsName;
	}
	
	public function setColumnsName($columnsName){
		$this->columnsName = $columnsName;
	}	

	public function getColumnsValue(){
		return $this->columnsValue;
	}
	
	public function setColumnsValue($columnsValue){
		$this->columnsValue = $columnsValue;
	}

	public function getCustomQuery(){
		return $this->customQuery;
	}
	
	public function setCustomQuery($customQuery){
		$this->customQuery = $customQuery;
	}

	public function fetchAll(){
		$statement = $this->getConnection()->prepare('SELECT * FROM ' . $this->getClassName());
		if ($statement->execute()) { 
		   return $statement->fetchAll(PDO::FETCH_ASSOC);
		} else {
		   return false;
		}
	}

	public function fetchById($id){
		$statement = $this->getConnection()->prepare('SELECT * FROM ' . $this->getClassName() . ' WHERE id = :ID');
		$statement->bindParam(':ID', $id);
		if ($statement->execute()) { 
		   return $statement->fetchAll(PDO::FETCH_ASSOC);
		} else {
		   return false;
		}
	}

	public function remove($id){
		$statement = $this->getConnection()->prepare('DELETE FROM ' . $this->getClassName() . ' WHERE id = :ID');
		$statement->bindParam(':ID', $id);
		if ($statement->execute()) { 
		   return true;
		} else {
		   return false;
		}
	}

	/*
	* Generic SAVE method which INSERTS or ALTERS value(s) at a certain table
	*
	* return <bool> $sql
	*/
	public function save(){

		try {
			$typeOfOperation = 'criado com sucesso';
			$statement = $this->getConnection();
			$statement->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			// Calls method to create query for either INSERT or UPDATE
			$sql = $this->prepareSaveQuery();
			$statement->exec($sql['query']);

			// Cleaning history;
			$this->cleanQuery();

			$response = [
			  'success' => true,
			  'content' => $sql['content']
			];
			return $response;

		} catch(PDOException $e) {
			$response = [
			  'success' =>  false,
			  'content' => 'Erro ao adicionar '. $e->getMessage()
			];
			return $response;
		}

	}

	public function customQueryMaker(){
		$statement = $this->getConnection()->prepare('DELETE FROM ' . $this->getClassName());
		$statement->bindParam(':ID', $id);
		if ($statement->execute()) { }
	}

	/*
	* Gets the table columnsName and columnsValues and prepares them into a query for further use,
	* checks if an 'ID' columnsName is available, if it is it know this query must be an ALTER (update). If not
	* present it will be an INSERT (save)
	* return <string> $sql ( either an INSERT or ALTER query)
	*/
	public function prepareSaveQuery(){
		// Table columns to insert
		$columns = $this->getColumnsName();
		$columns = rtrim($columns, ",");

		// Values to insert at table
		$columnsValues = $this->getColumnsValue();
		$columnsValues = rtrim($columnsValues, ",");

		$columnsNameArray = explode(",", $columns);

		if(in_array('id', $columnsNameArray)){
			$columnsValueArray = explode(",", $columnsValues);
			
			$sql = 'UPDATE '.$this->getClassName().' SET';
			$valueToSet = '';
			$id = '';
			for($i = 0; $i < count($columnsValueArray); $i++){
				if($i == count($columnsValueArray) - 1){
					$valueToSet .= $columnsNameArray[$i].' = '. $columnsValueArray[$i];
					break;
				}

				if($columnsNameArray[$i] != 'id'){
					$valueToSet .= $columnsNameArray[$i].' = '. $columnsValueArray[$i]. ' , ';
				}else{
					$id = $columnsValueArray[$i];
				}
			}

			$response = [
				'query'   => $sql. ' ' .$valueToSet. 'WHERE id = '.$id,
				'content' => 'alterado com sucesso'
			];

		}else{
			$sql = 'INSERT INTO '.$this->getClassName().' ('.$columns.') VALUES ('.$columnsValues.')';

			$response = [
				'query'   => $sql,
				'content' => 'criado com sucesso'
			];
		}
		
		return $response;
	} 

	public function cleanQuery(){
		$this->setColumnsName('');
		$this->setColumnsValue('');
	}

	// Check if the following Table has the sent Query
	public function checkIfInUse($tableName, $where){
		$statement = $this->getConnection()->prepare('SELECT * FROM ' . $tableName . ' ' . $where . ' ');

		$statement->execute();
		$value = $statement->fetchAll(PDO::FETCH_ASSOC);
		if(!empty($value)) { 
		   return true;
		}else{
			return false;
		}

	}

	/*
	* Method responsible by setting bdConnection class variables for further insert/alter purpose
	* param <string> $key   - required  (the string list of this class BD columns name)
	* param <string> $value - required  (the string list of this class BD columns value to 'insert' or 'alter')
	* return <nil>
	*/
	public function fillSaveParams($key,$value){
		$value = '"' . $value . '"';

		$position = 0;
		if(empty($this->getColumnsName())){
			$this->setColumnsName($this->getColumnsName().$key.',');
		}else{
			$position = strlen($this->getColumnsName());
			$columnsString = $this->getColumnsName();
			if($columnsString[$position - 1] == ','){
				$this->setColumnsName($this->getColumnsName().$key.',');
			}
		}

		$position = 0;
		if(empty($this->getColumnsValue())){
			$this->setColumnsValue($this->getColumnsValue().$value.',');
		}else{
			$position = strlen($this->getColumnsValue());
			$valuesString = $this->getColumnsValue();
			if($valuesString[$position - 1] == ','){
				$this->setColumnsValue($this->getColumnsValue().$value.',');
			}
		}
	}


}
?>