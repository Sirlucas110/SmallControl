<?php
    ob_start();
    //session_start();
    include_once 'includes/config.php';
    $pages = 'dashboard';
    $_SESSION['blocked'] = 0;
    
    // Verifica a existencia de login via sessões
    if(!$_SESSION['user_firstname'] || !$_SESSION['user_level'] || !$_SESSION['user_email'] || !$_SESSION['user_token'] || !$_SESSION['user_id'] ||!$_SESSION['logged'] && $_SESSION['user_level'] <= 8 ||  $_SESSION['blocked'] == 1) {
        session_destroy();
        unset($_SESSION['user_firstname']);
        unset($_SESSION['user_level']);
        unset($_SESSION['user_email']);
        unset($_SESSION['user_id']);
        unset($_SESSION['user_token']);
        unset($_SESSION['logged']);
        header('location:../login.php');
    }
?>
<section class="content_left">
    <!-- Chama o menu da página -->
    <?php require 'includes/left.php';?>
</section>

<section class="content_right">
    <!-- Chama o cabeçalho da página -->
    <?php require 'includes/header.php';?>

    <article class="bgcolor-white" role="main">
        <h1 class="visually-hidden">Painel de Controle</h1> <!-- Título principal oculto para acessibilidade -->

        <?php
            $Read = $pdo->prepare("SELECT cliente_id, cliente_status FROM ".DB_CLIENTS." WHERE cliente_status = :cliente_status");
            $Read->bindValue(':cliente_status', 1);
            $Read->execute();

            $Lines = $Read->rowCount();

            if($Lines <10){
                $Count = '000'.$Lines;
            }else if ($Lines >=10 && $Lines <100){
                $Count = '00'.$Lines;
            }else if ($Lines >=100 && $Lines <1000){
                $Count = '0'.$Lines;
            }else{
                $Count = $Lines;
            }
        ?>
        <div class="divisor3 cards bgcolor-blue" role="region" aria-labelledby="clientes-card">
            <h2 id="clientes-card" class="color-white font-text-min text-center">Clientes</h2>
            <p class="color-white text-center font-weight-max title"><?= $Count ?></p>
        </div>

        <?php
            $Read = $pdo->prepare("SELECT fornecedor_id, fornecedor_status FROM ".DB_PROVIDERS." WHERE fornecedor_status = :fornecedor_status");
            $Read->bindValue(':fornecedor_status', 1);
            $Read->execute();
            
            $Lines = $Read->rowCount();

            if($Lines <10){
                $Count = '000'.$Lines;
            }else if ($Lines >=10 && $Lines <100){
                $Count = '00'.$Lines;
            }else if ($Lines >=100 && $Lines <1000){
                $Count = '0'.$Lines;
            }else{
                $Count = $Lines;
            }
        ?>

        <div class="divisor3 cards bgcolor-red" role="region" aria-labelledby="fornecedores-card">
            <h2 id="fornecedores-card" class="color-white font-text-min text-center">Fornecedores</h2>
            <p class="color-white text-center font-weight-max title"><?= $Count ?></p>
        </div>

        <?php
            $Read = $pdo->prepare("SELECT usuarios_id, usuarios_status FROM ".DB_USERS." WHERE usuarios_status = :usuarios_status");
            $Read->bindValue(':usuarios_status', 1);
            $Read->execute();
            
            $Lines = $Read->rowCount();

            if($Lines <10){
                $Count = '000'.$Lines;
            }else if ($Lines >=10 && $Lines <100){
                $Count = '00'.$Lines;
            }else if ($Lines >=100 && $Lines <1000){
                $Count = '0'.$Lines;
            }else{
                $Count = $Lines;
            }
        ?>
        <div class="divisor3 cards bgcolor-green-light" role="region" aria-labelledby="usuarios-card">
            <h2 id="usuarios-card" class="color-white font-text-min text-center">Usuários</h2>
            <p class="color-white text-center font-weight-max title"><?= $Count ?></p>
        </div>
            
        <?php
            $Read = $pdo->prepare("SELECT produto_id, produto_status FROM ".DB_PRODUCT." WHERE produto_status = :produto_status");
            $Read->bindValue(':produto_status', 1);
            $Read->execute();
            
            $Lines = $Read->rowCount();

            if($Lines <10){
                $Count = '000'.$Lines;
            }else if ($Lines >=10 && $Lines <100){
                $Count = '00'.$Lines;
            }else if ($Lines >=100 && $Lines <1000){
                $Count = '0'.$Lines;
            }else{
                $Count = $Lines;
            }
        ?>
        <div class="divisor3 cards bgcolor-orange" role="region" aria-labelledby="produtos-card">
            <h2 id="produtos-card" class="color-white font-text-min text-center">Produtos</h2>
            <p class="color-white text-center font-weight-max title"><?= $Count ?></p>
        </div>
        
        <?php
            $Read = $pdo->prepare("SELECT pedido_id, pedido_status FROM ".DB_ORDERS." WHERE pedido_status = :pedido_status");
            $Read->bindValue(':pedido_status', 1);
            $Read->execute();
            
            $Lines = $Read->rowCount();

            if($Lines <10){
                $Count = '000'.$Lines;
            }else if ($Lines >=10 && $Lines <100){
                $Count = '00'.$Lines;
            }else if ($Lines >=100 && $Lines <1000){
                $Count = '0'.$Lines;
            }else{
                $Count = $Lines;
            }
        ?>
        <div class="divisor3 cards bgcolor-green-dark" role="region" aria-labelledby="pedidos-card">
            <h2 id="pedidos-card" class="color-white font-text-min text-center">Pedidos</h2>
            <p class="color-white text-center font-weight-max title"><?= $Count ?></p>
        </div>
        
        <?php
            $Read = $pdo->prepare("SELECT pedido_id, os_situation, pedido_status FROM ".DB_ORDERS." WHERE pedido_status = :pedido_status AND os_situation = :os_situation");
            $Read->bindValue(':pedido_status', 3);
            $Read->bindValue(':os_situation', 2);
            $Read->execute();
            
            $Lines = $Read->rowCount();

            if($Lines <10){
                $Count = '000'.$Lines;
            }else if ($Lines >=10 && $Lines <100){
                $Count = '00'.$Lines;
            }else if ($Lines >=100 && $Lines <1000){
                $Count = '0'.$Lines;
            }else{
                $Count = $Lines;
            }
        ?>
        <div class="divisor3 cards bgcolor-blue-dark" role="region" aria-labelledby="despachados-card">
            <h2 id="despachados-card" class="color-white font-text-min text-center">Despachados</h2>
            <p class="color-white text-center font-weight-max title"><?= $Count ?></p>
        </div>
        
        <div class="clear"></div>
    </article>
    
    <div class="clear"></div>
    <div class="espaco-min"></div>
