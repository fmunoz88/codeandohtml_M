<?php 
    include_once 'config/config.php';
    include_once 'config/conexion.php';
    $db = db_connect();
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title></title>
        <link rel="stylesheet" href="<?php echo SERVERURL; ?>css/main.css">
        <link rel="stylesheet" href="<?php echo SERVERURL; ?>css/font-awesome.min.css">
        <!--Import Google Icon Font-->
        <link href="https://fonts.googleapis.com/css?family=Quicksand" rel="stylesheet">
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
        <!--Import materialize.css-->
        <link type="text/css" rel="stylesheet" href="<?php echo SERVERURL; ?>css/materialize.min.css"  media="screen,projection"/>
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
                        <li><a href="#">Acerca de</a></li>
                        <li><a href="#">Contacto</a></li>
                        <li><a href="src/add-article">Nuevo Artículo</a></li>
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
                    <div class="content-card">
                        <!-- Grey navigation panel -->
                        <?php
                            $showLimit = 10;
                            
                            //Statement thread
                            $query = "SELECT A.id, A.fecha, A.titulo, SUBSTRING(A.articulo, 1, 100) AS articulo, U.nombre , I.path AS ruta
                                        FROM Articulos A 
                                        LEFT JOIN Usuarios U ON A.idUsuario = U.id 
                                        LEFT JOIN Imagenes I ON A.idImg = I.id
                                        WHERE A.preview = 0
                                        ORDER BY A.fecha DESC ";
                            
                            //Statement thread and concatenate LIMIT 
                            $records = $db->query($query. " LIMIT ".$showLimit);
                            
                            //Conteo total de registros
                            $recordCount = $db->query($query)->num_rows;
                                
                            foreach ($records as $v){
                                
                                //formatter date
                                $date = new DateTime($v['fecha']);
                                //format date
                                setlocale(LC_TIME, "es_ES");
                                $dateFormatte = ucwords(strftime("%d %B %G", strtotime($date->format('d-m-Y'))));
                                
                                echo ('<div class="col s12">');
                                    echo ('<div class="card hoverable horizontal">');
                                        echo ('<div class="card-image img-header">');
                                            echo ('<a href="articulo/'.$v["id"].'/'.str_replace(' ','-',strtolower($v['titulo'])).'" ><img src="'.SERVERURL.'img/medium/'.$v["ruta"].'"></a>');
                                        echo ('</div>');
                                        echo ('<div class="card-article card-stacked col s9">');
                                            echo ('<div class="card-content">');
                                                echo ('<h4 class="truncate"><a href="articulo/'.$v["id"].'/'.str_replace(' ','-',strtolower($v['titulo'])).'">'.strtoupper($v["titulo"]).'</a></h4>');
                                                echo ('<div class="row date-badge">');
                                                    echo ('<span class="col new badge valign-wrapper" data-badge-caption="">'.strtoupper(substr($dateFormatte, 0, 6)).'</span>');
                                                    echo ('<span class="col s7 m8 l9"><a href="#">Fabián Muñoz Dev</a></span>');
                                                echo ('</div>');
                                                echo ('<hr>');
                                                echo ('<p class="truncate">'.$v["articulo"].'</p>');
                                            echo ('</div>');
                                        echo ('</div>');
                                    echo ('</div>');
                                echo ('</div>');
                                
                                $last_id = $v['id'];
                            }
                            //Si el conteo total de registro en la db es mayor a lo que se debe mostrar ($showLimit), entonces se mostrará el botón de "Cargar"
                            if($recordCount > $showLimit){
                                echo ('<div class="button-more clearfix">');
                                    echo ('<a onclick="loadMoreCard('.$last_id.')" class="waves-effect grey darken-3 btn btn-more-cards">Mostrar Más</a>');
                                echo ('</div>');
                            }    
                        ?>
                    </div>
                    <div class="loading center" style="display: none; width: 100px; margin: 0 auto;">
                        <img style="height: 100px;" src="img/big/loading_2.svg" alt="">
                    </div>
                </div>
                <!-- RIGHT SIDE -->
                <div class="right-side col s12 l3">
                    <!-- Most Viewer -->
                    <div class="most-viewer row">
                        <div class="col s12 ">
                            <h5 class="">Lo más visto</h5>
                            <div class="collection">
                                <?php 
                                    //Obtener los artículos más visto ordenados por vistas
                                    $showLimitV = 5;
                                    
                                    //Statement thread
                                    $query = "SELECT A.id, A.fecha, A.titulo, SUBSTRING(A.articulo, 1, 100) AS articulo, U.nombre , I.path AS ruta
                                                FROM Articulos A 
                                                LEFT JOIN Usuarios U ON A.idUsuario = U.id 
                                                LEFT JOIN Imagenes I ON A.idImg = I.id
                                                WHERE A.preview = 0
                                                ORDER BY A.vistas DESC LIMIT ".$showLimitV;
                                    
                                    $records = $db->query($query);
                                    
                                    foreach ($records as $v) {
                                        echo ('<a href="articulo/'.$v["id"].'/'.str_replace(' ','-',strtolower($v['titulo'])).'" class="truncate collection-item" title="'.$v['titulo'].'"><img src="'.SERVERURL.'img/medium/'.$v["ruta"].'"><span class="truncate">'.$v['titulo'].'</span></a>');
                                    }
                                ?>
                            </div>
                        </div>
                    </div>
                    <!-- Tag Popular -->
                    <div class="row tag-popular">
                        <div class="col s12 ">
                            <h5 class="">Tags populares</h5>
                            <?php 
                                $showLimitT = 15;
                                
                                //Statement tags
                                $query = "SELECT t.id, t.nombre FROM Tags t ORDER BY t.conteo DESC LIMIT ".$showLimitT;
                                $records = $db->query($query);
                                
                                foreach ($records as $v) {
                                    echo ('<div class="chip"><a href="#">'.$v['nombre'].'</a></div>');
                                }
                                
                            ?>
                            <!-- <div class="chip"><a href="#">PHP</a></div>
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
                            <div class="chip"><a href="#">Java</a></div> -->
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
        <script type="text/javascript" src="<?php echo SERVERURL; ?>js/materialize.min.js"></script>
        <script type="text/javascript" src="<?php echo SERVERURL; ?>js/codeandohtml.js"></script>
    </body>
</html>