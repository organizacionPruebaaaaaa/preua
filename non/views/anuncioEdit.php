<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <title>Admin anuncio</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css" integrity="sha384-PsH8R72JQ3SOdhVi3uxftmaW6Vc51MKb0q5P2rRUpPvrszuE4W1povHYgTpBfshb" crossorigin="anonymous">
    <link rel="icon" href="http://172.20.224.112/none.ico" type="image/x-icon" />
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/main.css">
</head>
<body>
<div class="box">
    <?php
    session_start();
    if(!isset($_SESSION['usuario'])){
        header("Location: ../views/login.php");
    }
    include '../views/header.php';
    ?>
    <div class="main content">
        <div class="container well">
            <?php
            include_once "../opsbd/anuncioBd.php";
            /*Lo que realiza si le llegan los datos del formulario INSERT*/
            if(isset($_POST['nombreAnuncio'])&&isset($_POST['categoria'])&&isset($_POST['resumen'])&&isset($_POST['descripcion'])&&isset($_POST['precio'])&&isset($_POST['idUsuario'])){
                /*Llamada a el insert de anuncio*/
                nuevoAnuncio($_POST['idUsuario'],$_POST['nombreAnuncio'],$_POST['categoria'],$_POST['resumen'],$_POST['descripcion'],$_POST['precio']);
            }/*Lo que realiza si le llegan los datos del formulario UPDATE*/
            else if (isset($_GET['id'])&&isset($_POST['nombreAnuncioUpdate'])&&isset($_POST['categoriaUpdate'])&&isset($_POST['resumenUpdate'])&&isset($_POST['descripcionUpdate'])&&isset($_POST['precioUpdate'])&&isset($_POST['idUsuario'])){
                $nombreAnuncio = $_POST['nomnombreAnuncioUpdatebreAnuncio'];
                $categoriaAnuncio = $_POST['categoriaUpdate'];
                $resumenAnuncio = $_POST['resumenUpdate'];
                $descripcionAnuncio = $_POST['descripcionUpdate'];
                $precioAnuncio = $_POST['precioUpdate'];
                /*Consulta para quedarme con los datos antiguos*/
                $anuncio=datosDelAnuncio($_GET['id']);
                /*compruebo los datos que han sido modificados*/
                if($nombreAnuncio==""&&$categoriaAnuncio==""&&$resumenAnuncio==""&&$descripcionAnuncio==""&&$precioAnuncio){
                    ?><h3>No se ha modificado ningún dato</h3><?php
                }
                else{
                    if($nombreAnuncio==""){
                        $nombreAnuncio=$anuncio->nombreproducto;
                    }
                    if($categoriaAnuncio==""){
                        $categoriaAnuncio=$anuncio->categoria;
                    }
                    if($resumenAnuncio==""){
                        $resumenAnuncio=$anuncio->resumen;
                    }
                    if($descripcionAnuncio==""){
                        $descripcionAnuncio=$anuncio->descripcion;
                    }
                    if($precioAnuncio==""){
                        $precioAnuncio=$anuncio->precio;
                    }
                    /*Llamada a el update del anuncio*/
                    modificarAnuncio($_GET['id'],$_POST['idUsuario'],$nombreAnuncio,$categoriaAnuncio,$resumenAnuncio,$descripcionAnuncio,$precioAnuncio);
                }
            }/*Lo que realiza si le llegan los datos del Delete foto*/
            else if (isset($_GET['idFoto'])&&isset($_GET['foto'])){
                include "../opsbd/fotografiaBd.php";
                eliminarFotoAnuncio($_GET['idFoto']);
            }
            if(isset($_GET['admin'])){
                if ($_GET['admin']=="insert"){
                    /*formulario para nuevo anuncio*/
                    ?>
                    <form class="formAnuncio" action="anuncioEdit.php" method="post">
                        <div class="form-group">
                            <label for="nombreAnuncio">Nombre del anuncio:</label>
                            <input type="text" class="form-control inputAnuncio nombreAnuncio" name="nombreAnuncio" id="nombreAnuncio" required>
                            <div></div>
                        </div>
                        <div class="form-group">
                            <select name="categoria" required>
                                <option value="">Selecciona una categoria:</option>
                                <option value="ropa">ropa</option>
                                <option value="muebles">muebles</option>
                                <option value="deportes">deportes</option>
                                <option value="vehiculos">vehiculos</option>
                                <option value="videojuegos">videojuegos</option>
                                <option value="figuras">figuras</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="resumen">Resumen de la descripción del anuncio:</label>
                            <input type="text" class="form-control inputAnuncio" name="resumen" id="resumen" required>
                            <div></div>
                        </div>
                        <div class="form-group">
                            <label for="descripcion">Descripción del anuncio:</label>
                            <input type="text" class="form-control inputAnuncio" name="descripcion" id="descripcion" required>
                            <div></div>
                        </div>
                        <div class="form-group">
                            <label for="precio">Precio de venta:</label>
                            <input type="number" class="form-control inputAnuncio precioAnuncio" name="precio" id="precio" required>
                            <div></div>
                        </div>
                        <input type="hidden" name="idUsuario" value="<?php echo $_SESSION['usuario']->idusuario?>">
                        <button type="submit" class="btn btn-default">Enviar</button>
                    </form>
                    <h3>Las fotos/imagenes del anuncio se suben despues de crear el anuncio en la modificación del mismo.</h3>
                    <?php
                }else{
                    if(isset($_GET['id'])){
                        if ($_GET['admin']=="update"){
                            ?>
                            <form class="formAnuncioUpdate" action="anuncioEdit.php" method="post">
                                <div class="form-group">
                                    <label for="nombreAnuncio">Nombre del anuncio:</label>
                                    <input type="text" class="form-control inputAnuncio" name="nombreAnuncioUpdate" id="nombreAnuncio">
                                    <div></div>
                                </div>
                                <div class="form-group">
                                    <select name="categoriaUpdate">
                                        <option value="">Selecciona una categoria:</option>
                                        <option value="ropa">ropa</option>
                                        <option value="muebles">muebles</option>
                                        <option value="deportes">deportes</option>
                                        <option value="vehiculos">vehiculos</option>
                                        <option value="videojuegos">videojuegos</option>
                                        <option value="figuras">figuras</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="resumen">Resumen de la descripción del anuncio:</label>
                                    <input type="text" class="form-control inputAnuncio" name="resumenUpdate" id="resumen">
                                    <div></div>
                                </div>
                                <div class="form-group">
                                    <label for="descripcion">Descripción del anuncio:</label>
                                    <input type="text" class="form-control inputAnuncio" name="descripcionUpdate" id="descripcion">
                                    <div></div>
                                </div>
                                <div class="form-group">
                                    <label for="precio">Precio de venta:</label>
                                    <input type="number" class="form-control inputAnuncio" name="precioUpdate" id="precio">
                                    <div></div>
                                </div>
                                <input type="hidden" name="idUsuario" value="<?php echo $_SESSION['usuario']->idusuario?>">
                                <button type="submit" class="btn btn-default">Enviar</button>
                            </form>
                            <hr>
                            <form action="../opsbd/fotografiaBd.php" method="post" enctype="multipart/form-data">
                                <div class="form-group">
                                    <input type="file" class="form-control" name="rutaFotoNueva" id="fileToUpload">
                                    <input type="hidden" name="idAnuncio" value="<?php echo $_GET['id']?>">
                                </div>
                                <button type="submit" name="enviarFotoNueva" class="btn btn-default">Subir imagenes</button>
                            </form>
                            <hr>
                            <a href='../views/anuncioEdit.php?id=<?php $_GET['id']?>&foto=delete'>Administrar fotos</a>
                        <?php
                        }
                    }else{
                        ?>
                        <script>window.location.replace("../indexJovi.php");</script>
                        <?php
                    }
                }
            }else if(isset($_GET['id'])&&isset($_GET['foto'])){
                if($_GET['foto']=="delete"){

                    $arrayFotos=fotosIdDelAnuncio($_GET['id']);
                    foreach ($arrayFotos as $foto){
                        ?>
                        <div>
                            <img src="<?php echo $foto->urlfoto;?>" width="100px" height="100px" class="thumbnail">
                            <a href='../views/anuncioEdit.php?idFoto=<?php echo $foto->idanuncio?>&foto=delete'>Administrar fotos</a>
                        </div>
                    <?php
                    }
                }
            }
            ?>
        </div>
    </div>
    <!--Include para el footer externo-->
    <?php include '../views/footer.php';?>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
<script src="../js/bootstrap.min.js"></script>
<script src="../js/js.js"></script>
</body>
</html>