</section>
<div class="clear"></div>

<!-- Estilos CSS adicionados para acessibilidade -->
<style>
    .visually-hidden {
        position: absolute;
        width: 1px;
        height: 1px;
        margin: -1px;
        padding: 0;
        overflow: hidden;
        clip: rect(0, 0, 0, 0);
        border: 0;
    }

    .content_left, .content_right {
        display: inline-block;
        vertical-align: top;
        padding: 20px;
    }

    .content_left {
        width: 20%;
        min-width: 200px;
    }

    .content_right {
        width: 75%;
    }

    .cards {
        display: inline-block;
        padding: 20px;
        border-radius: 10px;
        margin: 10px;
        text-align: center;
        width: calc(33.33% - 40px); /* Ajuste para garantir três colunas */
        box-sizing: border-box;
        vertical-align: top;
    }

    .clear {
        clear: both;
    }

    /* Ajustes para foco visível em elementos interativos */
    .cards:focus {
        outline: 3px solid #ffd700;
    }

    /* Melhorias responsivas */
    @media (max-width: 768px) {
        .content_left, .content_right {
            width: 100%;
            display: block;
        }

        .cards {
            width: calc(50% - 40px);
        }
    }

    @media (max-width: 480px) {
        .cards {
            width: 100%;
            margin: 10px 0;
        }
    }
</style>
