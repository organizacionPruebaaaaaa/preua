<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/style.css">
    <title>PEPE</title>
</head>
<body>
    <div class="header">
        <nav class="navbar navbar-default">
            <div class="container">
                <div class="col-xs-12">
                    <div class="navbar-header">
                        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                        </button>
                        <a class="navbar-brand" href="#">Blasting Off With Bootstrap</a>
                    </div>
                    <div class="collapse navbar-collapse" id="myNavbar">
                        <ul class="nav navbar-nav navbar-right">
                            <li><a href="#"  id="carga2"><span class="glyphicon glyphicon-user"></span> Sign Up</a></li>
                            <li><a href="#"  id="carga1"><span class="glyphicon glyphicon-log-in"></span> Login</a></li>
                        </ul>
                        <ul class="nav navbar-nav navbar-left">
                            <li class="active"><a href="#">Take a Tour</a></li>
                            <li><a href="#">But Tickets</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </nav>
    </div>
    <div class=”main”>
        <div class=”container” id="contenedor">
            <div class="well">
                <div class="row center-block">
                <!-- contenedor para el registro -->
                    <div class="thumbnail" id="thub1">
                        <div class="caption">
                            <form id="register" method="post" action="index.html">
                                <h2>Register</h2>
                                <div class="form-row col-sm-6 col-md-6">
                                    <div class="form-group col-md-6 ">
                                        <label for="emailoReg">Email</label>
                                        <input type="email" class="form-control is-valid" id="emailoReg" placeholder="Email" required>
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
                                        <input type="text" class="form-control is-valid" id="alias">
                                    </div>
                                </div>
                                <div class="form-row col-sm-6 col-md-6">
                                    <div class="form-group col-md-2">
                                        <label for="nombre">Nombre</label>
                                        <input type="text" class="form-control is-valid" id="nombre">
                                    </div>
                                    <div class="form-group col-md-2">
                                        <label for="apellido1">Apellido 1</label>
                                        <input type="text" class="form-control is-valid" id="apellido1">
                                    </div>
                                    <div class="form-group col-md-2">
                                        <label for="apellido2">Apellido 2</label>
                                        <input type="text" class="form-control is-valid" id="apellido2">
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="direccion">Direccion</label>
                                        <input type="text" class="form-control is-valid" id="direccion" placeholder="1234 Main St">
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="ciudad">Ciudad</label>
                                        <input type="text" class="form-control is-valid" id="ciudad">
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label for="provincia">Provincia</label>
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
                                        <input type="text" class="form-control is-valid" id="zip">
                                    </div>
                                    <div class="form-group col-md-2">
                                        <label for="tel1">Fijo</label>
                                        <input type="tel" class="form-control is-valid" id="tel1">
                                    </div>
                                    <div class="form-group col-md-2">
                                        <label for="tel2">Movil</label>
                                        <input type="tel" class="form-control is-valid" id="tel2">
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-primary">sign up</button>
                                <button type="button" class="btn btn-default" id="log">Log In</button>
                            </form>
                        </div>
                    </div>

                    <!-- Contenedor para el login -->
                    <div class="thumbnail col-sm-6 col-md-6" id="thub2">
                        <div class="caption">
                            <form id="login" method="post" action="index.html">
                                <h2>Login</h2>
                                <div class="form-group">
                                    <label for="emailoLog">Email address</label>
                                    <input type="email" class="form-control" id="emailoLog" aria-describedby="emailHelp" placeholder="Enter email">
                                    <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
                                    <?php
                                        /**
                                        *Recogida variable llamada bd
                                        */
                                        if(isset($_POST['emailLog']))
                                        {

                                        }
                                        ?>
                                </div>
                                <div class="form-group">
                                    <label for="passwordLog">Password</label>
                                    <input type="password" class="form-control" id="passwordLog" placeholder="Password">
                                </div>
                                <!--
                                <div class="form-check">
                                    <label class="form-check-label">
                                        <input type="checkbox" class="form-check-input">
                                        Check me out
                                    </label>
                                </div>
                                para recordar usuario
                                -->
                                <button type="submit" class="btn btn-primary">Log In</button>
                                <button type="button" class="btn btn-default" id="sig">sign up</button>
                            </form>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
<script src="js/bootstrap.min.js"></script>
    <script src="js/js.js"></script>
</body>
</html>