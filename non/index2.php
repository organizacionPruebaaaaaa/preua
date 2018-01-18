<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/css/bootstrap.min.css">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css" integrity="sha384-PsH8R72JQ3SOdhVi3uxftmaW6Vc51MKb0q5P2rRUpPvrszuE4W1povHYgTpBfshb" crossorigin="anonymous">
        <link rel="stylesheet" href="./css/bootstrap.min.css">
        <link rel="stylesheet" href="./css/bootstrap-social.css">
        <link rel="stylesheet" href="./css/main.css">
        <title>Inicio</title>        
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
        if(!isset($_SESSION['filasMin'])){
            $_SESSION['filasMin']=0;
        }
        include './views/header.php';
        ?>       
        
        <!--Contenedor DIV con clase "main". Internamente tiene otro contenedor DIV con la clase container y demás componentes Bootstrap-->
        <div class="main">
            <div class="container ">
                <div class="row content main-container">    
                    
                    <!--carousel de bootstrap para mostrar los cinco últimos anuncios registrados-->
                    <div class="col-sm-12 hidden-xs bs-example">                        
                        <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
                            <div class="carousel-inner">
                            <?php 
                                
                                include_once 'opsbd/anuncioBd.php';
                                include_once 'opsbd/fotografiaBd.php';
                                    
                                $anunciosCarousel = anunciosParaCarousel();
                                $primeraFotoUltimosAnuncios = [];
                                
                                for($i = 0; $i < count($anunciosCarousel); $i++) {
                                    $primeraFoto = primeraFotoAnuncio($anunciosCarousel[$i]->idanuncio);
                                    array_push($primeraFotoUltimosAnuncios, $primeraFoto);
                                }                                
                                for($n = 0; $n < count($anunciosCarousel); $n++) {
                            ?>
                                <div class="carousel-item  
                                <?php if($n == 0 && $n < count($primeraFotoUltimosAnuncios)) {echo 'active';} ?>">
                                        <a class="linkAnuncios" href="none.com/views/detallesAnuncio.php?idAnuncioSeleccionado=<?php echo $anunciosCarousel[$n]->idanuncio ?>">
                                            <img class="d-block w-100" src="<?php echo $primeraFotoUltimosAnuncios[$n]; ?>" alt="<?php echo $anunciosCarousel[$n]->nombreproducto; ?>" title="<?php echo $anunciosCarousel[$n]->nombreproducto; ?>">
                                        </a>
                                    <div class="carousel-caption d-none d-md-block">
                                        <h2><strong><?php echo $anunciosCarousel[$n]->nombreproducto; //$value->nombreproducto ?></strong></h2>
                                        <h3><strong><?php echo $anunciosCarousel[$n]->precio. " €" ?></strong></h3>
                                    </div>
                                </div>
                                <?php
                                    }                                    
                                ?>
                            </div>
                            <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                <span class="sr-only">Previous</span>
                            </a>
                            <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
                                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                <span class="sr-only">Next</span>
                            </a>
                        </div>
                    </div>
                    
                    <!--separador hr-->
                    <hr id="sepAnuncio" class="col-xs-12">                   
                    
                    <!--parte inferior con los demás últimos anuncios (aqui se ven más)o los anuncios por categoría-->
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
                            
                            /*aqui se muestran las miniaturas de los anuncios*/
                            foreach ($arrayAnuncios as $anuncio){
                                ?>
                                <div class="well col-xs-6 col-sm-4">
                                    <a class="linkAnuncios" href="none.com/views/detallesAnuncio.php?idAnuncioSeleccionado=<?php echo $anuncio->idanuncio ?>">
                                        <?php
                                            $busquedaFotosAnuncio = fotografiasDelAnuncio($anuncio->idanuncio);                                        
                                        ?>
                                        <img src="<?php echo $busquedaFotosAnuncio[0]; ?>" class="thumbnail img-responsive" alt="<?php echo $anuncio->nombreproducto; ?>" title="<?php echo $anuncio->nombreproducto; ?>"/>                               
                                    </a>
                                    <h2><?php echo $anuncio->nombreproducto ?></h2>
                                    <p><?php echo $anuncio->resumen ?></p>
                                </div>
                            <?php
                                }
                            ?>                           
                            
                            <!--paginación-->
                            <ul class="col-xs-12 pagination">
                                <li id="botonAnterior"><a class="btn" id="linkAnterior" href="./index.php?pagina=0">&laquo;Anterior</a></li>
                                <li id="botonSiguiente"><a class="btn" id="linkSiguiente" href="./index.php?pagina=1">Siguiente&raquo;</a></li>
                            </ul>
                            <?php
                            /*ESTO DEBERIA IR EN UN EVENTO JQUERY*/
                            /*Codigo para activar o desactivar */
                            if(isset($_SESSION['filasMin'])){
                                if($_SESSION['filasMin']<6){
                                    ?>
                                    <script>
                                        document.getElementById("linkAnterior").className+=" disabled";
                                    </script>
                                <?php
                                }
                                if(count($arrayAnuncios)<6){
                                ?>
                                    <script>
                                        document.getElementById("linkSiguiente").className+=" disabled";
                                    </script>
                                    <?php
                                }
                            }
                            ?>
                        </div>
                        
                        <!--barra lateral aside-->
                        <aside class="col-sm-4 hidden-xs">
                            <h3>Categorias:</h3>
                            <ul class="pagination" id="pagination2">
                                <?php
                                $arrayCategorias=mostrarCategorias();
                                foreach ($arrayCategorias as $categoria){
                                    ?>
                                    <li><a href="./index.php?categoria=<?php echo $categoria->categoria ?>"><?php echo $categoria->categoria ?></a></li>
                                <?php
                                }
                                ?>
                            </ul>
                            <h3>Siguenos:</h3>
                            <a class="btn btn-lg btn-social-icon btn-facebook" href="https://es-es.facebook.com/" target="_blank">
                                <img src="img/favicon-blue-690x690-facebook.png" class="thumbnail img-responsive" alt="NoneAnuncios Facebook" title="NoneAnuncios Facebook"/>
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
        
        <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.3/umd/popper.min.js" integrity="sha384-vFJXuSJphROIrBnz7yo7oB41mKfc8JzQZiCq4NCceLEaO4IHwicKwpJf9c9IpFgh" crossorigin="anonymous"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/js/bootstrap.min.js" integrity="sha384-alpBpkh1PFOepccYVYDB4do5UnbKysX5WZXm3XxPqe5iKTfUKjNkCk9SaVuEZflJ" crossorigin="anonymous"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
        <script src="js/bootstrap.min.js"></script>
        <script src="js/js.js"></script>
    </body>
</html>

