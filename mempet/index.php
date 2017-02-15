<?php
    session_start();
    include 'conexion/conexion.php';
    if(isset($_SESSION['usuario'])){
    echo '<script> window.location="principal.php"; </script>';}?>
<!DOCTYPE html>
<html lang="en" class="no-js">

    <head>

        <meta charset="utf-8">
        <title>Login</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="">
        <meta name="author" content="">
        <!-- CSS -->
        <link rel='stylesheet' href='http://fonts.googleapis.com/css?family=PT+Sans:400,700'>
        <link rel="stylesheet" href="assets/css/reset.css">
        <link rel="stylesheet" href="assets/css/supersized.css">
        <link rel="stylesheet" href="assets/css/style.css">

    </head>

    <body>

        <div class="page-container">
            <h1>Login</h1>
            <form action="conexion/validar.php" method="post">
                <input type="text" name="usuario" class="username" placeholder="Usuario" autocomplete="off" required>
                <input type="password" name="password" class="password" placeholder="Password" autocomplete="off" required>
                <button type="submit" name="login" value="Entrar">Ingresar</button>
                <div class="error"><span>+</span></div>
            </form>
        </div>

        <!-- Javascript -->
        <script src="assets/js/jquery-1.8.2.min.js"></script>
        <script src="assets/js/supersized.3.2.7.min.js"></script>
        <script src="assets/js/supersized-init.js"></script>
        <script src="assets/js/scripts.js"></script>
        <script type="text/Javascript" src="assets/js/jquery-3.1.1.min.js"></script>
    </body>

</html>

