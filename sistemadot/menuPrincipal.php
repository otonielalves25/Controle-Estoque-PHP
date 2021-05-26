<?php
// VALIDANDO A SESÃO ANTES
session_start();
    if(!isset($_SESSION['id_usuario'])){
        header("location: index.php");}
?>

<?php include("includes/cabecalho.html"); ?>
<!-- CABEÇALHO -->
<header id="idMenu"></header>
<?php include('includes/menu.html'); ?>
</header>
<!-- CORPO -->
<div class="papel-fundo">

</div>

<!-- RODAPÉ -->
<footer>
    <?php include('includes/rodape.html'); ?>
</footer>