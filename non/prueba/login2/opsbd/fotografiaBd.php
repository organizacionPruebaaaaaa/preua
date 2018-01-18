<?php

include_once 'conexionBd.php';

if(isset($_POST["enviarFotoNueva"])) {
    subirFotoAnuncio();
}



//FUNCIÓN PARA BUSCAR LAS FOTOS DE UN ANUNCIO
function fotografiasDelAnuncio($idDelAnuncio) {
    echo 'id--> '. $idDelAnuncio;
    
    
    //<<<<<<<<<<<<<<<<<<<<<<<<<<<>>>>>>>>>>>>>>>>>>>>>>><
    $fotosDelAnuncio = [];    
    $conexion = conexionBd();        
    $consulta = $conexion->prepare('
            SELECT urlfoto
            FROM fotografia
            WHERE iddelanuncio = :iddelanuncio');    
    $consulta->execute(array(
        'iddelanuncio' => $idDelAnuncio
    ));
    
    while($fotoAnuncio = $consulta->fetchObject()) {        
        echo 'fotografiasDelAnuncio() url--> '. $fotoAnuncio->urlfoto. '<br>';
        array_push($fotosDelAnuncio, $fotoAnuncio->urlfoto); 
        return $fotoAnuncio;
    }
    //return $fotosDelAnuncio;
    
    
    //(O EN SESION):
    //$_SESSION["fotosDelAnuncio"] = $fotosDelAnuncio;
        
    $conexion = null;
}

//FUNCIÓN PARA SUBIR UNA FOTO ASOCIADA A UN ANUNCIO
function subirFotoAnuncio() {
    $conexion = conexionBd();
    
    
    //<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
    //DATOS A PASAR: estos datos hay que pasarlos como argumento o sesion
    $idAnuncio = 9;
    //LA URL DE LA FOTO PODRA LLEGAR UN ARRAY (VARIAS A LA VEZ) O SE SUBEN DE UNA EN UNA??
    //$urlFotoProducto = "abrigo.jpg";
    //<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>> 
    
    
    try {
        //PRIMERO COMPROBAMOS QUE EL ANUNCIO AL QUE IRA LA FOTO EXISTA
        $buscaAnuncio = $conexion->prepare('
                SELECT idanuncio
                FROM anuncio
                WHERE idanuncio = :idanuncio');
        $buscaAnuncio->execute(array(
            'idanuncio' => $idAnuncio
        ));
        if(($anuncioEncontrado = $buscaAnuncio->fetchColumn()) == false) {
            echo 'El anuncio al que quiere subir la fotografía no existe en la base de datos.';
            return false;
        }
        else {
            //CREAMOS VARIABLE PARA GUARDAR LA RUTA A LA CARPETA DE DESTINO DND GUARDAR LA FOTO SUBIDA
            $carpetaDestinoGuardarFoto = "D:/xampp/htdocs/reto2-pruebas-pags-anuncios/img/fotos_anuncios"; //(ESTA RUTA SERA OTRA, CLARO)
            //RECOGEMOS LOS DATOS DEL ARCHIVO SUBIDO EN EL INPUT FILE DEL FORMULARIO
            $nombreArchivoSubido = $_FILES['rutaFotoNueva']['name'];
            $archivoTmp = $_FILES["rutaFotoNueva"]["tmp_name"];
            //BUSCAMOS EL DATETIME DEL MOMENTO ACTUAL PARA AÑADIR A LA URL DE LA FOTO QUE SE VA A GUARDAR EN BD
            $fechaSubida = date("Y-m-d-H-i-s");
            //BUSCAMOS LA POSICIÓN DEL ÚLTIMO PUNTO DE LA RUTA DE LA FOTO A GUARDAR EN BD
            $posicionUltimoPunto = strrpos($nombreArchivoSubido, ".");
            //INSERTAMOS ANTES DEL ÚLTIMO PUNTO DE LA RUTA EL DATETIME ACTUAL
            $nombreFechaArchivoSubir = substr_replace($nombreArchivoSubido, $fechaSubida, $posicionUltimoPunto, 0);
            //COMPLETAMOS CON LA RUTA COMPLETA DE DESTINO PARA LA INSERCIÓN
            $rutaCompletaParaInsercion = $carpetaDestinoGuardarFoto."/".$nombreFechaArchivoSubir;
            
            //CONFIRMAMOS QUE LA RUTA DE LA FOTO SUBIDA SE HA GUARDADO EN LA CARPETA DE DESTINO
            if(move_uploaded_file($archivoTmp, $carpetaDestinoGuardarFoto."/".$nombreFechaArchivoSubir) == false) {
                echo 'El programa no ha podido guardar el archivo en el destino indicado.';
                return false;
            }
            else {
                //echo 'url foto formateada para insertar--> '. $rutaCompletaParaInsercion;
                //HACEMOS LA INSERCIÓN DE LA FOTO CON LA URL FORMATEADA
                $insertarFoto = $conexion->prepare('
                    INSERT INTO fotografia
                    (iddelanuncio, urlfoto)
                    VALUES
                    (:iddelanuncio, :urlfoto)');
                $insertarFoto->execute(array(
                    'iddelanuncio' => $idAnuncio,
                    'urlfoto' => $rutaCompletaParaInsercion
                ));
                }       
            //COMPROBAMOS QUE SE HA HECHO EL INSERT
            if($insertarFoto->rowCount() < 1) {
                echo 'La modificación no se ha podido realizar.<br>
                Inténtelo de nuevo más tarde.';
                return false;
            }
            else {
                echo 'La foto ha sido subida.';
                //echo '<br>La url pasada era asi--> '. $urlFotoProducto. '<br>La url de la foto quedaria asi--> '. $urlFotoFinal;
                return true;
            }           
        }
    }
    catch (Exception $ex) {
        echo 'La fotografía no se ha podido subir.<br>
            Inténtelo de nuevo más tarde.';
        return false;
    }    
    $conexion = null;    
}

//FUNCIÓN PARA ELIMINAR UNA FOTO
function eliminarFotoAnuncio() {
    $conexion = conexionBd();   
    
    
    //<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
    //DATOS A PASAR: este dato se pasara como sea (como parametro o en sesion)
    $idFotografia = 4;
    //<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
    
    
    
    try {
        //PRIMERO BUSCAMOS SI EXISTE LA FOTO EN LA BD
        $buscaFoto = $conexion->prepare('
                SELECT idfoto
                FROM fotografia
                WHERE idfoto = :idfoto');        
        $buscaFoto->execute(array(
            'idfoto' => $idFotografia
        ));
        
        if(($fotoEncontrada = $buscaFoto->fetchColumn()) == false) {
            echo 'La fotografía no existe en la base de datos.';
            return false;
        }
        else {
            //SI EXISTE LA FOTO LA ELIMINAMOS
            $borrado = $conexion->prepare("
                    DELETE FROM fotografia 
                    WHERE idfoto = :idfoto");
            
            $borrado->execute(array(
                "idfoto" => $idFotografia
            ));        
            echo 'La fotografía ha sido eliminada.';
            return true;
        }   
        $conexion = null;
    }
    catch (Exception $e) {
        echo 'La fotografía no ha podido ser eliminada.<br>
            Inténtelo de nuevo más tarde.' . $e->getMessage();
        return false;
    } 
}

