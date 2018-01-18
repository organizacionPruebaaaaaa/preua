$(document).ready(inicio);
function inicio()
{
    //validar();
    (function(a){a.createModal=function(b){defaults={title:"",message:"Your Message Goes Here!",closeButton:true,scrollable:false};var b=a.extend({},defaults,b);var c=(b.scrollable===true)?'style="max-height: 420px;overflow-y: auto;"':"";html='<div class="modal fade" id="myModal">';html+='<div class="modal-dialog">';html+='<div class="modal-content">';html+='<div class="modal-header">';html+='<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>';if(b.title.length>0){html+='<h4 class="modal-title">'+b.title+"</h4>"}html+="</div>";html+='<div class="modal-body" '+c+">";html+=b.message;html+="</div>";html+='<div class="modal-footer">';if(b.closeButton===true){html+='<button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>'}html+="</div>";html+="</div>";html+="</div>";html+="</div>";a("body").prepend(html);a("#myModal").modal().on("hidden.bs.modal",function(){a(this).remove()})}})(jQuery);

    eventos();
    registro();
    enviarR();
    enviarU();


}
function registro()
{
    //comprobar correo()

    coorreo();
    comprobarApolo();
    comprobarContraseña();
    comprobarNombre();
    comprobarApel1();
    comprobarApel2();
    comprobarCP();
    comprobarTelefonoF();
    comprobarTelefonoM();
}








/**
 *
 * @returns {undefined}*
 * var erTel=/^[0-9]{9}$/;
 var erZipo=/^[0-9]{5}$/;
 var erDni=/^[0-9]{9}[a-zA-Z]{1}$/;
 var erEmail=/^[a-zA-Z0-9]+.[a-zA-Z0-9]+$/;
 var ercontra=/^[a-zA-Z0-9]{6}/;
 /**
 * Funcion para bloquear el enviar en caso de que no se cumplan los requisitos
 */
function enviarU()
{
    var mansa;
    $('#update').on('submit', function (e) {
        var contraOk=$('#contraOk').val();
        if(contraOk==0)
        {
            //validar lo que se quiera aquí:

            // Esto un popup -->alert('todo está OK! Ahora se enviará el formulario');
            return true; //Tras el "return true" se enviará el formulario, recargándose la página.
            //return false para no continuar y enviar el formulario.
        }
        else
        {
            mansa='Revisa que correo o contraseña coincidan';
            $.createModal({
                title:'Fallos',
                message: mansa,
                closeButton:true,
                scrollable:false
            });
            e.preventDefault();
        }


    });

}

/**
 * Funcion para bloquear el enviar en caso de que no se cumplan los requisitos
 */
function enviarR()
{

    $('#register').on('submit', function (e) {
        var mansa;
        var correoOk=$('#correoOk').val();
        var contraOk=$('#contraOk').val();
        if(correoOk==0 && contraOk==0)
        {
            //validar lo que se quiera aquí:
            // Esto un popup -->alert('todo está OK! Ahora se enviará el formulario');
            return true; //Tras el "return true" se enviará el formulario, recargándose la página.
            //return false para no continuar y enviar el formulario.
        }
        else
        {
            mansa='Revisa que correo o contraseña coincidan';
            $.createModal({
                title:'Fallos',
                message: mansa,
                closeButton:true,
                scrollable:false
            });

            e.preventDefault();
        }


    });

}
/**
 * Funcion para validar el correo
 */
function coorreo()
{
    var correo = $('[name=emailoReg]');
    function coincideEmilio()
    {

        var emailo =correo.val();
        var datos=correo.serialize();
        var resultado;
        var reg = /^[a-zA-Z0-9]+[.][a-zA-Z0-9]+$/;
        if( !emailo.match(reg) )
        {
            $('#feedEmilio').html('<div class="alert alert-danger" role="alert"> <strong>Warning!</strong>Correo no valido.</div>');
            resultado=1;
        }
        else
        {
            /**
             * ajax para hacer la consulta de si el correo esta en uso,
             * justo despues de salir del foco
             */
            $.ajax
            ({
                type: 'POST',
                url: '../opsbd/usuarioBD.php',
                data: datos,
                success: function (data)
                {
                    resultado=data;
                    if(resultado==true)
                    {
                        $('#feedEmilio').html('<div class="alert alert-success" role="alert"><strong>SUCCESS!</strong> Correo libre.</div>');
                        resultado=0;
                        $('#correoOk').val(resultado);
                    }
                    else
                    {
                        $('#feedEmilio').html('<div class="alert alert-danger" role="alert"> <strong>Warning!</strong>Correo en uso.</div>');
                        resultado=1;
                        $('#correoOk').val(resultado);
                    }
                },
                error: function (error)
                {
                    alert("error del servidor");
                    console.log('Llamada Oo--> '+error);
                }
            });
        }
    }
    correo.blur(function () {
            coincideEmilio();
        }
    );
}
/**
 *Funcion para validar el apodo
 */
function comprobarApolo()
{
    var apodo = $('[name=alias]');
    function coincideAple()
    {
        var apolo =apodo.val();
        var reg = /[a-zA-Z0-9]+$/;

        if( !apolo.match(reg) )
        {
            $('#feedAlias').html('<div class="alert alert-danger" role="alert"> <strong>Warning!</strong> TU apodo no sirve.</div>');
        }
        else
        {
            $('#feedAlias').html('<div class="alert alert-success" role="alert"><strong>SUCCES!</strong> Apodo correcto.</div>');
        }
    }

    apodo.blur(function () {
        coincideAple();
    });
}


