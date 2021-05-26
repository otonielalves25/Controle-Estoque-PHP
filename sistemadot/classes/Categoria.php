<?php

class Categoria{
	// função inseri novo no banco

	public function addNew($c){
        include("conexao/conexao.php");
		$sql = "INSERT into categoria (nomeCategoria) VALUES ('$c')";
		return mysqli_query($conexao, $sql);	
        
	}

	public function alterar($id,$categoria){
        include("conexao/conexao.php");
		$sql = "UPDATE categoria SET nomeCategoria ='$categoria' WHERE idCategoria=$id";
		return mysqli_query($conexao, $sql);	
        
	}


	// RETORNA UMA CATEGORIA
	public function retornaPorId($id){
		include("conexao/conexao.php");
		$sql = "SELECT * FROM categoria WHERE idCategoria='$id' ";

			$result = mysqli_query($conexao, $sql);
			$row = mysqli_fetch_row($result);
			$lista = array(
				'idCategoria' => $row[0],
				'nomeCategoria' => $row[1],		
			);
			return $lista;
	}

	// EXLUSÃO DE CATEGORIA
	public function excluirCategoria($idcategoria){
		include("conexao/conexao.php");
		$sql = "DELETE from categoria where idCategoria = '$idcategoria'";
		return mysqli_query($conexao, $sql);
	}

}