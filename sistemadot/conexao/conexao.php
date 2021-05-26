<?php
// CLASSE CONEXAO
$localhost = "localhost";
$usuario = "root";
$senha = "";
$banco = "bd_unica";

// FAZER A CONEXAO
$conexao = mysqli_connect($localhost,$usuario,$senha,$banco) 
or die("Erro de Conexão com o banco de dados ". mysqli_error($conexao));
mysqli_set_charset($conexao,"utf8");

?>