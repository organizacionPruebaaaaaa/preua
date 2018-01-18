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
    $consulta->execute(array(":filasMin" => $filasMin));

    while($anuncio = $consulta->fetchObject()) {
        //echo 'ultimosAnuncios() nombre--> '. $anuncio->nombreproducto. '<br>';
        array_push($ultimosAnuncios, $anuncio);        
    }
    return $ultimosAnuncios;
    
    //(O EN SESION:):
    //$_SESSION["ultimosAnuncios"] = $ultimosAnuncios;
        
    $conexion = null;
}

//FUNCIÓN PARA MOSTRAR LOS ANUNCIOS DEL SLIDE (CAROUSEL)
function anunciosParaCarousel() {
    $anunciosParaCarousel = [];    
    $conexion = conexionBd();        
    $consulta = $conexion->prepare('
            SELECT nombreproducto, precio
            FROM anuncio
            ORDER BY idanuncio
            DESC LIMIT 5');
    $consulta->execute();
    
    while($anuncioCarousel = $consulta->fetchObject()) {
        echo 'anunciosParaCarousel() precio--> '. $anuncioCarousel->precio. '<br>';
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
    $consulta->execute(array(":categoria" => $categoria,":filasMin"=>$filasMin));
    
    while($anuncioCategoria = $consulta->fetchObject()) {        
        //echo 'anunciosPorCategoria() resumen--> '. $anuncioCategoria->resumen. '<br>';
        array_push($anunciosPorCategoria, $anuncioCategoria);        
    }
    return $anunciosPorCategoria;
    
    //(O EN SESION):
    //$_SESSION["anunciosPorCategoria"] = $anunciosPorCategoria;
        
    $conexion = null;
}

//FUNCIÓN PARA MOSTRAR LOS ANUNCIOS DEL USUARIO LOGUEADO ('N' ULTIS O TODOS)
function anunciosDelUsuario($iduser) {
    $anuncioDelUsuario = [];
    $conexion = conexionBd();
    
    
    //<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
    //DATOS A PASAR:  se pasara como argumento o en sesion
    //$iduser = 1;
    //<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
    
    
    
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

//FUNCIÓN PARA MOSTRAR LOS DETALLES DEL ANUNCIO SELECCIONADO POR EL USUARIO
function datosDelAnuncio($idAnuncio) {
    $conexion = conexionBd();
    
    
    //<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
    //DATOS A PASAR: cambiar estos valores por las variables pasadas a la funcion como parametro o en sesion
    //$idAnuncio = 4;
    //<<<<<<<<<<<<<<<<<<<<<<<<<<<<>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
    
    
    try {        
        $buscaAnuncioSeleccionado = $conexion->prepare('
                SELECT u.alias, a.idanuncio, a.nombreproducto, a.categoria, a.resumen, a.descripcion, a.precio, a.fechaanuncio
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
function nuevoAnuncio() {
    $conexion = conexionBd();
    
    
    
    //<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
    //DATOS A PASAR: cambiar estos valores por las variables pasadas a la funcion o en sesion
    $iduser = 1;
    $nombreproducto = "Equipación Curling";
    $categoria = "deportes";
    $resumen = "casi sin usar";
    $descripcion = "lo vendo porque no lo uso, es una caca de deporte";
    $precio = 80;
    $fechaanuncio = date("Y-m-d");
    //<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
    
    
    
    
    try {
        $insercion = $conexion->prepare('
            INSERT INTO anuncio
            (iduser, nombreproducto, categoria, resumen, descripcion, precio, fechaanuncio)
            VALUES
            (:iduser, :nombreproducto, :categoria, :resumen, :descripcion, :precio, :fechaanuncio)');    
        $insercion->execute(array(
            "iduser" => $iduser,
            "nombreproducto" => $nombreproducto,
            "categoria" => $categoria,
            "resumen" => $resumen,
            "descripcion" => $descripcion,
            "precio" => $precio,
            "fechaanuncio" => $fechaanuncio
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
function eliminarAnuncio() {
    $conexion = conexionBd();
    
    
    //<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
    //DATOS A PASAR: este dato se pasara como sea (como parametro o en sesion)
    $idanuncio = 1;
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
            echo 'El anuncio no existe en la base de datos.';
            return false;
        }
        else {
            //SI EL ANUNCIO EXISTE LO ELIMINAMOS
            $borrado = $conexion->prepare("DELETE FROM anuncio
                                            WHERE idanuncio = :idanuncio");
            $borrado->execute(array(
                "idanuncio" => $idanuncio
            ));        
            echo 'El anuncio ha sido eliminado.';
            return true;
        }   
        $conexion = null;
    }
    catch (Exception $e) {
        echo 'El anuncio no ha podido ser eliminado.<br>'
        . 'Inténtelo de nuevo más tarde.' . $e->getMessage();
        return false;
    }    
}

//FUNCIÓN PARA MODIFICAR UN ANUNCIO
function modificarAnuncio() {
    $conexion = conexionBd();    
    
    
    //<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
    //DATOS A PASAR: estos datos se pasaran como argumento o en sesion
    //EN SESION Y LOS QUE NO SE HAYAN MODIFICADO NO SE CAMBIARAN EN BD
    //(SI NO SE CAMBIA NINGUN CAMPO, DEVUELVE QUE NOS SE HA PODIDO HACER EL UPDATE
    //LOS DATOS PARA EL UPDATE QUE NO CAMBIEN SE DEBEN RECOGER DEL ANUNCIO SELECCIONADO PARA ACTUALIZAR
    //(HAY DATOS QUE NO SE PODRAN CAMBIA COMO idanuncio o iduser. TB fechaanuncio HAY QUE PENSAR SI SE ACTUALIZA AL MODIFICAR O SE DEJA LA DE CUANDO SE HIZO EL INSERT)
    $idanuncio = 3;
    $iduser = 1;
    $nombreproducto = "balon futbol";
    $categoria = "deportes";
    $resumen = "balon de futbol de reglamento";
    $descripcion = null;
    $precio = 9;    
    $fechaAnuncio = date("Y-m-d");
    //<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
    
    
    
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
                fechaanuncio = :fechaanuncio
                WHERE idanuncio = :idanuncio";        
        $hacerModificacion = $conexion->prepare($modificacion);        
        $hacerModificacion->execute(array(
            'idanuncio' => $idanuncio,
            'iduser' => $iduser,            
            'nombreproducto' => $nombreproducto,
            'categoria' => $categoria,
            'resumen' => $resumen,
            'descripcion' => $descripcion,
            'precio' => $precio,
            'fechaanuncio' => $fechaAnuncio          
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
    return $categoriasEnBd;;
    
    //(O EN SESION):
    //$_SESSION["categoriasEnBd"] = $categoriasEnBd;
        
    $conexion = null;
}


