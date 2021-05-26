<?php
// VALIDANDO A SESÃO ANTES
if(!isset($_SESSION)){session_start();}
if(!isset($_SESSION['id_usuario'])){header("location: index.php");}?>

<!-- FAZER OS INCLUDES DEPOIS DE VALIDADOS -->
<?php include("conexao/conexao.php") ?>
<?php include_once("includes/cabecalho.html"); ?>
<?php include_once("includes/menu.html"); ?>
<!-- INCLUDE CLASSE ENVIO -->
<?php include("classes/Envio.php") ?>

<div class="container">
    <?php
    // VALIDA CAMPOS 
    if(isset($_GET['btnSalvar'])){

        $nomeCategoria = mysqli_real_escape_string($conexao, $_GET['']);
        
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
            <div class="col-8">
                <h2>Cadastro de Envio de Equipamento</h2>
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
                unset($_SESSION["msg"]);            }
            
        ?>
        <input type="hidden" name="txtCodigo">
        <div class="row  mt-3">
            <div class="col-3">
                <label for=""><strong>Tipo de Tramite</strong></label><br>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="envio" id="envio" value="enviado">
                    <label class="form-check-label" for="envio">Enviado</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="envio" id="recebido" value="recebido">
                    <label class="form-check-label" for="recebido">Recebido</label>
                </div>
            </div>
            <div class="col-5">
                <label for=""><strong>Destino</strong></label>
                <select name="localidade" id="localidade" class="form-control">
                    <option value="">Destino 1</option>
                    <option value="">Destino 2</option>
                </select>

            </div>
            <div class="col-4">
                <label for=""><strong>Motivo</strong></label>
                <select name="motivo" id="motivo" class="form-control">
                    <option value="">Motivo 1</option>
                    <option value="">Motivo 2</option>
                </select>
            </div>

        </div>

        <div class="row">
            <div class="col-3">
                <label for=""><strong>Chamado</strong></label>
                <input type="text" name="chamado" id="" class="form-control">
            </div>

            <div class="col-5">
                <label for=""><strong>Solicitante</strong></label>
                <input type="text" name="solicitante" id="" class="form-control">
            </div>
            <div class="col-4">
                <label for=""><strong>Técnico Solicitante</strong></label>
                <select name="tecSolicitante" id="tecSolicitante" class="form-control">
                    <option value="">Nenhum</option>
                    <option value="">Tadachi</option>
                    <option value="">Martiningue</option>
                </select>
            </div>
        </div>
        <div class="row">
            <div class="col-3">
                <label for=""><strong>Estado do Bem</strong></label>
                <select name="estadoDoBem" id="estadoDoBem" class="form-control">
                    <option value="">seleciona</option>
                    <option value="">Bom Estado</option>
                    <option value="">Defeito</option>
                </select>
            </div>
            <div class="col-5">
                <label for=""><strong>Forma de Envio</strong></label><br>
                <div class="row">
                    <div class="col-4">
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="envio" id="envio" value="enviado">
                            <label class="form-check-label" for="envio">Em Mãos</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="envio" id="recebido" value="recebido">
                            <label class="form-check-label" for="recebido">Sedex</label>
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="envio" id="envio" value="enviado">
                            <label class="form-check-label" for="envio">Em Mãos</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="envio" id="recebido" value="recebido">
                            <label class="form-check-label" for="recebido">Sedex</label>
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="envio" id="envio" value="enviado">
                            <label class="form-check-label" for="envio">Em Mãos</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="envio" id="recebido" value="recebido">
                            <label class="form-check-label" for="recebido">Sedex</label>
                        </div>
                    </div>

                </div>
            </div>
        </div>

        <!-- BOTÃO GRAVAR -->
        <div class="row mt-3">
            <div class="col">
                <button type="submit" name="btnSalvar" class="btn btn-success"><i class="fas fa-save"></i>
                    Salvar</button>
                <a href="categoria-lista.php" class="btn btn-secondary"><i class="fas fa-undo-alt"></i> Listagem de
                    Enviado</a>

            </div>

        </div>

    </form>

</div>

<!-- RODAPÉ -->
<footer>
    <?php include('includes/rodape.html'); ?>
</footer>