<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <title>Title</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css" integrity="sha384-PsH8R72JQ3SOdhVi3uxftmaW6Vc51MKb0q5P2rRUpPvrszuE4W1povHYgTpBfshb" crossorigin="anonymous">

    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/main.css">
</head>
<body>
    <div class="box">
        <?php
        session_start();
        if(!isset($_SESSION['usuario'])){
            header("Location: http://none.com/views/login.php");
        }
        include '../views/header.php';
        ?>
        <div class="main">
            <div class="container well" id="contenedor">
                <div class="row content center-block">
                    <!-- contenedor para el registro -->
                    <div class="thumbnail caption" id="thubRegister">
                        <form id="register" method="post" action="register.php">
                            <h2>Cambiar datos del perfil:</h2>
                            <div class="form-row col-sm-6 col-md-6">
                                <div class="form-group col-md-6 ">
                                    <label for="emailoReg">Email:</label>
                                    <input type="email" class="form-control is-valid" id="emailoReg" placeholder="<?php echo $_SESSION['usuario']->email; ?>" required>
                                    <?php
                                    /**
                                     *Recogida variable llamada bd
                                     */
                                    if(isset($_POST['emailReg']))
                                    {
                                        echo $_POST['emailReg'];
                                    }
                                    ?>

                                    <div class="invalid-feedback">
                                        Please provide a valid state.
                                    </div>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="passwordReg">Contraseña</label>
                                    <input type="password" class="form-control is-valid" id="passwordReg" placeholder="Password" required>
                                    <div class="invalid-feedback">
                                        Please provide a valid state.
                                    </div>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="passwordReg2">Contraseña</label>
                                    <input type="password" class="form-control is-valid" id="passwordReg2" placeholder="Password" required>
                                    <div class="invalid-feedback">
                                        Please provide a valid state.
                                    </div>
                                </div>
                                <div class="form-group col-md-2">
                                    <label for="alias">Alias</label>
                                    <input type="text" class="form-control is-valid" id="alias" placeholder="<?php echo $_SESSION['usuario']->alias; ?>">
                                </div>
                            </div>
                            <div class="form-row col-sm-6 col-md-6">
                                <div class="form-group col-md-2">
                                    <label for="nombre">Nombre</label>
                                    <input type="text" class="form-control is-valid" id="nombre" placeholder="<?php echo $_SESSION['usuario']->nombre; ?>">
                                </div>
                                <div class="form-group col-md-2">
                                    <label for="apellido1">Apellido 1</label>
                                    <input type="text" class="form-control is-valid" id="apellido1" placeholder="<?php echo $_SESSION['usuario']->apellido1; ?>">
                                </div>
                                <div class="form-group col-md-2">
                                    <label for="apellido2">Apellido 2</label>
                                    <input type="text" class="form-control is-valid" id="apellido2" placeholder="<?php echo $_SESSION['usuario']->apellido2; ?>">
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="direccion">Direccion</label>
                                    <input type="text" class="form-control is-valid" id="direccion" placeholder="<?php echo $_SESSION['usuario']->calle; ?>">
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="ciudad">Ciudad</label>
                                    <input type="text" class="form-control is-valid" id="ciudad" placeholder="<?php echo $_SESSION['usuario']->localidad; ?>">
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="provincia">Provincia </label><?php echo $_SESSION['usuario']->provincia; ?>
                                    <select id="provincia" class="form-control">
                                        <option selected>Selecciona...</option>
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
                                </div>
                                <div class="form-group col-md-2">
                                    <label for="zip">Zip</label>
                                    <input type="text" class="form-control is-valid" id="zip" placeholder="<?php echo $_SESSION['usuario']->codigopostal; ?>">
                                </div>
                                <div class="form-group col-md-2">
                                    <label for="tel1">Fijo</label>
                                    <input type="tel" class="form-control is-valid" id="tel1" placeholder="<?php echo $_SESSION['usuario']->telefono1; ?>">
                                </div>
                                <div class="form-group col-md-2">
                                    <label for="tel2">Movil</label>
                                    <input type="tel" class="form-control is-valid" id="tel2" placeholder="<?php echo $_SESSION['usuario']->telefono2; ?>">
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary">sign up</button>
                            <button type="button" class="btn btn-default" id="log">Log In</button>
                        </form>
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