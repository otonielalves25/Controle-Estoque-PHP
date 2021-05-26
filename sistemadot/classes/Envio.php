<?php

class Categoria{
	
	// INSERIR NOVO NO BANCO
	public function adicionar($env,$mot,$dat,$cha,$loc,$log,$idt,$sol,$for,$carg,$obs){
        include("conexao/conexao.php");
		$sql = "INSERT into envio (envioRecebido,motivoEnvio,dataEnvio,chamado,idLocalidade,idLogin,idTecnico,solicitante, 	formaEnvio,carga,Observacao) VALUES ('$env','$mot','$dat','$cha','$loc','$log','$idt','$sol','$for','$carg','$obs')";
		return mysqli_query($conexao, $sql);	
        
	}

	// FUNÇÃO ALTERAÇÃO
	public function alterar($id,$env,$mot,$dat,$cha,$loc,$log,$idt,$sol,$for,$carg,$obs){
        include("conexao/conexao.php");
		$sql = "UPDATE envio SET envioRecebido='$env',motivoEnvio='$mot',dataEnvio='$dat',chamado='$cha',idLocalidade='$loc',idLogin='$log',idTecnico='$idt',solicitante='$sol', formaEnvio='$for',carga='$carg',Observacao='$obs' WHERE idEnvio=$id";
		return mysqli_query($conexao, $sql);	
        
	}

	// EXLUSÃO DE CATEGORIA
	public function excluirCategoria($id){
		include("conexao/conexao.php");
		$sql = "DELETE from envio where idEnvio = '$id'";
		return mysqli_query($conexao, $sql);
	}
	

	// RETORNA UMA CATEGORIA
	// public function retornaPorId($id){
	// 	include("conexao/conexao.php");
	// 	$sql = "SELECT * FROM envio WHERE idEnvio='$id' ";
	// 		$result = mysqli_query($conexao, $sql);
	// 		$row = mysqli_fetch_row($result);
	// 		$lista = array(
	// 			'idCategoria' => $row[0],
	// 			'nomeCategoria' => $row[1],		
	// 		);
	// 		return $lista;
	// }


}