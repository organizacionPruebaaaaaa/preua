<?php

include_once 'conexionBd.php';

//FUNCIÓN PARA MOSTRAR LOS 'N' (10) ÚLTIMOS ANUNCIOS REGISTRADOS Y EL 'ALIAS' DEL USUARIO VENDEDOR
function ultimosAnuncios($filasMin) {
    $ultimosAnuncios = [];    
    $conexion = conexionBd();        
    $consulta = $conexion->prepare('
            SELECT u.alias,a.idanuncio,a.iduser, a.nombreproducto, a.categoria,a.resumen,a.descripcion, a.precio,a.fechaanuncio
            FROM usuario u
            JOIN anuncio a
            ON u.idusuario = a.iduser
            ORDER BY a.idanuncio
            DESC LIMIT :filasMin,6');
    $consulta->bindParam(':filasMin', $filasMin, PDO::PARAM_INT);
    $consulta->execute(/*AQUI no se puede meter el parametro del LIMIT, no lo coge PDO*/);

    while($anuncio = $consulta->fetchObject()) {
        //echo 'ultimosAnuncios() nombre--> '. $anuncio->nombreproducto. '<br>';
        array_push($ultimosAnuncios, $anuncio);        
    }
    return $ultimosAnuncios;
    
    //(O EN SESION:):
    //$_SESSION["ultimosAnuncios"] = $ultimosAnuncios;
        
    $conexion = null;
}

//FUNCIÓN PARA MOSTRAR LOS ANUNCIOS DEL SLIDE (CAROUSEL) Y SUS FOTOS (SOLO LA PRIMERA DE CADA UNO SI HAY VARIAS)
function anunciosParaCarousel() {
    $anunciosParaCarousel = [];    
    $conexion = conexionBd();        
    $consulta = $conexion->prepare('
            SELECT u.alias, a.idanuncio, a.nombreproducto, a.precio 
            FROM usuario u
            JOIN anuncio a
            ON u.idusuario = a.iduser
            ORDER BY idanuncio
            DESC LIMIT 5
            ');
    $consulta->execute();
    
    while($anuncioCarousel = $consulta->fetchObject()) {        
        array_push($anunciosParaCarousel, $anuncioCarousel);        
    }
    return $anunciosParaCarousel;
    
    //(O EN SESION):
    //$_SESSION["anunciosParaCarousel"] = $anunciosParaCarousel;
        
    $conexion = null;
}

//FUNCIÓN PARA MOSTRAR LOS 'N' (5) ÚLTIMOS ANUNCIOS SELECCIONADOS POR CATEGORIA
function anunciosPorCategoria($categoria,$filasMin) {
    $anunciosPorCategoria = [];    
    $conexion = conexionBd();
    
    
    //<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
    //DATOS A PASAR: se pasara como argumento o en sesion (SEGUN LA ACTEGORIA QUE SELECCIONEN))
    //$categoria = 'ropa';
    //<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
        
    $consulta = $conexion->prepare('
            SELECT u.alias, a.idanuncio,a.iduser, a.nombreproducto, a.categoria, a.resumen, a.descripcion, a.precio, a.fechaanuncio
            FROM usuario u
            JOIN anuncio a
            ON u.idusuario = a.iduser                
            WHERE a.categoria = :categoria
            ORDER BY a.fechaanuncio DESC LIMIT :filasMin,6');
    $consulta->bindParam(':filasMin', $filasMin, PDO::PARAM_INT);
    $consulta->bindValue(':categoria', $categoria);
    $consulta->execute(/*array(":categoria" => $categoria)*/);
    
    while($anuncioCategoria = $consulta->fetchObject()) {        
        //echo 'anunciosPorCategoria() resumen--> '. $anuncioCategoria->resumen. '<br>';
        array_push($anunciosPorCategoria, $anuncioCategoria);        
    }
    return $anunciosPorCategoria;
    
    //(O EN SESION):
    //$_SESSION["anunciosPorCategoria"] = $anunciosPorCategoria;
        
    $conexion = null;
}

//FUNCIÓN PARA MOSTRAR LOS ANUNCIOS DEL USUARIO
function anunciosDelUsuario($idUser, $filasMin) {
    $anunciosDelUsuario = [];
    $conexion = conexionBd();

    $consulta = $conexion->prepare('
            SELECT u.alias, a.idanuncio, a.nombreproducto, a.categoria, a.resumen, a.descripcion, a.precio, a.fechaanuncio
            FROM usuario u
            JOIN anuncio a
            ON u.idusuario = a.iduser
            WHERE iduser = :iduser
            ORDER BY idanuncio DESC LIMIT :filasMin,6');
    //$consulta->execute(array(":iduser" => $idUser));

    $consulta->bindParam(':filasMin', $filasMin, PDO::PARAM_INT);
    $consulta->bindValue(':iduser', $idUser);
    $consulta->execute(/*array(":iduser" => $iduser)*/);

    while($anuncioUsuario = $consulta->fetchObject()) {
        array_push($anunciosDelUsuario, $anuncioUsuario);
    }
    return $anunciosDelUsuario;

    //(O EN SESION):
    //$_SESSION["anunciosUsuario"] = $anunciosUsuario;

    $conexion = null;
}

//FUNCIÓN PARA MOSTRAR LOS DETALLES DEL ANUNCIO SELECCIONADO POR EL USUARIO
function datosDelAnuncio($idAnuncio) {
    $conexion = conexionBd();
    
    
    //<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
    //DATOS A PASAR: cambiar estos valores por las variables pasadas a la funcion como parametro o en sesion
    //$idAnuncio = 4;
    //<<<<<<<<<<<<<<<<<<<<<<<<<<<<>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
    
    
    try {        
        $buscaAnuncioSeleccionado = $conexion->prepare('
                SELECT u.alias, a.idanuncio, a.iduser, a.nombreproducto, a.categoria, a.resumen, a.descripcion, a.precio, a.fechaanuncio
                FROM usuario u
                JOIN anuncio a
                ON u.idusuario = a.iduser                
                WHERE a.idanuncio = :idanuncio');        
        $buscaAnuncioSeleccionado->execute(array(
            'idanuncio' => $idAnuncio
        ));

        if(($detallesAnuncio = $buscaAnuncioSeleccionado->fetchObject()) == false) {
            echo 'El anuncio indicado no existe en la base de datos.';
        }
        else {
            /*echo 'datosDelAnuncio() alias usuario--> '. $detallesAnuncio->alias. '<br>'
                    . 'datosDelAnuncio() precio--> '. $detallesAnuncio->precio. '<br>';*/
            return $detallesAnuncio;
        }        
    }
    catch (PDOException $e) {
        echo $buscaAnuncioSeleccionado. "<br>" . $e->getMessage();
        return false;
    }
    
    $conexion = null;
}

//FUNCIÓN PARA GENERAR UN NUEVO ANUNCIO
function nuevoAnuncio($iduser,$nombreproducto,$categoria,$resumen,$descripcion,$precio) {
    $conexion = conexionBd();


    try {
        $insercion = $conexion->prepare('
            INSERT INTO anuncio
            (iduser, nombreproducto, categoria, resumen, descripcion, precio, fechaanuncio)
            VALUES
            (:iduser, :nombreproducto, :categoria, :resumen, :descripcion, :precio, SYSDATE())');
        $insercion->execute(array(
            "iduser" => $iduser,
            "nombreproducto" => $nombreproducto,
            "categoria" => $categoria,
            "resumen" => $resumen,
            "descripcion" => $descripcion,
            "precio" => $precio
        ));
        echo 'Su anuncio ha sido publicado.';
        return true;
    }
    catch (Exception $ex) {
        echo 'El anuncio no ha podido ser publicado.';
        return false;
    }
    $conexion = null;
}

//FUNCIÓN PARA ELIMINAR UN ANUNCIO
function eliminarAnuncio($idanuncio) {
    $conexion = conexionBd();


    //<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
    //DATOS A PASAR: este dato se pasara como sea (como parametro o en sesion)
    //$idanuncio = 1;
    //<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>



    try {
        //PRIMERO COMPROBAMOS QUE EXISTE EN LA BD
        $buscaAnuncio = $conexion->prepare('
                SELECT idanuncio
                FROM anuncio
                WHERE idanuncio = :idanuncio');
        $buscaAnuncio->execute(array(
            'idanuncio' => $idanuncio
        ));
        if(($anuncioEncontrado = $buscaAnuncio->fetchColumn()) == false) {
            //echo 'El anuncio no existe en la base de datos.';
            return false;
        }
        else {
            //SI EL ANUNCIO EXISTE LO ELIMINAMOS
            $borrado = $conexion->prepare("DELETE FROM anuncio
                                            WHERE idanuncio = :idanuncio");
            $borrado->execute(array(
                "idanuncio" => $idanuncio
            ));
            //echo 'El anuncio ha sido eliminado.';
            return true;
        }
        $conexion = null;
    }
    catch (Exception $e) {
        /*echo 'El anuncio no ha podido ser eliminado.<br>'
            . 'Inténtelo de nuevo más tarde.' . $e->getMessage();*/
        return false;
    }
}

//FUNCIÓN PARA MODIFICAR UN ANUNCIO
function modificarAnuncio($idanuncio,$iduser,$nombreproducto,$categoria,$resumen,$descripcion,$precio) {
    $conexion = conexionBd();

    try {
        $modificacion = "UPDATE anuncio
                SET
                idanuncio = :idanuncio,
                iduser = :iduser,
                nombreproducto = :nombreproducto,
                categoria = :categoria,
                resumen = :resumen,
                descripcion = :descripcion,
                precio = :precio,
                fechaanuncio = SYSDATE()
                WHERE idanuncio = :idanuncio";
        $hacerModificacion = $conexion->prepare($modificacion);
        $hacerModificacion->execute(array(
            'idanuncio' => $idanuncio,
            'iduser' => $iduser,
            'nombreproducto' => $nombreproducto,
            'categoria' => $categoria,
            'resumen' => $resumen,
            'descripcion' => $descripcion,
            'precio' => $precio
        ));

        if($hacerModificacion->rowCount() < 1) {
            echo 'La modificación no se ha podido realizar.<br>'
                . 'Inténtelo de nuevo más tarde.';
            return false;
        }
        else {
            echo "Anuncio actualizado correctamente.";
            return true;
        }
    }
    catch (PDOException $e) {
        echo $modificacion. "<br>" . $e->getMessage();
        return false;
    }
    $conexion = null;
}

//FUNCIÓN PARA MOSTRAR LAS CATEGORIAS EXISTENTES EN LA BD (para barra lateral)
function mostrarCategorias() {
    $categoriasEnBd = [];    
    $conexion = conexionBd();        
    $consulta = $conexion->prepare('
            SELECT DISTINCT categoria
            FROM anuncio
            ORDER BY categoria');    
    $consulta->execute();
    
    while($categoriaBd = $consulta->fetchObject()) {
        array_push($categoriasEnBd, $categoriaBd);        
    }
    return $categoriasEnBd;
    
    //(O EN SESION):
    //$_SESSION["categoriasEnBd"] = $categoriasEnBd;
        
    $conexion = null;
}


//Funcion para contar los anuncios del usuario
function contarAnuncios($idUser) {
    $numAnunciosBd=0;
    $conexion = conexionBd();
    $consulta = $conexion->prepare('
            SELECT count(idanuncio)
            FROM anuncio
            where iduser = :iduser');
    $consulta->bindParam(':iduser', $idUser, PDO::PARAM_INT);
    $consulta->execute();

    if($consulta->fetchObject()) {
        $numAnunciosBd=$consulta->fetchObject();
        return $numAnunciosBd;
    }
    else{
        $numAnunciosBd=0;
        return $numAnunciosBd;
    }
    $conexion = null;
}
//FUNCIÓN PARA MOSTRAR LOS ANUNCIOS DEL USUARIO LOGUEADO
function todosAnunciosDelUsuario($iduser) {
    $anuncioDelUsuario = [];
    $conexion = conexionBd();

    $consulta = $conexion->prepare('
            SELECT idanuncio, nombreproducto, categoria, resumen, descripcion, precio, fechaanuncio
            FROM anuncio
            WHERE iduser = :iduser
            ORDER BY idanuncio DESC');
    $consulta->execute(array(":iduser" => $iduser));

    while($anuncioUsuario = $consulta->fetchObject()) {
        array_push($anuncioDelUsuario, $anuncioUsuario);
    }
    return $anuncioDelUsuario;

    //(O EN SESION):
    //$_SESSION["anunciosUsuario"] = $anunciosUsuario;

    $conexion = null;
}


