<?php

/**
* 
*/
class promocao extends bdConnection
{
	
	function __construct()
	{	
		// Sets this Class/Table name for further use in bdConnection
		$this->setClassName(get_class($this));
		parent::__construct();
	}

	private $id;

	private $tituloPromocao;

	private $precoAntigo;

	private $precoNovo;

	private $descricaoPromocao;

	private $foto;

	private $produtoId;

	private $estiloCSSPromocao;

	public function getId(){
		return $this->id;
	}
	
	public function setId($id){
		$this->id = $id;
	}

	public function getTituloPromocao(){
		return $this->tituloPromocao;
	}
	
	public function setTituloPromocao($tituloPromocao){
		$this->tituloPromocao = $tituloPromocao;
	}

	public function getPrecoAntigo(){
		return $this->precoAntigo;
	}
	
	public function setPrecoAntigo($precoAntigo){
		$this->precoAntigo = $precoAntigo;
	}

	public function getPrecoNovo(){
		return $this->precoNovo;
	}
	
	public function setPrecoNovo($precoNovo){
		$this->precoNovo = $precoNovo;
	}

	public function getDescricaoPromocao(){
		return $this->descricaoPromocao;
	}
	
	public function setSescricaoPromocao($descricaoPromocao){
		$this->descricaoPromocao = $descricaoPromocao;
	}

	public function getFoto(){
		return $this->foto;
	}
	
	public function setFoto($foto){
		$this->foto = $foto;
	}

	public function getEstiloCSSPromocao(){
		return $this->estiloCSSPromocao;
	}
	
	public function setEstiloCSSPromocao($estiloCSSPromocao){
		$this->estiloCSSPromocao = $estiloCSSPromocao;
	}

}