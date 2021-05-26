<?php
// VALIDANDO A SESÃO ANTES
if(!isset($_SESSION)){session_start();}
if(!isset($_SESSION['id_usuario'])){header("location: index.php");}?>

<?php include_once("includes/cabecalho.html"); ?>
<?php include_once("includes/menu.html"); ?>
<?php include("conexao/conexao.php") ?>
<?php include("classes/Categoria.php") ?>

<div class="container">

    <div class="row mt-5">
        <div class="col">
            <h3><i class="fas fa-mouse"></i> Lista de Categorias</h3>
        </div>
        <div class="col">
            <?php

            if(isset($_GET['acao']) == "excluir"){
             $categ = new Categoria;
                if($categ->excluirCategoria($_GET['codigo'])){  
                $_SESSION["msg"] = "Excluído com sucesso";
                $_SESSION["sucesso"] == true;
                }else{
                $_SESSION["msg"] = "Erro ao Excluir";
                $_SESSION["sucesso"] == false;}
            }

            if(isset($_SESSION["msg"]) && !empty($_SESSION["msg"])){
                $msg = $_SESSION["msg"];  
            if($_SESSION["sucesso"] == true){                 
                echo "<li class='text-success text-right'>$msg</li>";
               
                }else{
                    echo "<li class='text-danger test-right'>$msg</li>";
                }        
                unset($_SESSION["msg"]);
            }                
                ?>
        </div>

        <div class="col text-right">
            <a href="./menuPrincipal.php" class="btn btn-secondary "><i class="fas fa-home"></i></a>
            <a href="categoria-add.php" class="btn btn-primary"><i class="fas fa-plus-square"></i> Nova Categoria</a>
        </div>
    </div>

    <table class="table table-hover table-sm">
        <thead class="thead-dark">
            <tr>
                <th style="width:150px">Código</th>
                <th>Categoria</th>
                <th style="width:220px" class="text-right pr-3">Opções</th>
            </tr>
        </thead>

        <?php
  
            $sql = "SELECT * FROM categoria ORDER BY nomeCategoria";
            $rs = mysqli_query($conexao, $sql);          

            while($linha = mysqli_fetch_array($rs)){              
    ?>
        <tbody>
            <tr>
                <td><?= $linha['idCategoria']; ?></td>
                <td><?= $linha['nomeCategoria'];?></td>
                <td align=right>
                    <a href="categoria-alter.php?codigo=<?=$linha['idCategoria']; ?>"
                        class="btn btn-primary btn-sm rounded-circle"><i class="fas fa-pencil-alt"></i></a>
                    <a href="?codigo=<?=$linha['idCategoria']; ?>&acao=excluir"
                        class="btn btn-danger btn-sm rounded-circle" onclick='return validarExclusao()'><i
                            class="fas fa-trash-alt"></i></a>
                </td>

            </tr>
        </tbody>

        <?php } ?>

    </table>

</div>


<script>
    function validarExclusao() {
        if (confirm("Deseja realmente excluir."))
            return true;
        else
            return false;
    }
</script>


<!-- RODAPÉ -->
<footer>
    <?php include('includes/rodape.html'); ?>
</footer>