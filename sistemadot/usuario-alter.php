<?php
// VALIDANDO A SESSÃO DO USUARIO
if(!isset($_SESSION)){session_start();}
if(!isset($_SESSION['id_usuario'])){header("location: index.php");}?>

<!-- INCLUDE DA PAGINA -->
<?php include_once("includes/cabecalho.html"); ?>
<?php include_once("includes/menu.html"); ?>
<?php include("conexao/conexao.php") ?>
<?php include("classes/Usuario.php"); 

// VARIAVEIS DA PAGINA
$erros = array();
// CRIAR AS VARIAVEIS PARA NÃO PEDER OS DADOS QUANDO O FORMULARIO FOR DGITADO
$id ="";
$nome = "";
$email = "";
$empresa = "";
$login = "";
$previlegio = "";
$senha = "";
$confirmaSenha = "";

if(isset($_GET['acao']) == "alterar"){

    $usu = new Usuario();
    $id = mysqli_real_escape_string($conexao,$_GET['codigo']);
    // USUARIO JÁ CRIADO ENCIMA APENAS COLOCO OS DADOS
    $usu = $usu->retornaPorId($id);
    $nome =$usu['nome'];
    $email = $usu['email'];
    $empresa = $usu['empresa'];
    $login = $usu['login'];
    $previlegio = $usu['previlegio'];
    $senha = "";
    $confirmaSenha = "";
   

}

// FUNÇÃO SALVAR
if(isset($_POST['btnAlterar'])){    
    
// $usuario->insert($nome, $email, $login, $senha, $previlegio, $empresa, $status);
    $id = mysqli_real_escape_string($conexao,$_POST['idUsuario']);
    $nome = mysqli_real_escape_string($conexao,$_POST['nome']);
    $email = mysqli_real_escape_string($conexao,$_POST['email']);
    $empresa = mysqli_real_escape_string($conexao,$_POST['empresa']);
    $login = mysqli_real_escape_string($conexao,$_POST['login']);
    $previlegio = mysqli_real_escape_string($conexao,$_POST['previlegio']);
    $senha = mysqli_real_escape_string($conexao,$_POST['senha']);
    $confirmaSenha = mysqli_real_escape_string($conexao,$_POST['confirmaSenha']);

    if(empty($nome)) $erros[] = "O nome não foi informado.";
    if(empty($email)) $erros[] = "O Email não foi informado.";
    if(empty($empresa)) $erros[] = "A empresa não foi informada.";
    if(empty($login)) $erros[] = "O Login não foi informado.";
    if(empty($previlegio)) $erros[] = "O previlégio não foi informado.";
    if(empty($senha)) $erros[] = "O Senha não foi informada.";
    if(empty($confirmaSenha)) $erros[] = "Confirmar a Senha.";
    if($senha != $confirmaSenha) $erros[] = "As senha não são iguais."; 

    // GRAVANO NO BANCO
    if(!$erros){
        $usua = new Usuario;
        $senha = md5($senha);
        if($usua->update($id,$nome,$email,$login,$senha,$previlegio,$empresa)){
            echo "<script>
            alert('Usuário Alterado com Sucesso.');
            window.location.assign('usuario-lista.php');                                                       
            </script>";  
            // LIMPAR CAMPOS
            $id = ""; $nome = ""; $email = ""; $empresa = ""; $login = ""; $previlegio = ""; $senha = ""; $confirmaSenha = "";     

        }else{
            $erros[] = "Erro ao Alterar usuário no banco."; 
        }
    }
}
?>

<div class="container mt-5">
    <!-- INICIO DO FORMULARIO -->
    <form action="#" method="POST">
        <!-- MOSTRA MENSAGE DE ERRO  -->
        <?php             
                 if($erros){
                    echo '<div class="row">';
                    echo "<div class=' col alert alert-danger text-center' role='alert'>";
                        foreach ($erros as $erro) {                            
                                echo "<li>$erro</>";                      
                                }  
                    echo"</div>";               
                               
                    echo '</div>';
            }
                        
        ?>
        <!-- FIM DA MENSAGEM DE ERRO -->

        <div class="row form-group">
            <div class="col-3">
            </div>
            <div class="col-6">

                <!--  FIM DA MENSAGEM DE ERRO -->
                <h3>Alteração de Usuários</h3>
                <input type="hidden" name="idUsuario" value="<?=$id;?>">
                <label for="for">Nome:</label>
                <input type="text" name="nome" id="nome" maxlength="150" class="form-control" value="<?=$nome;?>">

                <label for="for">Email:</label>
                <input type="email" name="email" id="email" maxlength="20" class="form-control" value="<?=$email;?>">

                <label for="for">Empresa:</label>
                <select name="empresa" class="form-control">
                    <option value="">Selecione</option>
                    <option value="DETRAN" <?php if($empresa=="DETRAN") echo "selected";?>>Detran</option>
                    <option value="CELEPAR" <?php if($empresa=="CELEPAR") echo "selected";?>>Celepar</option>
                </select>

                <div class="row">
                    <div class="col">
                        <label for="for">Login:</label>
                        <input type="text" name="login" id="login" maxlength="20" class="form-control" value="<?=$login;?>">
                    </div>
                    <div class="col">
                        <label for="">Previlégio:</label>
                        <select name="previlegio" class="form-control">
                            <option value="">Selecione</option>
                            <option value="Administrador" <?php if($previlegio=="Administrador") echo "selected";?>>Administrador</option>
                            <option value="Usuário" <?php if($previlegio=="Usuário") echo "selected";?>>Usuario
                            </option>
                        </select>

                    </div>
                </div>

                <div class="row">
                    <div class="col">
                        <label for="for">Senha:</label>
                        <input type="password" name="senha" id="senha" maxlength="20" class="form-control"value="<?=$senha;?>">
                    </div>
                    <div class="col">
                        <label for="for">Confirmar Senha:</label>
                        <input type="password" name="confirmaSenha" id="confirmaSenha" maxlength="20" value="<?=$confirmaSenha;?>" class="form-control">
                    </div>
                </div>
                <div class="row my-3">
                    <div class="col">
                        <button type="submit" class="btn btn-success w-100" name="btnAlterar"><i class="fas fa-save"></i> Salvar</button>
                    </div>
                    <div class="col text-right">
                        <a href="usuario-lista.php" class="btn btn-secondary"><i class="fas fa-undo-alt"></i> Lista de Usuário</a>
                    </div>
                </div>


            </div>

        </div>
        <!-- FIM DO FORMULARIO -->
    </form>
    <!-- FIM DO CONTINER -->
</div>

<!-- FUNÇÕE EM JAVA STRIPT -->
<script>
function validarExclusao() {
    if (confirm("Deseja realmente excluir."))
        return true;
    else
        return false;
}
</script>
<!-- FIM DO JAVA STRIPT -->

<!-- RODAPÉ -->
<footer>
    <?php include('includes/rodape.html'); ?>
</footer>