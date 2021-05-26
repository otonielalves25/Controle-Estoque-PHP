<?php


class Usuario{

	function __construct() {       
    }
	
	// função inseri novo no banco
	// idUsuario	nome	email	login	senha	previlegio	empresa	status 	
	public function insert($nome, $email, $login, $senha, $previlegio, $empresa){
		global $conexao;
		$sql = "INSERT into usuario (nome, email, login, senha, previlegio, empresa, status) 
		VALUES ('$nome', '$email', '$login', '$senha', '$previlegio', '$empresa', 'ATIVO')";
		return mysqli_query($conexao, $sql);	
        
	}
	// FUNÇÃO ALTERAR 
	public function update($id, $nome, $email, $login, $senha, $previlegio, $empresa){		
		//idUsuario	nome	email	login	senha	previlegio	empresa	status 					
		global $conexao;	
		$sql = "UPDATE usuario SET nome = '$nome', email='$email', login='$login', senha='$senha', previlegio='$previlegio', empresa='$empresa' WHERE idUsuario='$id'";
		return mysqli_query($conexao, $sql);	        
	}
	
	// EXLUSÃO DE CATEGORIA
	public function delete($id){
		global $conexao;
		$sql = "UPDATE usuario set status='INATIVO' where idUsuario = '$id'";
		return mysqli_query($conexao, $sql);
	}

	// RETORNA UMA CATEGORIA
	public function retornaPorId($id){
		global $conexao;
		$sql = "SELECT * FROM usuario WHERE idUsuario='$id'";
			
			$rs = mysqli_query($conexao, $sql);
			$coluna = mysqli_fetch_array($rs);
			$usuario = array(
				'idUsuario' => $coluna["idUsuario"],
				'nome' => $coluna['nome'],
				'email' => $coluna['email'],
				'login' => $coluna['login'],
				// 'senha' => $coluna['senha'],		
				'previlegio' => $coluna['previlegio'],		
				'empresa' => $coluna['empresa'],		
				'status' => $coluna['status'],		
			);
			
			return $usuario;
	}

	//RETORNA TUDO
	public function listagemUsuarios(){
		global $conexao;
		$sql = "SELECT * FROM usuario ORDER BY nome";
		$rs = mysqli_query($conexao, $sql);
		$listagem = mysqli_fetch_all($rs);
		
	return $listagem;

	}


}