<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css" integrity="sha384-PsH8R72JQ3SOdhVi3uxftmaW6Vc51MKb0q5P2rRUpPvrszuE4W1povHYgTpBfshb" crossorigin="anonymous">
    <link rel="icon" href="http://172.20.224.112/none.ico" type="image/x-icon" />
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/main.css">
    <title>Log in</title>
</head>
<body>
    <div class="box">
        <div class="header">
        <?php
        session_start();
        //Include del nav externo
        include '../views/header.php';
        ?>
        </div>
        <div class="main">
            <div class="container well" id="contenedor">
                <div class="row content center-block">
                    <!-- Contenedor para el login -->
                    <div class="thumbnail caption col-sm-offset-3 col-sm-6 col-md-6" id="thubLogin">
                        <form id="login" method="post" action="login.php">
                            <h2>Login</h2>
                            <div class="form-group">
                                <label for="emailoLog">Email address</label>
                                <input type="email" class="form-control" name="user" id="emailoLog" aria-describedby="emailHelp" placeholder="Enter email">
                                <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
                                <?php
                                    /**
                                    *Recogida variable llamada bd
                                    */
                                    if(isset($_POST['emailLog']))
                                    {

                                    }
                                    ?>
                            </div>
                            <div class="form-group">
                                <label for="passwordLog">Password</label>
                                <input type="password"  name="pass" class="form-control" id="passwordLog" placeholder="Password">
                            </div>
                            <!--
                            <div class="form-check">
                                <label class="form-check-label">
                                    <input type="checkbox" class="form-check-input">
                                    Check me out
                                </label>
                            </div>
                            para recordar usuario
                            -->
                            <button type="submit" class="btn btn-primary">Log In</button>
                            <button type="button"class="btn btn-default" id="sig"><a href="../views/register.php">sign up</a></button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <?php
        if (isset($_POST['user']) && isset($_POST['pass'])) {
            include "../opsbd/usuarioBd.php";
            $usuarioIntroducido = $_POST['user'];
            $passIntroducida = $_POST['pass'];
            if (comprobarUsuario($usuarioIntroducido, $passIntroducida) ==false) {
                ?>
                <div class="alert alert-warning">
                    <strong>Error</strong>, usuario o contraseña incorrectos.
                </div>
                <?php
            } else {
                ?>
                <script>window.location.replace("../index.php");</script>
                <div class="alert alert-success">
                    <strong>Bienvenido, <?php echo $_SESSION['usuario']->nombre; ?></strong>
                </div>
                <?php
            }
        }
        ?>
        <!--Include para el footer externo-->
        <?php include '../views/footer.php';?>
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
    <script src="../js/bootstrap.min.js"></script>
    <script src="../js/js.js"></script>
</body>
</html>