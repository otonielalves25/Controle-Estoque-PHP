<?php
// VALIDANDO A SESÃO ANTES
if(!isset($_SESSION)){session_start();}
if(!isset($_SESSION['id_usuario'])){header("location: index.php");}?>

<?php include_once("includes/cabecalho.html"); ?>
<?php include_once("includes/menu.html"); ?>
<?php include("conexao/conexao.php") ?>
<?php include("classes/Usuario.php");?>

<div class="container">

    <div class="row mt-5">
        <div class="col">       
            <h2><i class="fas fa-users"></i> Lista de Usuários</h2>
        </div>
        <div class="col">
            <?php
                if(isset($_GET['acao']) == "excluir"){
                
                    if($_SESSION['previlegio'] == "Administrador"){
                        $user = new Usuario;
                        if($user->delete($_GET['codigo'])){
                            $_SESSION["msg"] = "Usuário Excluído com sucesso.";
                            $_SESSION["sucesso"] = true;
                        }else{
                            $_SESSION["msg"] = "Usuário não foi excluido.";
                            $_SESSION["sucesso"] = false;
                        }    

                    }else{
                        $_SESSION["msg"] = "Usuário não tem previlégio.";
                        $_SESSION["sucesso"] = false;
                    }              

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
            <a href="./menuPrincipal.php" class="btn btn-secondary"><i class="fas fa-home"></i></a>
            <a href="usuario-add.php" class="btn btn-primary"><i class="fas fa-plus-square"></i> Novo</a>
        </div>
    </div>

    <table class="table table-hover table-sm">
        <thead class="thead-dark">
            <tr>
                <th style="width:150px">Código</th>
                <th>nome</th>
                <th>Login</th>
                <th>Previlégio</th>
                <th>Empresa</th>
                <th style="width:120px" class="text-right pr-3">Opções</th>
            </tr>
        </thead>

        <?php
  
            $sql = "SELECT * FROM usuario WHERE status='ATIVO' ORDER BY nome";
            $rs = mysqli_query($conexao, $sql);          

            while($linha = mysqli_fetch_array($rs)){              
    ?>
        <tbody>
            <tr>
                <td><?= $linha['idUsuario']; ?></td>
                <td><?= $linha['nome'];?></td>
                <td><?= $linha['login'];?></td>
                <td><?= $linha['previlegio'];?></td>
                <td><?= $linha['empresa'];?></td>
                <td align=right>
                    <a href="usuario-alter.php?codigo=<?=$linha['idUsuario']; ?>&acao=alterar" class="btn btn-primary btn-sm rounded-circle"><i
                            class="fas fa-pencil-alt"></i></a>
                    <a href="?codigo=<?=$linha['idUsuario']; ?>&acao=excluir" class="btn btn-danger btn-sm rounded-circle"
                        onclick='return validarExclusao()'><i class="fas fa-trash-alt"></i></a>
                </td>

            </tr>
        </tbody>
        
        <?php } ?>

    </table>

</div>
<div class="row mb-3">
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