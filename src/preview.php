<?php 
    include_once '../libs/Parsedown.php';
    include '../config/conexion.php';
    $db = db_connect();
    
    $query = "SELECT a.titulo, a.fecha, a.articulo, a.tags FROM Articulos a WHERE id = ".$_GET['id'];
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Exportar en el gridview en Yii2</title>
        <!--Let browser know website is optimized for mobile-->
        <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
        <!-- prims Monokai -->
        <link href="../css/prism_monokai.css" rel="stylesheet" />
        <style media="screen">
            .preview-border { border: 1px solid #393939; }
            .preview-article .container { width: 80%; }
        </style>
    </head>
    <body>
        <section class="grid container">
            <!-- Page Layout here -->
            <div class="row">
                <!-- LEFT SIDE -->
                <div class="left-side col s12 preview-border">
                    <article class="">
                        
                        <?php 
                            $parsedown = new Parsedown();
                            // $record = $db->query("SELECT a.titulo, a.fecha, a.articulo, a.tags FROM Articulos a WHERE id = ".$_GET['id']." LIMIT 1");
                            $record = $db->query($query);
                            foreach ($record as $v) {
                                
                                //get date
                                $date = new DateTime($v['fecha']);
                                //format date
                                setlocale(LC_TIME, "es_ES");
                            
                                echo ('<h3 class="title-article">'.$v['titulo'].'</h3>');
                                echo ('<div class="separator_0"></div>');
                                echo ('<div class="author-article">');
                                    echo ('<span><i>publicado</i><b> '.ucwords(strftime("%d %B %G", strtotime($date->format('d-m-Y')))).'</b></span>');
                                    echo ('<div class="chip ">');
                                    echo ('<img class=""src="../img/medium/fabian.png" alt="Contact Person">');
                                        echo ('<a class="" href="#">Por Fabián Muñoz</a>');
                                    echo ('</div>');
                                echo ('</div>');
                                
                                echo $parsedown->text($v['articulo']);
                            }
                        ?>
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
            </div>
        </section>
        <!-- prims -->
        <script src="../js/prism_monokai.js"></script>
    </body>
</html>