<?php
    function validarUsuario($arrayUsers,$user,$pass){
        $arraySize=count($arrayUsers);
        for($x=0;$x<$arraySize;$x++){
            if($arrayUsers[$x]["usuario"]==$user&&$arrayUsers[$x]["contraseña"]==$pass){
                return true;
            }
        }
        return false;
    }
    function comprobar($id,$precio,$array){
        $arraySize=count($array);
        for($x=0;$x<$arraySize;$x++){
            if($array[$x]["id"]==$id){
                $array[$x]["cantidad"]=$array[$x]["cantidad"]+1;
                return $array;
            }
        }
        $array[]["id"]=$id;
        $arraySize=count($array);
        $array[$arraySize-1]["cantidad"]=1;
        $array[$arraySize-1]["precio"]=$precio;
        return $array;
    }
    function imprimirArray($array){
        echo "<aside style='float:left;width:40%;'>";
        $arraySize=count($array);
        ?>
        <fieldset>
            <legend>Carrito:</legend>
            <div class='table'>
                <div class='tr'>
                    <div class='th'>
                        Producto:
                    </div>
                    <div class='th'>
                        ID:
                    </div>
                    <div class='th'>
                        Precio Unidad:
                    </div>
                    <div class='th'>
                        Cantidad:
                    </div>
                    <div class='th'>
                        Precio Total:
                    </div>
                </div>
                <?php
                $total=0;
                for($x=0;$x<$arraySize;$x++){
                    ?>
                    <div class='tr'>
                        <div class='th'>
                            <?php
                                switch ($array[$x]['id']){
                                    case "#001":{
                                        echo "<img src='imgs/zapas.svg' width='100px' height='100px'>";
                                        break;
                                    }
                                    case "#002":{
                                        echo "<img src='imgs/balon.png' width='100px' height='100px'>";
                                        break;
                                    }
                                    case "#003":{
                                        echo "<img src='imgs/raqueta.png' width='100px' height='100px'>";
                                        break;
                                    }
                                    case "#004":{
                                        echo "<img src='imgs/guantes.png' width='100px' height='100px'>";
                                        break;
                                    }
                                    default:{
                                        echo "Producto no encontrado";
                                    }
                                }
                            ?>
                        </div>
                        <div class='td'>
                            <?php echo $array[$x]['id'];?>
                        </div>
                        <div class='td'>
                            <?php echo $array[$x]['precio'];?>&euro;
                        </div>
                        <div class='td'>
                            <?php echo $array[$x]['cantidad'];?>
                        </div>
                        <div class='td'>
                            <?php echo $array[$x]['cantidad']*$array[$x]['precio'];?>&euro;
                        </div>
                    </div>
                    <?php
                    $total+=$array[$x]['cantidad']*$array[$x]['precio'];
                }
                ?>
                <div class='tr'>
                    <div class="td">
                        TOTAL ABSOLUTO:
                    </div>
                    <div class="td">
                        <?php echo $total;?>&euro;
                    </div>
                </div>
            </div>
        </fieldset>
        </aside>
        <?php
    }
function conexionBd(){
    try{
        $conexion=null;
        $bbdd="mysql:host=localhost;dbname=pruebabd;charset=utf8";
        $usuario="root";
        $contraseña="";
        $conexion = new PDO($bbdd,$usuario,$contraseña);
        return $conexion;
    }
    catch (PDOException $e) {
        echo 'Falló la conexión: ' . $e->getMessage();
    }

}

function realizarInsert($dni,$nombre,$direccion,$telefono){
    $conexion=conexionBd();
    $consulta=$conexion->prepare("INSERT INTO cliente(dni,nombre,direccion,telefono) values(:dni,:nombre,:direccion,:telefono)");
    $consulta->execute(array(":dni"=>$dni,":nombre"=>$nombre,":direccion"=>$direccion,":telefono"=>$telefono));
    echo "insert realizado";
    $conexion=null;
}
?>