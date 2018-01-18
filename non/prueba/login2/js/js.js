$(document).ready(inicio);
function inicio()
{
    /**
    * funcion para que solo se vea el login al principio
    */
    mostrarSingUp();
    /**
    * Carga lo necesario en la cabecera
    */
    cabecera();
    /**
    * todo lo que tenga que hacer en registro
    */
    registro();
    /**
    *todo lo que tenga que hacer en login
    */
    login();

}
function registro()
{
    //comprobar correo()
    
    coorreo();
    comprobarContraseña();
    comprobarNombre();
    comprobarApel1();
    comprobarApel2();
    comprobarDNI();
    comprobarCP();
    comprobarTelefonoF();
    comprobarTelefonoM();
}

function login()
{
    //comprobarCorreoL();
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

/**
function comprobarCorreoL()
{
     $('#emailoReg').on('submit', function (e) 
                            {
                                e.preventDefault(); //parar el submit para que no se envíe el formulario recargando la página.
                                var datos = $(this).serialize();
                                //Envía el formulario vía AJAX. Recoge el resultado en la callback.
                                alert(datos);
                                $.ajax(
                                {
                                        type: 'POST',
                                        url: 'index.html',
                                        data: datos,
                                        
                                        success: function (data) 
                                        {
                                            alert(datos);
                                          console.log('Llamada OK --> '+data);
                                          alert('Llamada OK --> '+data);
                                        }
                                });
                            });

			

    
    
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
                url: 'index.html',
                data: email,
                success: function (data)
                {
                    console.log('Llamada OK --> '+email);
                    alert('Llamada OK --> '+email);
                }
            });
        });
    
    


}
*/
function coorreo()
{
    var correo = $('[name=emailoReg]');
    function coincideEmilio()
    {
        //e.preventDefault();
        var emailo =correo.val();
        var datos=correo.serialize();
        var reg = /^[a-zA-Z0-9]+.[a-zA-Z0-9]+$/;
//[a-zA-Z0-9.!#$%&'*+/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*$
        if( !emailo.match(reg) )
        {
            $('#feedEmilio').html('<div class="alert alert-danger" role="alert"> <strong>Warning!</strong>Correo no valido.</div>');

        }
        else
        {
            
            $.ajax
            ({
                type: 'POST',
                url: './opsbd/usuarioBD.php',
                data: datos,
                success: function (data)
                {
                    
                    console.log('Llamada OK --> '+data);
                    alert('Llamaa OK --> '+data);
                }
            });
            $('#feedEmilio').html('<div class="alert alert-success" role="alert"><strong>SUCCES!</strong> Correo correcto.</div>');
        }
            

    }

    correo.blur(function () {

        coincideEmilio();
        }

    )
}
function comprobarDNI()
{
    var dni = $('[name=dni]');
    function coincideDni()
    {
        var dni1 =dni.val();
        var reg = /^[0-9]{9}[a-zA-Z]{1}$/;

        if( !dni1.match(reg) )
        {
            $('#feedDni').html('<div class="alert alert-danger" role="alert"> <strong>Warning!</strong> Dni no valido.</div>');
        }
        else
        {
            $('#feedDni').html('<div class="alert alert-success" role="alert"><strong>SUCCES!</strong> Dni correcto.</div>');
        }

    }

    dni.keyup(function () {
            coincideDni();
        }

    )
}

function comprobarCP()
{
    var zip = $('[name=zipo]');
    function coincideZipo()
    {
        var cp =zip.val();
        var reg = /^[0-9]{5}$/;

        if( !cp.match(reg) )
        {
            $('#feedZipo').html('<div class="alert alert-danger" role="alert"> <strong>Warning!</strong> CP no valido.</div>');
        }
        else
        {
            $('#feedZipo').html('<div class="alert alert-success" role="alert"><strong>SUCCES!</strong> CP correcto.</div>');
        }

    }
    zip.keyup(function () {
            coincideZipo();
        }

    )
}



function comprobarNombre()
{
    var nombre = $('[name=nombre]');
    function coincideNombre()
    {
        var valor=nombre.val();
        var reg = /^[a-zA-Z]+$/;

        if( !valor.match(reg) )
        {
            $('#feedNombre').html('<div class="alert alert-danger" role="alert"> <strong>Warning!</strong>Nombre no valido.</div>');
        }
        else
        {
            $('#feedNombre').html('<div class="alert alert-success" role="alert"><strong>SUCCES!</strong> Nombre correcto.</div>');
        }

    }

    nombre.keyup(function () {
            coincideNombre();
        }

    )
}

function comprobarApel1()
{
    var ape1 = $('[name=ape1]');
    function coincideApel1()
    {
        var apel1=ape1.val();
        var reg = /^[a-zA-Z]+$/;

        if( !apel1.match(reg) )
        {
            $('#feedApe1').html('<div class="alert alert-danger" role="alert"> <strong>Warning!</strong>Nombre no valido.</div>');
        }
        else
        {
            $('#feedApe1').html('<div class="alert alert-success" role="alert"><strong>SUCCES!</strong> Nombre correcto.</div>');
        }

    }

    ape1.keyup(function () {
            coincideApel1();
        }

    )
}

function comprobarApel2()
{
    var ape2 = $('[name=ape2]');
    function coincideApel2()
    {
        var apel2=ape2.val();
        var reg = /^[a-zA-Z]+$/;

        if( !apel2.match(reg) )
        {
            $('#feedApe2').html('<div class="alert alert-danger" role="alert" > <strong>Warning!</strong>Nombre no valido.</div>');
        }
        else
        {
            $('#feedApe2').html('<div class="alert alert-success" role="alert"><strong>SUCCES!</strong> Nombre correcto.</div>');
        }

    }

    ape2.keyup(function () {
            coincideApel2();
        }

    )
}

function comprobarTelefonoF()
{
    var tel1 = $('[name=tel1]');

    function coincideTelf()
    {
        var fijo=tel1.val();

        var reg = /^[0-9]{9}$/;

        if( !fijo.match(reg)  )
        {
            $('#feedTel').html('<div class="alert alert-danger" role="alert"> <strong>Warning!</strong> Telefono no valido.</div>');
        }
        else
        {
            $('#feedTel').html('<div class="alert alert-success" role="alert"><strong>SUCCES!</strong> Telefono correcto.</div>');
        }

    }
    tel1.keyup(function () {
            coincideTelf();
        }

    )

}

function comprobarTelefonoM()
{

    var tel2 = $('[name=tel2]');
    function coincideMov()
    {

        var movil=tel2.val();
        var reg = /^[0-9]{9}$/;

        if( !movil.match(reg)  )
        {
            $('#feedMov').html('<div class="alert alert-danger" role="alert"> <strong>Warning!</strong> Movil no valido.</div>');
        }
        else
        {
            $('#feedMov').html('<div class="alert alert-success" role="alert"><strong>SUCCES!</strong> Movil correcto.</div>');
        }

    }

    tel2.keyup(function () {
            coincideMov();
        }

    )
}

function comprobarContraseña()
{
    var pass1 = $('[name=passwordReg]');
    var pass2 = $('[name=passwordReg2]');
    //oculto por defecto el elemento span
    //función que comprueba las dos contraseñas
    function coincidePassword()
    {
       var valor1 = pass1.val();
       var valor2 = pass2.val();
       //muestro el span

       if(valor1 != valor2 )
       {
           $('#feedContras').html('<div class="alert alert-danger" role="alert"> <strong>Warning!</strong> Las contraseñas no coinciden.</div>');
       }
       else if(valor1.length<6 || valor1.length>10)
       {
           $('#feedContras').html('<div class="alert alert-danger" role="alert"><strong>Warning!</strong> Longitud incorrecta, minimo 6, maximo 10.</div>');
       }
       else
       {
           if(valor1.length!=0 && valor1==valor2)
           {

               $('#feedContras').html('<div class="alert alert-success" role="alert"><strong>SUCCES!</strong> Las contraseñas coinciden.</div>');
           }
       }
    }
    //ejecuto la función al soltar la tecla
    pass1.keyup(function()
    {
        coincidePassword();
    });
    pass2.keyup(function()
    {
        coincidePassword();
    });




}




