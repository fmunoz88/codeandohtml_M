<?php 
    include_once '../config/config.php';
    include_once '../libs/Parsedown.php';
    include_once '../config/conexion.php';
    $db = db_connect();

    $query = "SELECT a.titulo, a.fecha, a.articulo, a.tags FROM ArticulosPreview a WHERE id = ".$_GET['id'];
?>
    <head>
        <!--Let browser know website is optimized for mobile-->
        <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
        <!-- prims Monokai -->
        <link href="<?php echo SERVERURL; ?>css/prism_monokai.css" rel="stylesheet" />
        <link href="https://fonts.googleapis.com/css?family=Quicksand:300,400,500,700" rel="stylesheet">
        <style media="screen">
            .preview-border { border: 1px solid #393939; }
            #preview-article .container { width: 85%; }
        </style>
    </head>
    <body>
        <section class="grid container">
            <!-- Page Layout here -->
            <div class="row">
                <!-- LEFT SIDE -->
                <div class="left-side col s12 preview-border">
                    <article class="articulo">
                        
                        <?php 
                            $parsedown = new Parsedown();
                            
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
                                    echo ('<img class=""src="'.SERVERURL.'img/medium/fabian.png" alt="Contact Person">');
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
        <script src="<?php echo SERVERURL; ?>js/prism_monokai.js"></script>
    </body>