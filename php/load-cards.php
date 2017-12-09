<?php
    include_once "../config/conexion.php";
    $db = db_connect();
    
    //Cargar mediante AJAX los artículos
    $last_id = $_POST["last_id"];
    // echo "<pre>"; var_dump("->",$last_id); die();
    
    $showLimit = 5; //Cantidad de cargar
    $count = 0;
    
    
    $records = $db->query("SELECT A.id, A.fecha, A.titulo, A.articulo, U.nombre , I.path AS ruta
                            FROM Articulos A 
                            LEFT JOIN Usuarios U ON A.idUsuario = U.id 
                            LEFT JOIN Imagenes I ON A.idImg = I.id
                            WHERE A.id < $last_id
                            ORDER BY A.fecha DESC LIMIT ".$showLimit);
    
    foreach ($records as $v){
        $count++;
        // var_dump($v["id"]); 
        
        //formatter date
        $date = new DateTime($v['fecha']);
        //format date
        setlocale(LC_TIME, "es_ES");
        $dateFormatte = ucwords(strftime("%d %B %G", strtotime($date->format('d-m-Y'))));
        
        echo ('<div class="card-data col s12">');
            echo ('<div class="card hoverable horizontal">');
                echo ('<div class="card-image img-header">');
                    echo ('<a href="article.php?id='.$v["id"].'" ><img src="img/medium/'.$v["ruta"].'"></a>');
                echo ('</div>');
                echo ('<div class="card-article card-stacked col s9">');
                    echo ('<div class="card-content">');
                        echo ('<h4 class="truncate"><a href="article.php?id='.$v["id"].'">'.strtoupper($v["id"] .' '. $v["titulo"]).'</a></h4>');
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
        
        $last_id = $v['id'];
        
    }
    
    if($count >= 5){
        echo ('<div class="button-more clearfix">');
            echo ('<a id="'.$last_id.'" onclick="loadMoreCard('.$last_id.')" class="waves-effect grey darken-3 btn btn-more-cards">Mostrar Más</a>');
        echo ('</div>');
    }
    // else{
    //     echo ('<div style="text-align:center; margin-top: 30px;"><span style="color:white;"><i>No hay más artículos</i></span>');
    // }
    
?>