/**
 *Funcion para comprobar el codigo postal
 */
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
            $('#feedZipo').html('<div class="alert alert-success" role="alert"><strong>SUCCESS!</strong> CP correcto.</div>');
        }
    }
    zip.keyup(function () {
            coincideZipo();
        }
    );
}


/**
 *Funcion para comprobar que el nombre sea todo letras
 */
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
    );
}

/**
 *Funcion para comprobar
 * que el apellido1 sea todo letras
 */
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
            $('#feedApe1').html('<div class="alert alert-success" role="alert"><strong>SUCCESS!</strong> Nombre correcto.</div>');
        }
    }

    ape1.keyup(function () {
            coincideApel1();
        }
    );
}
/**
 *Funcion para comprobar
 * que el apellido2 sea todo letras
 */
function comprobarApel2()
{
    var ape2 = $('[name=ape2]');
    function coincideApel2()
    {
        var apel2=ape2.val();
        var reg = /^[a-zA-Z]+$/;

        if( !apel2.match(reg))
        {
            $('#feedApe2').html('<div class="alert alert-danger" role="alert" > <strong>Warning!</strong>Nombre no valido.</div>');
        }
        else
        {
            $('#feedApe2').html('<div class="alert alert-success" role="alert"><strong>SUCCESS!</strong> Nombre correcto.</div>');
        }
    }

    ape2.keyup(function () {
            coincideApel2();
        }
    );
}
/**
 *Funcion para comprobar que el Telefono fijo sea
 *  todo numeros y de una longitud determinada
 */
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
            $('#feedTel').html('<div class="alert alert-success" role="alert"><strong>SUCCESS!</strong> Telefono correcto.</div>');
        }

    }
    tel1.keyup(function () {
            coincideTelf();
        }
    );
}
/**
 *Funcion para comprobar que el Telefono movil sea
 *  todo numeros y de una longitud especifica
 */
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
            $('#feedMov').html('<div class="alert alert-success" role="alert"><strong>SUCCESS!</strong> Movil correcto.</div>');
        }

    }

    tel2.keyup(function () {
            coincideMov();
        }
    );
}
/**
 *Funcion para comprobar que la contraseña sea de una longitud determinada,
 *  y que coincida con la de repetir
 */
function comprobarContraseña()
{
    var pass1 = $('[name=passwordReg]');
    var pass2 = $('[name=passwordReg2]');
    var contraOk;
    //función que comprueba las dos contraseñas
    function coincidePassword()
    {
        var valor1 = pass1.val();
        var valor2 = pass2.val();
        if(valor1 != valor2 )
        {
            $('#feedContras').html('<div class="alert alert-danger" role="alert"> <strong>Warning!</strong> Las contraseñas no coinciden.</div>');
            contraOk=1;
            $('#contraOk').val(contraOk);
        }
        else if(valor1.length<6 || valor1.length>10)
        {
            $('#feedContras').html('<div class="alert alert-danger" role="alert"><strong>Warning!</strong> Longitud incorrecta, minimo 6, maximo 10.</div>');
            contraOk=1;
            $('#contraOk').val(contraOk);
        }
        else
        {
            if(valor1==valor2)
            {
                $('#feedContras').html('<div class="alert alert-success" role="alert"><strong>SUCCESS!</strong> Las contraseñas coinciden.</div>');
                contraOk=0;
                $('#contraOk').val(contraOk);

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








/********************************************************/
/*************************JOVI***************************/
/*||||||||||||||||||||||||||||||||||||||||||||||||||||||*/
/*VVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVV*/

//$(document).ready(eventos);

function eventos(){
    validarFormAnuncio();
    limpiarWarnings();
    comprobarVaciosBlur();
}


function limpiarWarnings(){
    $(".formAnuncio input").focus(function(){
        $(this).next().removeClass("alert alert-danger");
        $(this).next().html("");
    });
}
function comprobarVaciosBlur(){
    $(".formAnuncio input").focusout(function(){
        if( $(this).val().length ===0 ) {
            $(this).next().addClass("alert alert-danger");
            $(this).next().html("<strong>Campo vacio!</strong> Por favor, rellena todos los campos");
        }
    });
}
function validarFormAnuncio() {
    var nombre = $(".nombreAnuncio").val();
    var precio = $(".precioAnuncio").val();
    $(".formAnuncio").submit(function (e){
        if(comprobarVacios($(".formAnuncio input"))==false ){
            e.preventDefault();
        }else if(comprobarFormato(nombre,precio)==false){
            e.preventDefault();
        }
    });
}

function comprobarVacios(input){
    var validado =true;
    for(var x=0;x<input.length||validado==true;x++){
        if($(input[x]).val().length ===0){
            $(input[x]).next().addClass("alert alert-danger");
            $(input[x]).next().html("<strong>Campo vacio!</strong> Por favor, rellena todos los campos");
            validado=false
        }
    }
    return validado;
}
function comprobarFormato(nombre,precio){
    var nomRegExp = new RegExp("^[a-zA-Z ]{2,30}$");
    var priceRegExp = new RegExp(/^(\d*([.,](?=\d{3}))?\d+)+((?!\2)[.,]\d\d)?$/);
    var validado = true;
    if (!nomRegExp.test(nombre)){
        $(nombre).next().addClass("alert alert-danger");
        $(nombre).next().html("<strong>Formato invalido!</strong> El nombre escrito no puede contener numeros ni caracteres especiales");
        validado = false;
    }
    if (!priceRegExp.test(precio)){
        $(precio).next().addClass("alert alert-danger");
        $(precio).next().html("<strong>Formato invalido!</strong> El precio escrito no puede contener letras, solo puntos y comas aceptados como caracteres");
        validado = false;
    }
    return validado;
}
