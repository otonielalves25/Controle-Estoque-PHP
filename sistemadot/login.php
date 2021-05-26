<?php if(!isset($_SESSION)){ session_start();} ?>
<!-- // VERIFICA SE TEM SESSÃO E CRIA   -->
<?php  include_once("conexao/conexao.php");?>


<?php include("includes/cabecalho.html"); ?>
<!-- CABEÇALHO -->

<div class="container">
    <?php
$erros = array();


if(isset($_REQUEST['btnLogar'])){

    $login = mysqli_real_escape_string($conexao,$_REQUEST['login']);
    $senha = mysqli_real_escape_string($conexao,$_REQUEST['senha']);

    if($login == ""){
        $erros[0] = "Por favor informe o Login.";
    }
    elseif($senha ==""){
        $erros[1] = "Por favor informe a senha.";
    }

    $senha = md5($senha);
    $sql = "SELECT * FROM usuario where login='$login' and senha='$senha'";
    $rs = mysqli_query($conexao,$sql); 

    if(mysqli_num_rows($rs)>0){
        $coluna = mysqli_fetch_array($rs);
        $_SESSION["id_usuario"] = $coluna["idUsuario"];
        $_SESSION["nome"] = $coluna["nome"];
        $_SESSION["previlegio"] = $coluna["previlegio"];
        header("location: menuPrincipal.php");
    }
    else{
        $erros[2] = "Usuário não cadastrado no banco.";
    }

}
?>
    <h3 class="mt-5 text-center">Sistema de Controle - DOT</h3>

    <p class=" text-center">
        <?php
    if($erros){
        foreach($erros as $erro){
        echo "<li class='text-center text-danger'>$erro</li>";
        }
    }
?></p>

    <div class="div-login">

        <form action="#" method="post">
            <h1 class="text-center">Login</h1>
            <label for="usuario"></label>
            <input type="text" name="login" id="" class="form-control" autocomplete="off" maxlength="20">
            <label for="senha"></label>
            <input type="password" name="senha" id="" class="form-control" maxlength="20"></br>
            <button type="submit" name="btnLogar" class="form-control btn btn-primary">Entrar</button>

        </form>

    </div>

</div>