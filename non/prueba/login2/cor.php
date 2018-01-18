<?php

$correo=$_POST['email'];
echo $correo;
if(!empty($correo)) {
            comprobar($correo);
      }
       
      function comprobar($algo) {
            $con = mysql_connect('localhost','root', '');
            mysql_select_db('masajes', $con);
       
            $sql = mysql_query("SELECT * FROM usuarios WHERE nombre = '".$b."'",$con);
             
            $contar = mysql_num_rows($sql);
             
            if($contar == 0){
                  echo "<span style='font-weight:bold;color:green;'>Disponible.</span>";
            }else{
                  echo "<span style='font-weight:bold;color:red;'>El nombre de usuario ya existe.</span>";
            }
      }
?>