<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="/css/bootstrap.min.css">
    <link rel="stylesheet" href="/css/main.css">
    <title>PEPE</title>
</head>
<body>
<div class="main">
    <!--Include para el header externo-->
    <?php
        session_start();
        include './header.php';
    ?>
    <div class="container">
        CONTENIDO
        <div class="well">
            <div class="row center-block">
                <div class="col-xs-offset-3 col-xs-6">
                    <div class="thumbnail" id="login">
                        <div class="caption text-center">
                            <h3>Login!</h3>
                            <h6>Correo</h6>
                            <p><input type="email" name="usuario"/></p>
                            <h6>Contraseña</h6>
                            <p><input type="password" name="contraseña"/></p>
                            <p><a href="#" class="btn btn-primary" role="button"  onclick="mostrarLogin()">Login</a>
                                <a href="#" class="btn btn-default" role="button"  onclick="mostrarSingUp()">Sing Up</a></p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-xs-offset-3 col-xs-6">
                    <div class="thumbnail" id="registrar">
                        <div class="caption text-center">
                            <h3>Sing Up!</h3>
                            <h6>Correo</h6>
                            <p><input type="email" name="usuario"/></p>
                            <h6>Contraseña</h6>
                            <p><input type="password" name="contraseña"/></p>
                            <h6>Repite Contraseña</h6>
                            <p><input type="password" name="contraseña"/></p>
                            <p><a href="#" class="btn btn-primary" role="button" onclick="mostrarLogin()">Login</a>
                                <a href="#" class="btn btn-default" role="button"  onclick="mostrarSingUp()">Sing Up</a></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>
<!--Esto debe ir en funcionesPhp o algun fichero aparte-->
<?php
//if (isset($_POST['user']) && isset($_POST['pass'])) {
    include "../opsbd/usuarioBd.php";
    $usuarioIntroducido = "dani@gmail.com";//$_POST['user'];
    $passIntroducida = "aaa";//$_POST['pass'];
    if (comprobarUsuario($usuarioIntroducido, $passIntroducida) ==false) {
        echo "Usuario o contraseña incorrectos";
    } else {
        //$usuario=unserialize($_SESSION['usuario']);
        ?>
        <div class="alert alert-success">
            <strong>Bienvenido, <?php echo $_SESSION['usuario']->nombre; ?></strong>
        </div>
        <?php
    }
//}

?>
    <!--Include para el footer externo-->
    <?php include './views/footer.php';?>
<script src="/js/js.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
<script src="/js/bootstrap.min.js"></script>
</body>
</html>