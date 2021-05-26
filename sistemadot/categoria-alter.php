<?php
// VALIDANDO A SESÃO ANTES
if(!isset($_SESSION)){session_start();}
if(!isset($_SESSION['id_usuario'])){header("location: index.php");}?>

<!-- FAZER OS INCLUDES DEPOIS DE VALIDADOS -->
<?php include("conexao/conexao.php") ?>
<?php include_once("includes/cabecalho.html"); ?>
<?php include_once("includes/menu.html"); ?>
<?php include("classes/Categoria.php") ?>

<div class="container">
    <?php
    // PEGAR O CODIGO VINDO PARA ALTERAÇÃO
   if(isset($_GET['codigo'])){
        $id = $_GET['codigo'];
        $categoria = new Categoria();            
        $categoria = $categoria->retornaPorId($id);  
   }

    // VALIDA CAMPOS 
    if(isset($_GET['btnAlterar'])){

        $id = mysqli_real_escape_string($conexao, $_GET['codigo']);    
        $nomeCategoria = mysqli_real_escape_string($conexao, $_GET['txtNomeCategoria']);
        
        if($nomeCategoria == ""){
            $_SESSION["msg"] = "Favor preenche uma categoria";
            $_SESSION["sucesso"] = false;

        }else{
        
        $cat = new Categoria();
        $rs = $cat->alterar($id, $nomeCategoria);
        if($rs){            
            $_SESSION["msg"] = "Alterado com sucesso";
            $_SESSION["sucesso"] = true;
        }else{
            $_SESSION["msg"] = "Erro na Alteração";
            $_SESSION["sucesso"] = false;
        }   
        } 
    }
?>
    <!-- INICIO DO FORMULARIO -->
    <form method="get">

        <div class="row mt-5">
            <div class="col-5">
                <h1>Alteração de Categoria</h1>
            </div>
        </div>
        <?php

            if(isset($_SESSION["msg"]) && !empty($_SESSION["msg"])){
               
                if($_SESSION["sucesso"] == true){    
                header("location: categoria-lista.php");                
                
                } else{
                echo '<div class="alert alert-danger col-5" role="alert">';
                echo $_SESSION["msg"];               
                echo '</div>';
                unset($_SESSION["msg"]);        
                }
                
                }
            
        ?>

        <div class="row">
            <!-- TEXTO OCULTO -->
            <input type="hidden" name="codigo" value="<?php echo $categoria['idCategoria']?>">
            <!-- NOME DA CATEGORIA -->
            <div class="col-5">
                <label for="txtNomeCategoria">Nome</label>
                <input type="text" name="txtNomeCategoria" class="form-control" value="<?php echo $categoria['nomeCategoria']?>">
            </div>
        </div>
        <!-- BOTÃO GRAVAR -->
        <div class="row mt-3">
            <div class="col">
                <button type="submit" name="btnAlterar" class="btn btn-success">Confirmar Alteração</button>
                <a href="categoria-lista.php" class="btn btn-secondary">Listagem de categorias</a>

            </div>

        </div>

    </form>

</div>

<!-- RODAPÉ -->
<footer>
    <?php include('includes/rodape.html'); ?>
</footer>