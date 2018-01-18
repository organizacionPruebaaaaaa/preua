<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/main.css">
    <link rel="icon" href="http://172.20.224.112/none.ico" type="image/x-icon" />
    <title>Perfil</title>
</head>
<body>
<div class="box">
    <?php
    session_start();
    //Include del nav externo
    include '../views/header.php';

    ?>


    <div class="box">


        <div class=”main”>
            <div class=”container” id="contenedor">
                <div class="well">
                    <div class="row center-block">
                        <!-- contenedor para el update -->
                        <div class="thumbnail" id="thub1">
                            <div class="caption">
                                <form id="update" method="post" action="../opsbd/usuarioBd.php">
                                    <h2>Modifica tus datos</h2>
                                    <div class="form-row col-sm-12 col-md-12 col-lg-12">
                                        <div class="form-group col-md-8">
                                            <label for="alias">Alias</label>
                                            <input type="text" class="form-control is-valid" id="alias" name="alias" required>
                                            <div class="invalid-feedback"  id="feedAlias">

                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-row col-sm-12 col-md-12 col-lg-12">
                                        <div class="form-group col-md-5 col-lg-5">
                                            <label for="passwordReg">Contraseña</label>
                                            <input type="password" class="form-control is-valid" id="passwordReg" name="passwordReg" placeholder="Password" autofocus ="autofocus" required>
                                            <input type="hidden" id="contraOk" name="contraOk">
                                            <div class="invalid-feedback">

                                            </div>
                                        </div>
                                        <div class="form-group col-md-5 col-lg-5">
                                            <label for="passwordReg2">Repite Contraseña</label>
                                            <input type="password" class="form-control is-valid" id="passwordReg2" name="passwordReg2" placeholder="Password" required>
                                            <div class="invalid-feedback"  id="feedContras">

                                            </div>
                                        </div>
                                    </div>



                                    <div class="form-row col-sm-12 col-md-12 col-lg-12">

                                        <div class="form-group col-lg-6">
                                            <label for="nombre">Nombre</label>
                                            <input type="text" class="form-control is-valid" class="textu" id="nombre" name="nombre" pattern="^[a-zA-Z]+$" required>
                                            <div class="invalid-feedback" class="feedtext" id="feedNombre">

                                            </div>
                                        </div>

                                        <div class="form-group col-lg-6">
                                            <label for="ape1">Apellido 1</label>
                                            <input type="text" class="form-control is-valid" class="textu" id="ape1" name="ape1" pattern="^[a-zA-Z]+$" required>
                                            <div class="invalid-feedback"  id="feedApe1">

                                            </div>
                                        </div>

                                        <div class="form-group col-lg-6">
                                            <label for="ape2">Apellido 2</label>
                                            <input type="text" class="form-control is-valid" class="textu" id="ape2" name="ape2" pattern="^[a-zA-Z]+$" required>
                                            <div class="invalid-feedback" id="feedApe2">

                                            </div>
                                        </div>

                                        <div class="form-group col-lg-6">
                                            <label for="direccion">Direccion</label>
                                            <input type="text" class="form-control is-valid" class="textu" id="direccion" name="direccion" placeholder="calle la piruleta/1234" required>
                                            <div class="invalid-feedback" id="direccion">

                                            </div>
                                        </div>

                                        <div class="form-group col-lg-6">
                                            <label for="ciudad">Ciudad</label>
                                            <input type="text" class="form-control is-valid" class="textu" id="ciudad" name="ciudad" required>
                                            <div class="invalid-feedback" id="ciudad">

                                            </div>
                                        </div>

                                        <div class="form-group col-lg-6" >
                                            <label for="provincia">Provincia</label>
                                            <select id="provincia" class="form-control" name="provincia" required>
                                                <option value="" selected>Selecciona...</option>
                                                <option value='alava'>Álava</option>
                                                <option value='albacete'>Albacete</option>
                                                <option value='alicante'>Alicante/Alacant</option>
                                                <option value='almeria'>Almería</option>
                                                <option value='asturias'>Asturias</option>
                                                <option value='avila'>Ávila</option>
                                                <option value='badajoz'>Badajoz</option>
                                                <option value='barcelona'>Barcelona</option>
                                                <option value='burgos'>Burgos</option>
                                                <option value='caceres'>Cáceres</option>
                                                <option value='cadiz'>Cádiz</option>
                                                <option value='cantabria'>Cantabria</option>
                                                <option value='castellon'>Castellón/Castelló</option>
                                                <option value='ceuta'>Ceuta</option>
                                                <option value='ciudadreal'>Ciudad Real</option>
                                                <option value='cordoba'>Córdoba</option>
                                                <option value='cuenca'>Cuenca</option>
                                                <option value='girona'>Girona</option>
                                                <option value='laspalmas'>Las Palmas</option>
                                                <option value='granada'>Granada</option>
                                                <option value='guadalajara'>Guadalajara</option>
                                                <option value='guipuzcoa'>Guipúzcoa</option>
                                                <option value='huelva'>Huelva</option>
                                                <option value='huesca'>Huesca</option>
                                                <option value='illesbalears'>Illes Balears</option>
                                                <option value='jaen'>Jaén</option>
                                                <option value='acoruña'>A Coruña</option>
                                                <option value='larioja'>La Rioja</option>
                                                <option value='leon'>León</option>
                                                <option value='lleida'>Lleida</option>
                                                <option value='lugo'>Lugo</option>
                                                <option value='madrid'>Madrid</option>
                                                <option value='malaga'>Málaga</option>
                                                <option value='melilla'>Melilla</option>
                                                <option value='murcia'>Murcia</option>
                                                <option value='navarra'>Navarra</option>
                                                <option value='ourense'>Ourense</option>
                                                <option value='palencia'>Palencia</option>
                                                <option value='pontevedra'>Pontevedra</option>
                                                <option value='salamanca'>Salamanca</option>
                                                <option value='segovia'>Segovia</option>
                                                <option value='sevilla'>Sevilla</option>
                                                <option value='soria'>Soria</option>
                                                <option value='tarragona'>Tarragona</option>
                                                <option value='santacruztenerife'>Santa Cruz de Tenerife</option>
                                                <option value='teruel'>Teruel</option>
                                                <option value='toledo'>Toledo</option>
                                                <option value='valencia'>Valencia/Valéncia</option>
                                                <option value='valladolid'>Valladolid</option>
                                                <option value='vizcaya'>Vizcaya</option>
                                                <option value='zamora'>Zamora</option>
                                                <option value='zaragoza'>Zaragoza</option>
                                            </select>
                                            <div class="invalid-feedback"  id="feedProvincia">

                                            </div>
                                        </div>

                                        <div class="form-group col-lg-6">
                                            <label for="tel1">Fijo</label>
                                            <input type="tel" class="form-control is-valid" id="tel1" class="telf" name="tel1" pattern="[0-9]{9}" required>
                                            <div class="invalid-feedback"  id="feedTel">

                                            </div>
                                        </div>

                                        <div class="form-group col-lg-6" >
                                            <label for="tel2">Movil</label>
                                            <input type="tel" class="form-control is-valid" class="telf" id="tel2" name="tel2" pattern="[0-9]{9}">
                                            <div class="invalid-feedback"  id="feedMov">

                                            </div>
                                        </div>

                                        <div class="form-group col-lg-6">
                                            <label for="zipo">Zip</label>
                                            <input type="text" class="form-control is-valid" id="zipo" name="zipo" placeholder="01000" pattern="^[0-9]{5}$" required>
                                            <div class="invalid-feedback"  id="feedZipo">

                                            </div>
                                        </div>

                                    </div>
                                    <button type="submit" class="btn btn-primary" name="submito">Sign up</button>


                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <?php
    //llamadas a usuarioBd

    ?>
    <!--Include para el footer externo-->
    <?php include '../views/footer.php';?>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
<script src="../js/bootstrap.min.js"></script>
<script src="../js/js.js"></script>
</body>
</html>