$(document).ready(inicio);
function inicio()
{
    /**
    * funcion para que solo se vea el login al principio
    */
    mostrarLogin();
    cabecera();
    comprobarContraseña();

}
function registro()
{
    //comprobar correo()
    comprobarContraseña();
}
function login()
{
    comprobarCorreoL();
}

function cabecera()
{
    /**
     * funcion para que cuando pinchen en login solo se vea el login
     */
    $("#carga1").click
    (
        mostrarLogin
    );
    /**
     * funcion para que cuando pinchen en sign up solo se vea el formulario de sign up
     */
    $("#carga2").click
    (
        mostrarSingUp
    );
    /**
     * funcion para que cuando pinchen en login solo se vea el login
     */
    $("#log").click
    (
        mostrarLogin
    );
    /**
     * funcion para que cuando pinchen en sign up solo se vea el formulario de sign up
     */
    $("#sig").click
    (
        mostrarSingUp
    );
    registro();
    login();
}

function comprobarCorreoL()
{
    $('#emailoLog').on('focusout',
        function (e)
        {
            e.preventDefault(); //parar el submit para que no se envíe el formulario recargando la página.
            var datos = $(this).serialize();
            var email=$('#emailoLog').text(datos)
            //Envía el formulario vía AJAX. Recoge el resultado en la callback.
            $.ajax
            ({
                type: 'POST',
                url: 'server.php',
                data: email,
                success: function (data)
                {
                    console.log('Llamada OK --> '+email);
                    alert('Llamada OK --> '+email);
                }
            });
        });
}
function comprobarContraseña()
{
    var cont1=$('#passwordReg').val();
    var cont2=$('#passwordReg2').val();

        $('#passwordReg2').on('blur',
           function ()
           {
               if (cont1==cont2)
               {
                   $('#thub2').html('<div class="alert alert-success" role="alert"> <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>\\n\' +\n' +
                       '                \'  <strong>Warning!</strong> Better check yourself, you\\\'re not looking too good.</div>');
               }
               else
               {
                   $('#thub2').html('<div class="alert alert-danger" role="alert"> <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>\n' +
                       '  <strong>Warning!</strong> Better check yourself, you\'re not looking too good.</div>');
               }
           }
        )

}
function mostrarLogin()
{   /**
    *Oculta los divs que no nos interesa mostrar y muestro el que queremos
    */
    $("#thub1").hide();
    $("#thub2").show();

}
function mostrarSingUp()
{   /**
    *Oculta los divs que no nos interesa mostrar y muestro el que queremos
    */
    $("#thub2").hide();
    $("#thub1").show();
}




