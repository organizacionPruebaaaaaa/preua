<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/css/bootstrap.min.css">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css" integrity="sha384-PsH8R72JQ3SOdhVi3uxftmaW6Vc51MKb0q5P2rRUpPvrszuE4W1povHYgTpBfshb" crossorigin="anonymous">
        <link rel="stylesheet" href="../css/bootstrap.min.css">
        <link rel="stylesheet" href="../css/style.css">
        <link rel="stylesheet" href="../css/bootstrap-social.css">
        <link rel="stylesheet" href="../css/main.css">
        <link rel="icon" href="http://172.20.224.112/none.ico" type="image/x-icon" />
        <title>Quienes somos</title>        
    </head>
    <body>
        
        
        
        <?php
        //session_start();
        /*if(!isset($_SESSION['usuario'])){
            header("Location: http://none.com/views/login.php");
        }*/
        /*if(!isset($_SESSION['filasMin'])){
                $_SESSION['filasMin']=0;
        }*/
        include '../views/header.php';
        ?>
        <div class="main">
            <div class="container ">
                <div class="well content main-container">
                    <div class="float-left divLogo">
                        <img src="../img/none.com-logo-negro.PNG" class="img-fluid rounded float-left" alt="Logo None">
                    </div>
                    <div class="cols-xs-7">
                        <div id="qs">
                            <p>
                                <span id="nc">
                                    <strong><a href="http://prezi.com/tdqydqgahfos/?utm_campaign=share&utm_medium=copy" target="_blank">None.com</a></strong>,
                                </span>
                                <span class="tx">
                                    departamento de la empresa Vi-Web, formada por varios grupos de trabajo con la idea de afrontar un proyecto de
                                    diferentes maneras y así poder ofrecer al cliente distintos prototipos para que pueda elegir el que mas le guste.

                                </span>
                            </p>
                            <p class="tx">
                                <strong>NONE</strong> es un grupo de trabajo de alumnos de segundo curso de Grado Superior de Desarrolo de Aplicaciones
                                Web de Egibide-Arriaga, en Vitoria-Gasteiz (Araba). Nuestra falta de experiencia pretendemos, y creemos
                                en parte suplirla, con nuestra ilusión y ganas de trabajar en este apasionante universo de la programación
                                y el desarrollo web. Las ideas y la creatividad son una parte muy importante en nuestro grupo, y las
                                implementamos siempre dentro de los requerimientos de nuestros clientes y de los trabajos encargados,
                                porque creemos que esto nos aporta un extra ante la posible competencia que simplemente se ciña a la idea original
                                sin aportar nada propio y original.
                            </p>
                            <p class="tx">
                                Esta web, <strong>NoneAnuncios</strong>, es nuestro segundo trabajo dentro de los retos que se nos encargan en este curso. 
                                El primero fue <strong>WebTranvía</strong>, una web para la gestión del tranvía de Vitoria-Gasteiz, fue un éxito que nos aportó 
                                la seguridad para afrontar este segundo trabajo que, aunque más complejo, nos ha abierto las puertas a conocer 
                                como unir todas las herramientas que se nos han impartido. De la misma forma que el primero, esperamos que esta 
                                aplicación web sea otro éxito que nos siga llevando adelante. Lo que ya es cierto, y que ya es un éxito para nosotros, 
                                es todo lo que hemos aprendido durante la realización de este proyecto.
                            </p>

                            <iframe width="854" height="480" src="https://www.youtube.com/embed/nJz8d8YOvCE" frameborder="0" gesture="media" allowfullscreen></iframe>
                            <p class="tx">
                                Desde <strong>None.com</strong> seguiremos trabajando con las mismas ganas e ilusión para continuar creando proyectos que nos 
                                conduzcan a la consecución de nuestras metas.
                            </p>

                            <span>
                            <blockquote>
                                <p>Una máquina puede hacer el trabajo de 50 hombres corrientes. Pero no existe ninguna máquina que pueda hacer el trabajo de un hombre extraordinario.</p>
                                <small><cite title="Nombre Apellidos">Elbert Hubbard </cite></small>
                            </blockquote>
                            <p class="tx">
                                <strong>None.com</strong> somos Jovi Parra, Alfonso Barguilla y Dani García.
                                <br><br>
                                <button type="button" class="btn btn-secondary float-left" name="volverainicio" onclick="location.replace('../index.php')">Volver al Inicio</button>
                                <br><br>
                            </p>
                        </div>
                    </div>
                    
                </div>               
            </div>
        </div>
        
        <!--Include para el footer externo-->
        <?php include '../views/footer.php';?>
        <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.3/umd/popper.min.js" integrity="sha384-vFJXuSJphROIrBnz7yo7oB41mKfc8JzQZiCq4NCceLEaO4IHwicKwpJf9c9IpFgh" crossorigin="anonymous"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/js/bootstrap.min.js" integrity="sha384-alpBpkh1PFOepccYVYDB4do5UnbKysX5WZXm3XxPqe5iKTfUKjNkCk9SaVuEZflJ" crossorigin="anonymous"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
        <script src="../js/bootstrap.min.js"></script>
        <script src="../js/js.js"></script>
    </body>
</html>
