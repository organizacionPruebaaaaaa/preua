<?php
/**
 * Created by PhpStorm.
 * User: 2gdaw09
 * Date: 09/11/2017
 * Time: 9:35
 *Codigo para el login, revisar algun fallo
**/
if( !isset($_SESSION["intentos"]))
{
    $_SESSION["intentos"] = 0;
}

if ( $_SESSION["intentos"] <= 3 )
{
    if (isset($_POST['emailoLog']) && isset($_POST['passwordLog']))
    {
        $emailo=$_POST['emailoLog'];
        $pass=$_POST['passwordLog'];
        if(isset($usuarios[$emailo]))
        {
            echo 'Correo inexistente';
            if($usuarios[$emailo])
            {
                echo 'Correo correcto ';
                if($usuarios[$emailo] && $usuarios[$emailo]["pass"] == $pass )
                {
                    $_SESSION["intentos"] = 0;
                    echo "Login correcto, bienvenido " , $usuarios[$emailo]["nombre"];


                }
                else
                {
                    $_SESSION["intentos"]++;
                    echo "Contraseña incorrecta, vas: ", $_SESSION["intentos"]," intentos";
                }

            }
            else
            {

                $_SESSION["intentos"]++;
                echo "Email inexistente, vas: ", $_SESSION["intentos"]," intentos";
            }
        }
    }
}
else
{
    $_SESSION["intentos"] = 0;
    session_destroy();
    echo "se acabo";
}
?>