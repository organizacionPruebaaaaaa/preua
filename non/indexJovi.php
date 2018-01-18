<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">

    <title>Página con Bootstrap</title>

    <link rel="stylesheet" href="css/bootstrap.min.css">
    <!--Cambiar esta por una local en caso de problemas con la red-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="/css/bootstrap-social.css">
    <link rel="stylesheet" href="/css/main.css">
</head>
<body>
    <div class="box">
        <!--Include para el header externo-->
        <?php
        session_start();
        /*El siguiente codigo te redirige al login
         * if(!isset($_SESSION['usuario'])){
            header("Location: http://none.com/views/login.php");
            die();
        }*/
        if(!isset($_SESSION['filasMin'])) {
            $_SESSION['filasMin'] = 0;
        }
        include './views/header.php';
        ?>

        <!--Contenedor DIV con clase "main". Internamente tiene otro contenedor DIV con la clase container y demás componentes Bootstrap-->
        <div class="main">
            <div class="container">
                <div class="row content main-container">
                    <div class="col-sm-12 hidden-xs bs-example">
                        <div id="myCarousel" class="carousel slide" data-ride="carousel">
                            <!-- Carousel indicators -->
                            <ol class="carousel-indicators">
                                <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
                                <li data-target="#myCarousel" data-slide-to="1"></li>
                                <li data-target="#myCarousel" data-slide-to="2"></li>
                            </ol>
                            <!-- Wrapper for carousel items -->
                            <div class="carousel-inner">
                                <div class="item active">
                                    <img src="img/grumpy-cat.jpg"  class="img-responsive" alt="First Slide">
                                </div>
                                <div class="item">
                                    <img src="img/grumpy-cat.jpg"  class="img-responsive" alt="Second Slide">
                                </div>
                                <div class="item">
                                    <img src="img/grumpy-cat.jpg"  class="img-responsive" alt="Third Slide">
                                </div>
                            </div>
                            <!-- Carousel controls -->
                            <a class="carousel-control left" href="#myCarousel" data-slide="prev">
                                <span class="glyphicon glyphicon-chevron-left"></span>
                            </a>
                            <a class="carousel-control right" href="#myCarousel" data-slide="next">
                                <span class="glyphicon glyphicon-chevron-right"></span>
                            </a>
                        </div>
                    </div>
                    <div class="row subcontenido">
                        <div class="col-sm-8">
                            <?php
                            include_once "./opsbd/anuncioBd.php";
                            if(isset($_GET['pagina'])){
                                if($_GET['pagina']==1){
                                    $_SESSION['filasMin']+=6;
                                }else{
                                    if($_SESSION['filasMin']>=6){
                                        $_SESSION['filasMin']-=6;
                                    }
                                }
                            }
                            if(isset($_GET['categoria'])){
                                $_SESSION['categoria']=$_GET['categoria'];
                            }
                            if(isset($_SESSION['categoria'])){
                                /*Categoria tiene que ser una seasson para que no se destruya al recargar una pagina*/
                                $arrayAnuncios=anunciosPorCategoria($_SESSION['categoria'],$_SESSION['filasMin']);
                            }else{
                                $arrayAnuncios=ultimosAnuncios($_SESSION['filasMin']);
                            }
                            foreach ($arrayAnuncios as $anuncio){
                                ?><div class="well col-xs-6 col-sm-4">
                                    <img src="./img/grumpy-cat.jpg" class="thumbnail img-responsive" alt="imagenAnuncio">
                                    <h2><?php echo $anuncio->nombreproducto ?></h2>
                                    <p><?php echo $anuncio ->resumen ?></p>
                                </div>

                            <?php
                            }
                            ?>
                            <ul class="col-xs-12 pagination">
                                <li id="botonAnterior"><a class="btn" id="linkAnterior" href="./indexJovi.php?pagina=0">&laquo;Anterior</a></li>
                                <li id="botonSiguiente"><a class="btn" id="linkSiguiente" href="./indexJovi.php?pagina=1">Siguiente&raquo;</a></li>
                            </ul>
                            <?php
                            if(isset($_SESSION['filasMin'])){
                                if($_SESSION['filasMin']<6){
                                    ?>
                                    <script>
                                        document.getElementById("botonAnterior").className="disabled";
                                        document.getElementById("linkAnterior").className+=" disabled";
                                    </script>
                                <?php
                                }
                                if(count($arrayAnuncios)<6){
                                ?>
                                    <script>
                                        document.getElementById("botonSiguiente").className="disabled";
                                        document.getElementById("linkSiguiente").className+=" disabled";
                                    </script>
                                    <?php
                                }
                            }
                            ?>
                        </div>
                        <aside class="col-sm-4 hidden-xs">
                            <h3>Categorias:</h3>
                            <ul class="pagination" id="pagination2">
                                <?php
                                $arrayCategorias=mostrarCategorias();
                                foreach ($arrayCategorias as $categoria){
                                    ?>
                                    <li><a href="./indexJovi.php?categoria=<?php echo $categoria->categoria ?>"><?php echo $categoria->categoria ?></a></li>
                                <?php
                                }
                                ?>
                            </ul>
                            <h3>Siguenos:</h3>
                            <a class="btn btn-lg btn-social-icon btn-facebook" href="#">
                                <span class="fa fa-facebook"></span>
                            </a>
                        </aside>
                    </div>

                </div>
            </div>
        </div>

        <!--Include para el footer externo-->
        <?php include './views/footer.php';?>
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
    <script src="/js/bootstrap.min.js"></script>
    <script src="/js/js.js"></script>
</body>
</html>