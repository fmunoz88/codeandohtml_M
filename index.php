<?php 
    include_once 'config/conexion.php';
    $db = db_connect();
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title></title>
        <link rel="stylesheet" href="css/main.css">
        <link rel="stylesheet" href="css/font-awesome.min.css">
        <!--Import Google Icon Font-->
        <link href="https://fonts.googleapis.com/css?family=Quicksand" rel="stylesheet">
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
        <!--Import materialize.css-->
        <link type="text/css" rel="stylesheet" href="css/materialize.min.css"  media="screen,projection"/>
        <!--Let browser know website is optimized for mobile-->
        <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    </head>
    <body>
        <header>
            <nav class="ambar">
                <div class="nav-wrapper container">
                    <a href="#" class="brand-logo"><i class="fa fa-html5"></i>Codeando HTML</a>
                    <ul id="nav-mobile" class="right hide-on-med-and-down">
                        <!-- <li><a href="sass.html">Sass</a></li> -->
                        <li><a href="badges.html">Acerca de</a></li>
                        <li><a href="collapsible.html">Contacto</a></li>
                        <li><a href="src/add-article.php">Nuevo Artículo</a></li>
                    </ul>
                </div>
            </nav>
        </header>
        <br>
        <section class="grid container">
            <!-- Page Layout here -->
            <div class="row">
                <!-- LEFT SIDE -->
                <div class="left-side col s12 l9">
                <!-- Grey navigation panel -->
                <?php
                    //Statement thread
                    $records = $db->query("SELECT A.id, A.fecha, A.titulo, A.articulo, U.nombre , I.path AS ruta
                                            FROM Articulos A 
                                            LEFT JOIN Usuarios U ON A.idUsuario = U.id 
                                            LEFT JOIN Imagenes I ON A.idImg = I.id
                                            ORDER BY A.fecha DESC LIMIT 10");
                        
                    // echo "<pre>"; var_dump($records,mysqli_error($db)); die();
                    foreach ($records as $v){
                        
                        //formatter date
                        $date = new DateTime($v['fecha']);
                        //format date
                        setlocale(LC_TIME, "es_ES");
                        $dateFormatte = ucwords(strftime("%d %B %G", strtotime($date->format('d-m-Y'))));
                        
                        echo ('<div class="col s12">');
                            echo ('<div class="card hoverable horizontal">');
                                echo ('<div class="card-image img-header">');
                                    echo ('<a href="article.php?id='.$v["id"].'" ><img src="img/medium/'.$v["ruta"].'"></a>');
                                echo ('</div>');
                                echo ('<div class="card-article card-stacked col s9">');
                                    echo ('<div class="card-content">');
                                        echo ('<h4 class="truncate"><a href="article.php?id='.$v["id"].'">'.strtoupper($v["titulo"]).'</a></h4>');
                                        echo ('<div class="row date-badge">');
                                            echo ('<span class="col new badge valign-wrapper" data-badge-caption="">'.substr($dateFormatte, 0, 6).'</span>');
                                            echo ('<span class="col s7 m8 l9"><a href="#">Fabián Muñoz Dev</a></span>');
                                        echo ('</div>');
                                        echo ('<hr>');
                                        echo ('<p class="truncate">'.$v["articulo"].'</p>');
                                    echo ('</div>');
                                echo ('</div>');
                            echo ('</div>');
                        echo ('</div>');
                    }
                ?>
                    <!-- BUTTON MORE -->
                    <div class="button-more">
                        <a class="waves-effect grey darken-3 btn">Mostrar Más</a>
                    </div>
                </div>
                <!-- RIGHT SIDE -->
                <div class="right-side col s12 l3">
                    <!-- Most Viewer -->
                    <div class="most-viewer row">
                        <div class="col s12 ">
                            <h5 class="">Lo más visto</h5>
                            <div class="collection">
                                <a href="#!" class="truncate collection-item" title="Curso Framework Yii 2 con Bootstrap"><img src="img/medium/php.png"><span class="truncate">Curso Framework Yii 2 con Bootstrap</span></a>
                                <a href="#!" class="truncate collection-item" title="Sentencias MySQL"><img src="img/medium/mysql.png"><span class="truncate">Sentencias MySQL</span></a>
                                <a href="#!" class="truncate collection-item" title="Angular + React JS"><img src="img/medium/angular.png"><span class="truncate">Angular + React JS</span></a>
                                <a href="#!" class="truncate collection-item" title="Curso FrameworkDirectorios con Python"><img src="img/medium/python.png"><span class="truncate">Directorios con Python</span></a>
                                <a href="#!" class="truncate collection-item" title="Curso HTML5 + CSS3"><img src="img/medium/html_css.png"><span class="truncate">Curso HTML5 + CSS3</span></a>
                            </div>
                        </div>
                    </div>
                    <!-- Tag Popular -->
                    <div class="row tag-popular">
                        <div class="col s12 ">
                            <h5 class="">Tags populares</h5>
                            <div class="chip"><a href="#">PHP</a></div>
                            <div class="chip"><a href="#">MySQL</a></div>
                            <div class="chip"><a href="#">Yii Framework</a></div>
                            <div class="chip"><a href="#">Oracle</a></div>
                            <div class="chip"><a href="#">.NET</a></div>
                            <div class="chip"><a href="#">Python</a></div>
                            <div class="chip"><a href="#">PHP</a></div>
                            <div class="chip"><a href="#">Android</a></div>
                            <div class="chip"><a href="#">MySQL</a></div>
                            <div class="chip"><a href="#">Yii Framework</a></div>
                            <div class="chip"><a href="#">Oracle</a></div>
                            <div class="chip"><a href="#">.NET</a></div>
                            <div class="chip"><a href="#">Python</a></div>
                            <div class="chip"><a href="#">PHP</a></div>
                            <div class="chip"><a href="#">Java</a></div>
                        </div>
                    </div>
                    <!-- Categories -->
                    <div class="collapse-container">
                        <ul class="collapsible" data-collapsible="expandable">
                            <li class="title-collapsible"><div class="collapsible-header">CATEGORÍAS</div></li>
                            <li>
                                <!-- <div class="collapsible-header coll-hea active"><i class="material-icons">chevron_right</i>PHP<span class="new badge" data-badge-caption="">3</span></div> -->
                                <div class="collapsible-header coll-hea"><i class="material-icons">chevron_right</i>PHP</div>
                                <div class="collapsible-body">
                                    <ul>
                                        <li><i class="fa fa-chevron-right" aria-hidden="true"></i><span><a href="#">FOREACH</a></span></li>
                                        <li><i class="fa fa-chevron-right" aria-hidden="true"></i><span><a href="#">WHILE</a></span></li>
                                        <li><i class="fa fa-chevron-right" aria-hidden="true"></i><span><a href="#">IF / WHILE</a></span></li>
                                    </ul>
                                </div>
                            </li>
                            <li>
                                <div class="collapsible-header coll-hea"><i class="material-icons">chevron_right</i>Yii Framework</div>
                                <div class="collapsible-body">
                                    <ul>
                                        <li><i class="fa fa-chevron-right" aria-hidden="true"></i><span><a href="#">FOREACH</a></span></li>
                                        <li><i class="fa fa-chevron-right" aria-hidden="true"></i><span><a href="#">WHILE</a></span></li>
                                        <li><i class="fa fa-chevron-right" aria-hidden="true"></i><span><a href="#">IF / WHILE</a></span></li>
                                    </ul>
                                </div>
                            </li>
                            <li>
                                <div class="collapsible-header coll-hea"><i class="material-icons">chevron_right</i>MySQL</div>
                                <div class="collapsible-body">
                                    <ul>
                                        <li><i class="fa fa-chevron-right" aria-hidden="true"></i><span><a href="#">FOREACH</a></span></li>
                                        <li><i class="fa fa-chevron-right" aria-hidden="true"></i><span><a href="#">WHILE</a></span></li>
                                        <li><i class="fa fa-chevron-right" aria-hidden="true"></i><span><a href="#">IF / WHILE</a></span></li>
                                    </ul>
                                </div>
                            </li>
                            <li>
                                <div class="collapsible-header coll-hea"><i class="material-icons">chevron_right</i>Python</div>
                                <div class="collapsible-body">
                                    <ul>
                                        <li><i class="fa fa-chevron-right" aria-hidden="true"></i><span><a href="#">FOREACH</a></span></li>
                                        <li><i class="fa fa-chevron-right" aria-hidden="true"></i><span><a href="#">WHILE</a></span></li>
                                        <li><i class="fa fa-chevron-right" aria-hidden="true"></i><span><a href="#">IF / WHILE</a></span></li>
                                    </ul>
                                </div>
                            </li>
                            <li>
                                <div class="collapsible-header coll-hea"><i class="material-icons">chevron_right</i>Oracle</div>
                                <div class="collapsible-body">
                                    <ul>
                                        <li><i class="fa fa-chevron-right" aria-hidden="true"></i><span><a href="#">FOREACH</a></span></li>
                                        <li><i class="fa fa-chevron-right" aria-hidden="true"></i><span><a href="#">WHILE</a></span></li>
                                        <li><i class="fa fa-chevron-right" aria-hidden="true"></i><span><a href="#">IF / WHILE</a></span></li>
                                    </ul>
                                </div>
                            </li>
                            <li>
                                <div class="collapsible-header coll-hea"><i class="material-icons">chevron_right</i>Angular 4</div>
                                <div class="collapsible-body">
                                    <ul>
                                        <li><i class="fa fa-chevron-right" aria-hidden="true"></i><span><a href="#">FOREACH</a></span></li>
                                        <li><i class="fa fa-chevron-right" aria-hidden="true"></i><span><a href="#">WHILE</a></span></li>
                                        <li><i class="fa fa-chevron-right" aria-hidden="true"></i><span><a href="#">IF / WHILE</a></span></li>
                                    </ul>
                                </div>
                            </li>
                            <li>
                                <div class="collapsible-header coll-hea"><i class="material-icons">chevron_right</i>CSS</div>
                                <div class="collapsible-body">
                                    <ul>
                                        <li><i class="fa fa-chevron-right" aria-hidden="true"></i><span><a href="#">FOREACH</a></span></li>
                                        <li><i class="fa fa-chevron-right" aria-hidden="true"></i><span><a href="#">WHILE</a></span></li>
                                        <li><i class="fa fa-chevron-right" aria-hidden="true"></i><span><a href="#">IF / WHILE</a></span></li>
                                    </ul>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </section>
        <!-- Footer -->
        <footer>
            <ul class="social">
                <li><a href="#" target="_blank"><i class="fa fa-facebook"></i></a></li>
                <li><a href="#" target="_blank"><i class="fa fa-google-plus"></i></a></li>
                <li><a href="#" target="_blank"><i class="fa fa-twitter"></i></a></li>
                <li><a href="#" target="_blank"><i class="fa fa-youtube"></i></a></li>
                <li><a href="#" target="_blank"><i class="fa fa-instagram"></i></a></li>
            </ul>
        </footer>
        <footer class="second">
            <p> Desarrollado por Fabián Muñoz &copy;</p>
        </footer>
        <!--Import jQuery before materialize.js-->
        <script type="text/javascript" src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
        <script type="text/javascript" src="js/materialize.min.js"></script>
    </body>
</html>