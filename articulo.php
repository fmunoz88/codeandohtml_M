<?php 
    include_once 'config/config.php';
    include_once 'libs/Parsedown.php';
    include 'config/conexion.php';
    // echo "<pre>"; var_dump("-> GET: ",$_GET); die();
    $db = db_connect();
    
    $id = (int) $_GET['id'];
    $query = "SELECT a.titulo, a.fecha, a.articulo, a.tags FROM Articulos a WHERE id = ".$id;
    
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Exportar en el gridview en Yii2</title>
        <!--Let browser know website is optimized for mobile-->
        <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
        <link rel="stylesheet" href="<?php echo SERVERURL; ?>css/main.css">
        <link rel="stylesheet" href="<?php echo SERVERURL; ?>css/font-awesome.min.css">
        <link href="https://fonts.googleapis.com/css?family=Quicksand:300,400,500,700" rel="stylesheet">
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
        <!--Import materialize.css-->
        <link type="text/css" rel="stylesheet" href="<?php echo SERVERURL; ?>css/materialize.min.css"  media="screen,projection"/>
        <!-- prims Monokai -->
        <link href="<?php echo SERVERURL; ?>css/prism_monokai.css" rel="stylesheet" />
    </head>
    <body>
        <header>
            <nav class="ambar">
                <div class="nav-wrapper container">
                    <a href="<?php echo SERVERURL; ?>" class="brand-logo"><i class="fa fa-html5"></i>Codeando HTML</a>
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
                <div class="left-side col s12  l9">
                    <article class="">
                        
                        <?php 
                            //Leer desde la DB el artículo seleccionado
                            $parsedown = new Parsedown();
                            
                            $record = $db->query($query);
                            // $record = $db->query("SELECT * FROM Articulos WHERE id = ".$_GET['id']." LIMIT 1");
                            
                            foreach ($record as $v) {
                                //get date
                                $date = new DateTime($v['fecha']);
                                //format date
                                setlocale(LC_TIME, "es_ES");
                                
                                echo ('<h3 class="title-article">'.$v['titulo'].'</h3>');
                                // echo ('<h4 class="subtitle-article">'.$v['subTitulo'].'</h4>');
                                echo ('<div class="separator_0"></div>');
                                echo ('<div class="author-article">');
                                    echo ('<span><i>publicado</i><b> '.ucwords(strftime("%d %B %G", strtotime($date->format('d-m-Y')))).'</b></span>');
                                    echo ('<div class="chip ">');
                                    echo ('<img class=""src="'.SERVERURL.'img/medium/fabian.png" alt="Contact Person">');
                                        echo ('<a class="" href="#">Por Fabián Muñoz</a>');
                                    echo ('</div>');
                                echo ('</div>');
                                
                                echo $parsedown->text($v['articulo']);
                            }
                        ?>
                    <!-- end code -->
                    </article>
                    <!-- End article -->
                    <!-- TAG ARTICLE -->
                    <div class="tag-article">
                        <?php 
                            $record = $db->query($query);
                            $row = mysqli_fetch_assoc($record);
                            $tags = explode(',', trim($row['tags'],','));
                            
                            foreach($tags AS $k) {
                                $tagID = (int) $k;
                                
                                $tagRecord = $db->query("SELECT t.nombre FROM Tags t WHERE t.id = ".$tagID);
                                $tagRow = mysqli_fetch_assoc($tagRecord);
                                // echo "<pre>"; var_dump($tagRow['nombre']);
                                echo ('<a class="hover_1" href="#">'.$tagRow['nombre'].'</a>');
                            }
                        ?>
                    </div>
                </div>
                <!-- RIGHT SIDE -->
                <div class="right-side col s12  l3">
                    <!-- Most Viewer -->
                    <div class="most-viewer row">
                        <div class="col s12 ">
                            <h5 class="">Lo más visto</h5>
                            <div class="collection">
                                <a href="#!" class="truncate collection-item" title="Curso Framework Yii 2 con Bootstrap"><img src="<?php echo SERVERURL; ?>img/medium/php.png"><span class="truncate">Curso Framework Yii 2 con Bootstrap</span></a>
                                <a href="#!" class="truncate collection-item" title="Sentencias MySQL"><img src="<?php echo SERVERURL; ?>img/medium/mysql.png"><span class="truncate">Sentencias MySQL</span></a>
                                <a href="#!" class="truncate collection-item" title="Angular + React JS"><img src="<?php echo SERVERURL; ?>img/medium/angular.png"><span class="truncate">Angular + React JS</span></a>
                                <a href="#!" class="truncate collection-item" title="Curso FrameworkDirectorios con Python"><img src="<?php echo SERVERURL; ?>img/medium/python.png"><span class="truncate">Directorios con Python</span></a>
                                <a href="#!" class="truncate collection-item" title="Curso HTML5 + CSS3"><img src="<?php echo SERVERURL; ?>img/medium/html_css.png"><span class="truncate">Curso HTML5 + CSS3</span></a>
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
            <p> Desarrollado por Fabián Muñoz &copy; <?php echo date('Y'); ?></p>
        </footer>
        <!--Import jQuery before materialize.js-->
        <script type="text/javascript" src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
        <script type="text/javascript" src="js/materialize.min.js"></script>
        <!-- prims -->
        <script src="js/prism_monokai.js"></script>
    </body>
</html>