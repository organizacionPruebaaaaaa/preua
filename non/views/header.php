<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Title</title>
</head>
<body>
    <!--Contenedor DIV con clase "header". Internamente tiene la clase navbar y demás componentes Bootstrap-->
    <div class="header">
        <nav class="navbar navbar-default">
            <div class="container">
                <div class="col-xs-12">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle collapsed visible-xs" data-toggle="collapse" data-target="#myNavbar" aria-expanded="false">
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="http://172.20.224.112/index.php">NoneAnuncios.com</a>
                </div>
                <div class="collapse navbar-collapse" id="myNavbar">
                    <ul class="nav navbar-nav navbar-right mr-auto">
                    <?php
                    if (!isset($_SESSION['usuario'])){
                        ?>
                            <li class="nav-item right"><a href="http://172.20.224.112/views/login.php"><span class="glyphicon glyphicon-log-in"></span> Acceder</a></li>
                        </ul>
                        <ul class="nav navbar-nav navbar-right mr-auto">
                            <li class="nav-item right"><a href="http://172.20.224.112/views/register.php"><span class="glyphicon glyphicon-user"></span> Registrarse</a></li>
                        </ul>
                        <?php
                    }else{
                        $usuario=$_SESSION['usuario'];
                        //Este codigo era para rellenar el badge del header
                        /*include "c:/xampp/htdocs/opsbd/anuncioBd.php";
                        $numAnuncios=contarAnuncios($usuario->idusuario);*/
                        ?>

                            <li class="nav-item  dropdown" id="dropdownPerfil">
                                <a href="#" class="nav-link dropdown-toggle" id="navbarDropdown"  role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <?php echo $usuario->nombre." "; ?><span class="glyphicon glyphicon-user"> </span>
                                </a>
                                <div id="dropdownDivPerfil" class="dropdown-menu" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="http://172.20.224.112/views/perfil.php"><span class="glyphicon glyphicon-cog"></span> Administrar perfil</a>
                                    <a class="dropdown-item" href="http://172.20.224.112/views/adminAnuncios.php"><span class="glyphicon glyphicon-wrench"></span> Administrar anuncios <!--<span class="badge"><?php /*echo $numAnuncios;*/?></span>--></a>
                                    <div class="dropdown-divider"></div>
                                    <a class="dropdown-item" href="http://172.20.224.112/views/logout.php?logout=1"><span class="glyphicon glyphicon-log-out"></span> Logout</a>
                                </div>
                            </li>
                        </ul>
                        <?php
                    }
                    ?>
                    <ul class="nav navbar-nav navbar-left mr-auto">
                        <li id="quienesSomos" class="nav-item"  ><a href="http://172.20.224.112/views/quienesSomos.php">Quienes somos</a></li>
                    </ul>
                </div>
                </div>
            </div>
        </nav>
    </div>
</body>
</html>
