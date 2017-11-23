<?php 
    include_once '../libs/Parsedown.php';
    include '../config/conexion.php';
    $db = db_connect();
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
            .preview-border {
                border: 1px solid #393939;
            }
            
            .preview-article .container {width: 80%; }
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
                            $record = $db->query("SELECT * FROM Articulos WHERE id = ".$_GET['id']." LIMIT 1");
                            
                            foreach ($record as $v) {
                                // echo "<pre>"; var_dump("->",$v);
                                echo ('<h3 class="title-article">'.$v['titulo'].'</h3>');
                                echo ('<h4 class="subtitle-article">'.$v['subTitulo'].'</h4>');
                                echo ('<div class="separator_0"></div>');
                                echo ('<div class="author-article">');
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
                        <a class="hover_1" href="#">Yii 2 Framework</a>
                        <a class="hover_1" href="#">Bootstrap</a>
                        <a class="hover_1" href="#">CSS 3</a>
                        <a class="hover_1" href="#">HTML 5</a>
                        <a class="hover_1" href="#">Kartik</a>
                        <a class="hover_1" href="#">MySQL</a>
                    </div>
                </div>
            </div>
        </section>
        <input type="hidden" name="" id="preview_id" value="<?php echo $_GET['id']; ?>">
        <!-- prims -->
        <script src="../js/prism_monokai.js"></script>
        
    </body>
</html>