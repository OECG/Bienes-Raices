<?php
    
    if(!isset($_SESSION)){
        session_start();
    }
    $auth = $_SESSION['login'] ?? false;
    
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bienes Raices</title>
    <link rel="preload" href="/build/css/app.css" as= "style">
    <link rel="stylesheet" href="/build/css/app.css">
</head>
<body>

    <header class="header <?php echo $inicio ? 'inicio' : '';?>">
        <div class="contenedor contenido-header">
            <div class="barra">
                <a href="/">
                    <img class="logo-header" src="/build/img/logo.svg" alt="Logotipo de Bienes Raices">
                </a>
                <div class="mobile-menu">
                    <img loading="lazy" width="200" height="300" src="/build/img/barras.svg" alt="barras">
                </div>

                <div class="opciones">
                    <nav class="navegacion">
                        <a href="/nosotros.php">Nosotros</a>
                        <a href="/anuncios.php">Anuncios</a>
                        <a href="/blog.php">Blog</a>
                        <a href="/contacto.php">Contacto</a>
                        <?php if(!$auth): ?>
                            <a href="/login.php">LogIn</a>
                        <?php endif; ?>
                        <?php if($auth): ?>
                            <a href="/admin">Administrar</a>
                            <a href="/cerrar-sesion.php">LogOut</a>
                        <?php endif; ?>
                    </nav>
                    <img class="dark-mode-button" loading="lazy" width="200" height="300" src="/build/img/dark-mode.svg" alt="dark-mode" title="Modo Oscuro">
                </div>
            </div> <!--Barra-->
            <?php echo $inicio ? '<h1>Venta de Casas y Departamentos Exclusivos de Lujo</h1>' : ''; ?>
        </div>
    </header>