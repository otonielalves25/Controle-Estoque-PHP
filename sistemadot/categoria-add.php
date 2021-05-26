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
    <div class="row">
        <div class="col-12 offset-2">
            <?php
    // VALIDA CAMPOS 
    if(isset($_GET['btnSalvar'])){

        $nomeCategoria = mysqli_real_escape_string($conexao, $_GET['txtNomeCategoria']);
        
        if($nomeCategoria == ""){
            $_SESSION["msg"] = "Favor preenche uma categoria";
            $_SESSION["sucesso"] = false;

        }else{
        
        $cat = new Categoria();
        $rs = $cat->addNew($nomeCategoria);
        if($rs){
            $_SESSION["msg"] = "Cadastrado com sucesso";
            $_SESSION["sucesso"] = true;
        }else{
            $_SESSION["msg"] = "Erro no cadastro";
            $_SESSION["sucesso"] = false;
        }   
        } 
    }
?>
            <!-- INICIO DO FORMULARIO -->
            <form method="get">

                <div class="row mt-5">
                    <div class="col-5">
                        <h1>Cadastro de Categoria</h1>
                    </div>
                </div>
                <?php

            if(isset($_SESSION["msg"]) && !empty($_SESSION["msg"])){

                if($_SESSION["sucesso"] == true){
                echo '<div class="alert alert-success col-5" role="alert">';
                echo $_SESSION["msg"];                
                echo '</div>';
                } else{
                echo '<div class="alert alert-danger col-5" role="alert">';
                echo $_SESSION["msg"];               
                echo '</div>';
                }
                unset($_SESSION["msg"]);           
             }         
        ?>
                <div class="row">
                    <!-- TEXTO OCULTO -->
              
                    <!-- NOME DA CATEGORIA -->
                    <div class="col-5">
                        <input type="hidden" name="txtCodigo">
                        <label for="txtNomeCategoria">Nome</label>
                        <input type="text" name="txtNomeCategoria" class="form-control" autocomplete="off"
                            maxlength="30">
                    </div>
                </div>
                <!-- BOTÃO GRAVAR -->
                <div class="row mt-3">
                    <div class="col">
                        <button type="submit" name="btnSalvar" class="btn btn-success"><i class="fas fa-save"></i>
                            Salvar</button>
           
                        <a href="categoria-lista.php" class="btn btn-secondary"><i class="fas fa-undo-alt"></i> Listagem
                            de
                            categorias</a>
                    </div>

                </div>

            </form>
        </div>

    </div>
</div>

<!-- RODAPÉ -->
<footer>
    <?php include('includes/rodape.html'); ?>
</footer>