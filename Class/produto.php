<?php

/**
* 
*/
class produto extends bdConnection
{
	
	function __construct()
	{	
		// Sets this Class/Table name for further use in bdConnection
		$this->setClassName(get_class($this));
		parent::__construct();
	}

	private $id;

	private $categoria;

	private $titulo;

	private $descricao;

	private $preco;

	private $produtoPhoto;

	public function getId(){
		return $this->id;
	}
	
	public function setId($id){
		$this->id = $id;
		$this->fillSaveParams('id',$id);
	}

	public function getCategoria(){
		return $this->categoria;
	}
	
	public function setCategoria($categoria){
		$this->categoria = $categoria;
		$this->fillSaveParams('categoria',$categoria);
	}

	public function getTitulo(){
		return $this->titulo;
	}
	
	public function setTitulo($titulo){
		$this->titulo = $titulo;
		$this->fillSaveParams('titulo',$titulo);
	}

	public function getDescricao(){
		return $this->descricao;
	}
	
	public function setDescricao($descricao){
		$this->descricao = $descricao;
		$this->fillSaveParams('descricao',$descricao);
	}

	public function getPreco(){
		return $this->preco;
	}
	
	public function setPreco($preco){
		$this->preco = $preco;
		$this->fillSaveParams('preco',$preco);
	}

	public function getProdutoPhoto(){
		return $this->produtoPhoto;
	}
	
	public function setProdutoPhoto($produtoPhoto){
		$this->produtoPhoto = $produtoPhoto;
		$this->fillSaveParams('imageName',$produtoPhoto);
	}

	/**
	*Generates an HTML designed for the formTitle
	*
	*@param  <string> formTitle - required ( the type of form to generate )
	*
	*@return <string> $htmlForm | The html of the called type pf Form
	*/
	public function fetchCategoryForm($formTitle, $categories){
		if($formTitle != 'saveNew'){
			$result = $this->fetchAll();
		}

		if($formTitle == 'saveNew'){
			$formTitle = 'Cadastrar Novo:';
			$htmlForm = '<img id="myPhoto" class="productPreview Image">
				<label class="imageLabel" for="photo">Escolha uma foto:<i class="far fa-images"></i></label>
				<input type="file" style="display:none;" id="photo" class="imageInput" name="photo"/>
				<span class="productTitle"><label for="title">Titulo:</label><input type="text" id="title" class="productPreview Title" name="titulo"></span>
				<span class="productPreview description"><label for="description">Descrição:</label><input type="text" id="description" name="description"></span>
				<span><label for="categoryChoosen">Categorias:</label>';
			foreach($categories as $category){
				$htmlForm .= '<select id="categoryChoosen" class="productsCategories"><optgroup class="option-group">
						          <option class="option-item" value="'. $category['id'] .'">'. $category['nomeCategoria'] .'</option>
						      </optgroup></select';
			};
			$htmlForm .= '<span class="productPreview price"><label for="price">R$:</label><input type="text" id="price"></span>
				<a id="saveProduct"><i class="fas fa-plus saveIcon"></i></a>';

		}else if($formTitle == 'remove'){
			// generates here the form for this type
			$formTitle = 'Escolha uma categoria para exluir:';
			
			$htmlForm = '<label class="title">'. $formTitle .'</label><select id="removeList" class="remove select-master" name="Categorias" id="Categorias">';

			foreach($result as $product){

				$htmlForm .= '<optgroup class="option-group">
						          <option class="option-item" value="'. $product['id'] . '">'. $product['titulo'] .'</option>
						      </optgroup>';
			}

			$htmlForm .= '</select>
						   
						   <a id="removeThis"><i class="fas fa-trash"></i></a>';
			
		}else{
			$formTitle = 'Escolha uma categoria para editar:';
			
			$htmlForm = '<label class="title">'. $formTitle .'</label><select class="edit select-master" name="Categorias" id="Categorias">';

			foreach($result as $product){
				$htmlForm .= '<optgroup class="option-group">
						          <option class="option-item" value="'. $product['id'] . '">'. $product['titulo'] .'</option>
						      </optgroup>';
			}

			$htmlForm .= '</select>
						  <a id="alterButton"><i class="fas fa-edit"></i></a>';
		}

		return $htmlForm;
	}


}