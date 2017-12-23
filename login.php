<?php
    session_start();
    if($_SESSION['logueo']) { header("Location: index"); }
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Codeando HTML</title>
        <link rel="icon" href="img/small/favicon.png">
        <!--Let browser know website is optimized for mobile-->
        <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
        <link rel="stylesheet" href="css/main.css">
        <link rel="stylesheet" href="css/login.css">
        <link rel="stylesheet" href="css/font-awesome.min.css">
        <link type="text/css" rel="stylesheet" href="css/materialize.min.css"  media="screen,projection"/>
        <!--Import Google Icon Font-->
        <link href="https://fonts.googleapis.com/css?family=Quicksand:300,400,500,700" rel="stylesheet">
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    </head>
    <body>
        <header>
            
        </header>
        <br>
        <section class="grid container">
            <!-- Page Layout here -->
            <div class="login">
                <hgroup>
                    <h1>Codeando HTML</h1>
                    <!-- <i class="fa fa-html5"></i> -->
                    <h3>Login</h3>
                </hgroup>
                <div class="row">
                    <form class="form-login" method="post">
                        <div class="row">
                            <div class="input-field col s12">
                                <input id="email" type="email" class="" required>
                                <label for="email" data-error="incorrecto" data-success="correcto">Email</label>
                            </div>
                            <div class="input-field col s12">
                                <input id="password" type="password" class="" required>
                                <label for="password" data-error="incorrecto" data-success="correcto">Password</label>
                            </div>
                            <!-- <div class="error-pass"> -->
                                <span class="error-pass">El email o la contraseña son incorrectas</span>
                            <!-- </div> -->
                            <button class="btn waves-effect waves-light blue lighten-1 btn-login-submit" type="" name="">Entrar
                                <!-- <i class="material-icons right">send</i> -->
                            </button>
                            <span>
                                <a href="#">¿Olvidaste tu contraseña?</a>
                            </span>
                        </div>
                    </form>
                </div>
            </div>
        </section>
        <footer>
            <a target="_blank" href="http://www.w3.org/html/logo/">
            <img src="https://www.w3.org/html/logo/badge/html5-badge-h-solo.png" width="63" height="64" alt="HTML5 Powered" title="HTML5 Powered">
            </a>
            <p>You Gotta Love 
                <a href="http://fabianmunoz.com/" target="_blank">Fabián Muñoz</a>
            </p>
        </footer>
        <!--Import jQuery before materialize.js-->
        <script type="text/javascript" src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
        <script type="text/javascript" src="js/materialize.min.js"></script>
        <script type="text/javascript" src="js/codeandohtml.js"></script>
    </body>
</html>