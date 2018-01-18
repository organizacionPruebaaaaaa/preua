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
            <div class="container thumbnail" id="containerTablaAnuncios">
            <?php
                include_once "../opsbd/anuncioBd.php";
                if(isset($_GET['id'])&&isset($_GET['admin'])){
                    if ($_GET['admin']=="delete"){
                        /*Llamada a la funcion delete de anuncioBd*/
                        eliminarAnuncio($_GET['id']);
                    }
                }
                $anunciosUsuario=todosAnunciosDelUsuario($_SESSION['usuario']->idusuario);
                if(count($anunciosUsuario)>0){
                ?>
                <table class="table table-hover">
                    <thead>
                    <tr>
                        <th>Anuncio:</th>
                        <th class="hidden-xs">Categoria:</th>
                        <th class="hidden-xs">Precio:</th>
                        <th>Modificar:</th>
                        <th>Borrar:</th>
                    </tr>
                    </thead>
                <?php
                for($x=0;$x<count($anunciosUsuario);$x++){
                    ?>
                    <tr>
                        <td><?php echo $anunciosUsuario[$x]->nombreproducto ?></td>
                        <td class="hidden-xs"><?php echo $anunciosUsuario[$x]->categoria ?></td>
                        <td class="hidden-xs"><?php echo $anunciosUsuario[$x]->precio ?></td>
                        <td><a href='../views/anuncioEdit.php?id=<?php echo $anunciosUsuario[$x]->idanuncio?>&admin=update'>Modificar anuncio</a></td>
                        <td><a href='../views/adminAnuncios.php?id=<?php echo $anunciosUsuario[$x]->idanuncio?>&admin=delete'>Borrar anuncio</a></td>
                    </tr>
                    <?php
                }
            ?>
                </table>
                    <a class="well" href='../views/anuncioEdit.php?admin=insert'>Nuevo anuncio</a>
                <?php
                }else{
                    echo "<h1>No tienes ningún anuncio</h1>";
                    ?><a class="well" href='../views/anuncioEdit.php?admin=insert'>Nuevo anuncio</a><?php
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