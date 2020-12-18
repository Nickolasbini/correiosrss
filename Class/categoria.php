<?php

/**
* 
*/
class categoria extends bdConnection
{
	
	function __construct()
	{	
		// Sets this Class/Table name for further use in bdConnection
		$this->setClassName(get_class($this));
		parent::__construct();
	}

	private $id;

	private $nomeCategoria;


	public function getId(){
		return $this->id;
	}
	
	public function setId($id){
		$this->id = $id;
		$this->fillSaveParams('id',$id);
	}

	public function getNomeCategoria(){
		return $this->nomeCategoria;
	}
	
	public function setNomeCategoria($nomeCategoria){
		$this->nomeCategoria = $nomeCategoria;
		$this->fillSaveParams('nomeCategoria',$nomeCategoria);
	}

	/**
	*Generates an HTML designed for the formTitle
	*
	*@param  <string> formTitle - required ( the type of form to generate )
	*
	*@return <string> $htmlForm | The html of the called type pf Form
	*/
	public function fetchCategoryForm($formTitle){
		$result = $this->fetchAll();

		if($formTitle == 'saveNew'){
			$formTitle = 'Cadastrar Novo:';
			$htmlForm = '<form class="saveNew"><label class="title">'. $formTitle . ' </label></br>
						<label for="nomeCategoria">Nome da Categoria</label><br>
	  				    <input type="text" id="nomeCategoria" name="nomeCategoria"><br>
	  				    </form>
	  				    <a id="salvar" class="saveNewButton"><i class="fas fa-plus saveIcon"></i></a>';
		}else if($formTitle == 'remove'){
			// generates here the form for this type
			$formTitle = 'Escolha uma categoria para exluir:';
			
			$htmlForm = '<label class="title">'. $formTitle .'</label><select id="removeList" class="remove select-master" name="Categorias" id="Categorias">';

			foreach($result as $category){
				$inUse = $this->checkIfInUse('produto', 'WHERE categoria = '. $category['id']);
				if($inUse){
					$inUse = 'disabled';
				}

				$htmlForm .= '<optgroup class="option-group">
						          <option class="option-item" '. $inUse .' value="'. $category['id'] .' '. $category['nomeCategoria'] .'">'. $category['nomeCategoria'] .'</option>
						      </optgroup>';
			}

			$htmlForm .= '</select>
						   
						   <a id="removeThis"><i class="fas fa-trash removeIcon"></i></a>';
			
		}else{
			$formTitle = 'Escolha uma categoria para editar:';
			
			$htmlForm = '<label class="title">'. $formTitle .'</label><select class="edit select-master" name="Categorias" id="Categorias">';

			foreach($result as $category){
				$htmlForm .= '<optgroup class="option-group">
						          <option class="option-item" value="'. $category['id'] .'">'. $category['nomeCategoria'] .'</option>
						      </optgroup>';
			}

			$htmlForm .= '</select>
						  <input id="newNameField" placeholder="Novo nome" type="text">
						  <a id="alterButton"><i class="fas fa-edit editIcon"></i></a>';
		}

		return $htmlForm;
	}

}