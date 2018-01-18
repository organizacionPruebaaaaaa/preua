<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/css/bootstrap.min.css">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css" integrity="sha384-PsH8R72JQ3SOdhVi3uxftmaW6Vc51MKb0q5P2rRUpPvrszuE4W1povHYgTpBfshb" crossorigin="anonymous">
        <link rel="stylesheet" href="../css/bootstrap.min.css">
        <link rel="stylesheet" href="../css/style.css">
        <link rel="stylesheet" href="../css/bootstrap-social.css">
        <link rel="stylesheet" href="../css/main.css">
        <link rel="icon" href="http://172.20.224.112/none.ico" type="image/x-icon" />
        <title>Anuncio en detalle</title>        
    </head>
    
    <body>
        <?php
            session_start();
            /*if(!isset($_SESSION['usuario'])){
                header("Location: http://none.com/views/login.php");
            }*/
            if(!isset($_SESSION['filasMin'])){
                $_SESSION['filasMin']=0;
            }
            include '../views/header.php';
            
            include_once '../opsbd/fotografiaBd.php';
            include_once '../opsbd/anuncioBd.php';
            include_once '../opsbd/usuarioBd.php';
            
            if(isset($_GET['idAnuncioSeleccionado'])) {
                $idAnuncio = $_GET['idAnuncioSeleccionado'];
                $_SESSION['idAnuncio'] = $idAnuncio;
            }
                       
        ?>        
        
        <div class="main">
            <div class="container ">
                <div class="row content main-container">
                    
                    <!--DIV OCULTO PARA MOSTRAR MINIATURA EN EL TAMAÑO XS-->
                    <div class="col-xs-12 hidden-sm hidden-md hidden-lg">
                        <?php                            
                            $busquedaFotosAnuncio = fotografiasDelAnuncio($_SESSION['idAnuncio']);
                        ?>
                        <a class="linkAnuncios" href="" style="cursor: pointer" name="anuncioSeleccionado" value="<?php  ?>">                                
                            <img src="<?php echo $busquedaFotosAnuncio[0]; ?>" class="thumbnail img-responsive" alt="anuncio"/>                               
                        </a>
                    </div>
                    
                    <!--CAROUSEL-SLIDE PARA LAS IMAGENES DEL ANUNCIO-->
                    <div class="col-sm-9 hidden-xs bs-example">                        
                        <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
                            <div class="carousel-inner">
                            <?php
                                for($n = 0; $n < count($busquedaFotosAnuncio); $n++) {
                            ?>
                                <div class="carousel-item  
                                <?php if($n == 0 && $n < count($busquedaFotosAnuncio)) {echo 'active';} ?>">
                                    <img class="rounded mx-auto d-block w-75 fotosCarousel2" src="<?php echo $busquedaFotosAnuncio[$n]; ?>" alt="Fotografías del producto" title="Fotografías del producto"/>
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
                    
                    <!--DATOS DEL ANUNCIO (SE MUESTRAN AL LADO DEL SLIDE DEL ANUNCIO)-->
                    <div class="col-sm-3 col-xs-offset-3 col-sm-offset-0 col-lg-offset-0" id="dta">
                        <h2>
                            <strong>
                            <?php                                                               
                                $datosAnuncio = datosDelAnuncio($_SESSION['idAnuncio']);
                                echo $datosAnuncio->nombreproducto . '<br>';
                            ?>
                            </strong>                        
                        </h2>
                        <br>
                        <h3>
                        <?php
                            echo 'Vendedor: '
                        ?>
                            <a href="./detallesAnuncio.php?idUsuario=<?php echo $datosAnuncio->iduser ?>" title="Ver otros anuncios del vendedor.">
                                <strong>
                                <?php 
                                    echo $datosAnuncio->alias. '<br>' 
                                ?>
                                </strong>
                            </a>
                            <br>
                            <?php 
                                echo '<br>Precio: '
                            ?>
                            <strong>
                            <?php 
                                echo $datosAnuncio->precio. ' €<br>';                             
                            ?>
                            </strong>
                        </h3>
                    </div>
                </div>
                
                <!--RESTO INFO ANUNCIO (RESUMEN, DESCRIPCION Y BOTONES)-->
                <div class="row">
                    <div class="col-sm-12">
                        <div class="col-sm-2">
                            <h5>
                                <strong>Sobre este producto:</strong>
                            </h5>
                        </div>
                        <div class="col-sm-8">
                            <h3>
                                <strong>
                                <?php 
                                    echo $datosAnuncio->resumen; 
                                ?>
                                </strong>
                            </h3>
                            <h4>
                            <?php 
                                echo $datosAnuncio->descripcion; 
                            ?>
                            </h4>
                        </div>
                        <div class="col-xs-2">
                            <form method="post" action="./detallesAnuncio.php">
                                <button type="submit" class="btn btn-success btn-lg" id="comp" name="comprar">Comprar</button>
                                <br><br>
                                <button type="button" class="btn btn-secondary btn-lg" name="volver"  onclick="location.replace('../index.php')">Volver</button>
                            </form>
                        </div>
                    </div>                    
                </div>
                
                <!--DIV VACIO PARA GESTIONAR LA COMPRA DEL PRODUCTO (AL PULSAR EN BOTON 'COMPRAR')-->
                <div class="col-xs-10 col-xs-offset-2">
                    <?php
                        //si se ha pulsado el botón 'comprar' y el usuario está logueado (en sesión) se elimina el anuncio de bd y se muestran los datos del vendedor
                        if(isset($_POST["comprar"])) {  
                            if(isset($_SESSION['usuario'])) {
                            if(eliminarAnuncio($datosAnuncio->idanuncio)) {
                                ?>                            
                                <script>
                                    document.getElementById("comp").className+=" disabled";
                                </script>
                                <?php
                            }
                            $datosVendedor = mostrarDatosVendedor($datosAnuncio->iduser);
                            ?>
                            <h3>Ha comprado el artículo, los datos del vendedor son:</h3>
                            <ul id="listaDatosVendedor">
                                <h3>
                                <li>Vendedor: <strong><?php echo $datosVendedor->alias ?></strong></li>
                                <li>Nombre: <strong><?php echo $datosVendedor->nombre ?></strong></li>
                                <li>Apellidos: <strong><?php echo $datosVendedor->apellido1. " ". $datosVendedor->apellido2 ?></strong></li>
                                <li>Email: <strong><?php echo $datosVendedor->email ?></strong></li>
                                <li>Telefono principal: <strong><?php echo $datosVendedor->telefono1 ?></strong></li>
                                <li>Teléfono secundario: <strong><?php echo $datosVendedor->telefono2 ?></strong></li>
                                </h3>
                                <br>
                            </ul>
                            <h3>El vendedor ha sido avisado de su compra, <br>en breve se pondrá en contacto con usted</h3><br>                          
                            <button type="button" class="btn btn-secondary btn-lg" name="volverainicio" onclick="location.replace('../index.php')">Volver al Inicio</button>                
                            <?php
                            }
                            //si el usuario no está logueado, le manda a la página 'login.php'
                            else {
                                echo '<script>window.location.replace("./login.php")</script>';
                            }
                        }
                    ?>                           
                </div>
                
                <!--separador hr-->
                <hr id="sepAnuncio" class="col-xs-12">                   
                    
                <!--parte inferior con los anuncios por categoría o los anuncios del usuario-->
                <div class="subcontenido">
                    <div class="col-sm-12">
                        <?php
                        if(isset($_GET['idUsuario'])) {                            
                            $anunciosDe = $_GET['alias'];
                        }
                        else {
                            $anunciosDe = $datosAnuncio->categoria;
                        }
                        ?>
                        <h3>Más anuncios de <?php echo $anunciosDe; ?>:</h3>
                        <?php                             
                            if(isset($_GET['pagina'])){
                                if($_GET['pagina']==1){
                                    $_SESSION['filasMin']+=6;
                                }else{
                                    if($_SESSION['filasMin']>=6){
                                        $_SESSION['filasMin']-=6;
                                    }
                                }
                            }                                                      
                        ?> 
                    </div>
                </div>
                <!--aqui se muestran las miniaturas de los anuncios (de la misma categoria del anuncio seleccionado)-->
                <div class="subcontenido">
                    <div class="col-sm-8">
                    <?php                                                        
                        $anunciosAMostrar = anunciosPorCategoria($datosAnuncio->categoria, $_SESSION['filasMin']);                       
                        if(isset($_GET['idUsuario'])) {
                            $anunciosAMostrar = anunciosDelUsuario($_GET['idUsuario'], $_SESSION['filasMin']);
                        }                      
                        foreach ($anunciosAMostrar as $anuncio) {                            
                    ?>
                        <div class="well col-xs-6 col-sm-10 col-sm-4 anuncioIndex">                               
                            <a class="linkAnuncios" href="./detallesAnuncio.php?idAnuncioSeleccionado=<?php echo $anuncio->idanuncio; ?>" alt="<?php echo $anuncio->nombreproducto; ?>" title="<?php echo $anuncio->nombreproducto; ?>">
                                <?php
                                $busquedaFotosAnuncio = fotografiasDelAnuncio($anuncio->idanuncio);
                                ?>
                                <img src="<?php echo $busquedaFotosAnuncio[0]; ?>" class="thumbnail img-responsive" alt="Anuncio"/>                               
                            </a>
                            <h2><?php echo $anuncio->nombreproducto; ?></h2>
                            <h4>Precio: <strong><?php echo $anuncio->precio; ?> €</strong></h4>
                            <h4>Vendedor: 
                                <a href="./detallesAnuncio.php?idUsuario=<?php echo $anuncio->iduser ?>&alias=<?php echo $anuncio->alias ?>" title="Ver otros anuncios del vendedor.">
                                    <strong>
                                    <?php 
                                        echo $anuncio->alias;
                                    ?>
                                    </strong>
                                </a>
                            </h4>
                        </div>
                        <?php
                            }
                        ?>                        
                        <!--paginación-->
                        <ul class="col-xs-12 pagination">
                            <li id="botonAnterior"><a class="btn" id="linkAnterior" href="./detallesAnuncio.php?pagina=0">&laquo;Anterior</a></li>
                            <li id="botonSiguiente"><a class="btn" id="linkSiguiente" href="./detallesAnuncio.php?pagina=1">Siguiente&raquo;</a></li>
                        </ul>
                        <?php
                            /*Codigo para activar o desactivar */
                            if(isset($_SESSION['filasMin'])){
                                if($_SESSION['filasMin']<6){
                        ?>
                        <script>
                            document.getElementById("linkAnterior").className+=" disabled";
                        </script>
                        <?php
                            }
                            if(count($anunciosAMostrar)<6){
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
                            <li><a href="../index.php?categoria=<?php echo $categoria->categoria ?>"><?php echo $categoria->categoria ?></a></li>
                        <?php
                            }
                        ?>
                        </ul>
                        <h3>Siguenos:</h3>
                        <a class="btn btn-lg btn-social-icon btn-facebook" href="https://es-es.facebook.com/" target="_blank">
                            <img src="../img/favicon-blue-690x690-facebook.png" class="thumbnail img-responsive" alt="NoneAnuncios Facebook" title="NoneAnuncios Facebook"/>
                            <span class="fa fa-facebook"></span>
                        </a>
                    </aside>
                </div>
            </div>
        </div>
        <!--Include para el footer externo-->
        <?php include '../views/footer.php';?>
        <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.3/umd/popper.min.js" integrity="sha384-vFJXuSJphROIrBnz7yo7oB41mKfc8JzQZiCq4NCceLEaO4IHwicKwpJf9c9IpFgh" crossorigin="anonymous"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/js/bootstrap.min.js" integrity="sha384-alpBpkh1PFOepccYVYDB4do5UnbKysX5WZXm3XxPqe5iKTfUKjNkCk9SaVuEZflJ" crossorigin="anonymous"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
        <script src="../js/bootstrap.min.js"></script>
        <script src="../js/js.js"></script>
    </body>
</html>

