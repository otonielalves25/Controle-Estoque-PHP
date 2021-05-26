<?php
// VALIDANDO A SESÃO ANTES
if(!isset($_SESSION)){session_start();}
if(!isset($_SESSION['id_usuario'])){header("location: index.php");}?>

<?php include_once("includes/cabecalho.html"); ?>
<?php include_once("includes/menu.html"); ?>
<?php include("conexao/conexao.php") ?>
<?php include("classes/Usuario.php");?>

<div class="container">
    <form action="" method="get">
        <div class="row mt-5">
            <h3>Consulta Equipamentos</h3>
        </div>
        <div class="row">
            <div class="col-3">
                <label for="">Tipo de Pequisa:</label>
                <select name="tipoPesquisa" id="" class="form-control">
                    <option value="patrimonio">Patrimonio</option>
                    <option value="serie">Serie</option>
                </select>
                </div>  
                <div class="col">  
                <input type="text" name="txtPesquisa" id="">
                <input type="button" name="btnPesquisar" id="" value="Buscar">
            </div>
        </div>
    </form>
    <table class="table table-hover table-sm">
        <thead class="thead-dark">
            <tr>
                <th style="width:150px">Patronio</th>
                <th>Serie</th>
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
                    <a href="usuario-alter.php?codigo=<?=$linha['idUsuario']; ?>&acao=alterar"
                        class="btn btn-primary btn-sm rounded-circle"><i class="fas fa-pencil-alt"></i></a>
                    <a href="?codigo=<?=$linha['idUsuario']; ?>&acao=excluir"
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