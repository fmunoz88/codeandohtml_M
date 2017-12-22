<?php 
    include_once '../config/config.php';
    include_once '../php/funciones.php';
    include_once '../config/conexion.php';
    $db = db_connect();
    
    $id = (int) $_GET['id'];
    $query = $db->query("SELECT t.id, t.nombre FROM Tags t WHERE t.id = " . $id);
    $row = mysqli_fetch_assoc($query);
    //Actualizar conteo de tag
    actualizarConteoTags($db, $id);
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title><?php echo $row['nombre']; ?></title>
        <!--Let browser know website is optimized for mobile-->
        <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
        <link rel="stylesheet" href="<?php echo SERVERURL; ?>css/main.css">
        <link rel="stylesheet" href="<?php echo SERVERURL; ?>css/font-awesome.min.css">
        <link href="https://fonts.googleapis.com/css?family=Quicksand:300,400,500,700" rel="stylesheet">
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
        <!--Import materialize.css-->
        <link type="text/css" rel="stylesheet" href="<?php echo SERVERURL; ?>css/materialize.min.css"  media="screen,projection"/>
    </head>
    <body>
        <header>
            <nav class="ambar">
                <div class="nav-wrapper container">
                    <a href="<?php echo SERVERURL; ?>" class="brand-logo"><i class="fa fa-html5"></i>Codeando HTML</a>
                    <ul id="nav-mobile" class="right hide-on-med-and-down">
                        <li><a href="#">Acerca de</a></li>
                        <li><a href="#">Contacto</a></li>
                        <?php 
                            if(ADMIN){
                                echo ('<li><a href="'.SERVERURL.'src/add-article">Nuevo Artículo</a></li>');
                            }
                        ?>
                        <li>
                    </ul>
                </div>
            </nav>
        </header>
        <br>
        <section class="grid container">
            <!-- Page Layout here -->
            <div class="row">
                <!-- LEFT SIDE -->
                <div class="left-side col s12">
                    <article class="tags">
                        <div class="tag-title">
                            <h2>ETIQUETA: <?php echo $row['nombre']; ?></h2>
                        </div>
                        <div class="separator_0"></div>
                        <?php 
                            //Leer desde la DB el artículo seleccionado
                            //Statement thread
                            $query = "SELECT A.id, A.fecha, A.titulo, SUBSTRING(A.articulo, 1, 100) AS articulo, U.nombre , I.path AS ruta
                                        FROM Articulos A 
                                        LEFT JOIN Usuarios U ON A.idUsuario = U.id 
                                        LEFT JOIN Imagenes I ON A.idImg = I.id
                                        WHERE A.preview = 0 AND A.tags LIKE '%".$row['id'].",%'
                                        ORDER BY A.fecha DESC ";
                            
                            //Statement thread and concatenate LIMIT 
                            $records = $db->query($query);
                            
                            if($records->num_rows && !empty($id)){
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
                                                echo ('<a href="'.SERVERURL.'articulo/'.$v["id"].'/'.str_replace(' ','-',strtolower(formatterTitle($v['titulo']))).'" ><img src="'.SERVERURL.'img/medium/'.$v["ruta"].'"></a>');
                                            echo ('</div>');
                                            echo ('<div class="card-article card-stacked col s9">');
                                                // if(ADMIN){
                                                //     echo ('<a href="'.SERVERURL.'src/edit-article/'.$v["id"].'" class="btn-edit btn btn-floating btn-small red waves-effect"><i class="material-icons">edit</i></a>');
                                                //     echo ('<button id="delete" class="btn-delete btn btn-floating btn-small blue waves-effect"><i class="material-icons">delete</i></button>');
                                                // }
                                                echo ('<div class="card-content">');
                                                    echo ('<h4 class="truncate"><a href="'.SERVERURL.'articulo/'.$v["id"].'/'.str_replace(' ','-',strtolower(formatterTitle($v['titulo']))).'">'.strtoupper($v["titulo"]).'</a></h4>');
                                                    echo ('<div class="row date-badge">');
                                                        echo ('<span class="col new badge valign-wrapper" data-badge-caption="">'.strtoupper(substr($dateFormatte, 0, 6)).'</span>');
                                                        echo ('<span class="col s7 m8 l9"><a href="#">Fabián Muñoz Dev</a></span>');
                                                    echo ('</div>');
                                                    echo ('<hr>');
                                                    echo ('<p class="truncate">'.htmlspecialchars($v["articulo"]).'</p>');
                                                echo ('</div>');
                                            echo ('</div>');
                                        echo ('</div>');
                                    echo ('</div>');
                                    
                                    $last_id = $v['id'];
                                }
                            }else{
                                echo ("<div class='separator_2'></div>");
                                echo ("<div class='no-data'><h4><i>No se encontraron resultados<i/></h4></div>");
                            }
                            
                        ?>
                    <!-- end code -->
                    </article>
                    <!-- End article -->
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
        <script type="text/javascript" src="<?php echo SERVERURL; ?>js/materialize.min.js"></script>
    </body>
</html>