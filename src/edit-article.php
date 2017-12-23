<?php 
    include_once '../config/config.php';
    include_once '../config/conexion.php';
    include_once '../php/funciones.php';
    $db = db_connect();

    $id = $_GET['id'];
    $tipo = (int) $_GET['t']; //593859 = Nuevo, 959395 = Preview
    $articulo = "Articulos";
    
    //validar artículos o artículos preview
    if($tipo === 959395){
        $articulo = "ArticulosPreview";
    }
    
    //Obtener el contenido del artículo
    $query = $db->query("SELECT a.titulo, a.articulo, a.tags, a.idImg FROM ".$articulo." a WHERE id = ".$id);
    $row = mysqli_fetch_assoc($query);
    $articulo = $row['articulo'];
    
    if($query->num_rows == 0){ //Si no existe el registro a editar, se regresa a la página de crear artículo
        header("Location: ".SERVERURL."src/add-article.php", true, 301);
    }
    
    //formatter Tags
    $objectTags = getTagsById($db, $row['tags']);
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Exportar en el gridview en Yii2</title>
        <!--Let browser know website is optimized for mobile-->
        <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
        <!-- Mine Styles -->
        <link rel="stylesheet" href="<?php echo SERVERURL; ?>css/main.css">
        <link rel="stylesheet" href="<?php echo SERVERURL; ?>libs/markdown/css/editormd.css" />
        <link rel="stylesheet" href="<?php echo SERVERURL; ?>css/markdown.css" />
        <link rel="stylesheet" href="<?php echo SERVERURL; ?>css/font-awesome.min.css">
        <!--Import materialize.css-->
        <link rel="stylesheet" href="<?php echo SERVERURL; ?>css/materialize.min.css" media="screen,projection"/>
        <!-- Fonts Google -->
        <link href="https://fonts.googleapis.com/css?family=Quicksand" rel="stylesheet">
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
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
                    </ul>
                </div>
            </nav>
            <!-- <div class="alert-articles ">
                <div class="container">
                    <span>Tienes un artículo pendiente <a href="#">AQUÍ</a>. Favor de terminarlo o cancelarlo <a href="#">AQUÍ</a>.</span>
                </div>
            </div> -->
        </header>
        <br>
        <section class="grid add-article">
            <!-- Page Layout here -->
            <div class="row container">
                <!-- LEFT SIDE -->
                <!-- <div class="left-side col s12  l1">
                    <h4>Markdown</h4>
                </div> -->
                <!-- RIGHT SIDE -->
                <div class="right-side col s12  l12">
                    <div class="row form-wrapper">
                        <form class="col s12">
                            <div class="row">
                                <div class="input-field col s12">
                                    <i class="material-icons prefix">account_circle</i>
                                    <input name="titulo" id="titulo" type="text" class="validate" value="<?php echo $row['titulo']; ?>">
                                    <label for="icon_prefix">Título</label>
                                </div>
                                <!-- <div class="input-field col s12">
                                    <i class="material-icons prefix">phone</i>
                                    <input name="subtitulo" id="subtitulo" type="text" class="validate">
                                    <label for="icon_telephone">Sub Título</label>
                                </div> -->
                            </div>
                            <!-- Tabs -->
                            <h5>Imagen del artículo</h5>
                            <div class="row">
                                <div class="col s12">
                                    <ul class="tabs">
                                        <li class="tab col s3"><a class="active" href="#test1">Selecciona una imagen</a></li>
                                        <li class="tab col s3"><a href="#test2">Subir una imagen</a></li>
                                    </ul>
                                </div>
                                <div id="test1" class="col s12">
                                    <!-- Grid Image Selector -->
                                    <ol id="selectable">
                                        <?php
                                            $record = $db->query("SELECT id, path FROM Imagenes WHERE tipo = 1");
                                            //class="ui-selectee"
                                            foreach ($record as $v) {
                                                if($v['id'] === $row['idImg']){
                                                    echo ('<li class="ui-selectee ui-selected"> <a href="#" > <img id="'.$v['id'].'" src="'.SERVERURL.'img/medium/'.$v['path'].'" alt=""> </a> </li>');    
                                                }else{
                                                    echo ('<li> <a href="#"> <img id="'.$v['id'].'" src="'.SERVERURL.'img/medium/'.$v['path'].'" alt=""> </a> </li>');    
                                                }
                                            }
                                        ?>
                                    </ol>
                                </div>
                                <div id="test2" class="col s12">
                                    <input type="file" name="" value="">
                                </div>
                            </div>
                            <div class="separator_1"></div>
                            <!-- MARKDOWN HERE -->
                            <div id="test-editormd">
                                <textarea style="display:none;"><?php echo $articulo; ?></textarea>
                            </div>
                            <!-- END MARKDOWN -->
                            <!-- TAGS -->
                            <div class="separator_1"></div>
                            <div class="tags">
                                <h5>Ingresa los tags</h5>
                                <div class="chips chips-autocomplete"></div>
                            </div>
                            <!-- END TAGS -->
                            <div class="separator_1"></div>
                            <div class="button-more">
                                <button id="btnSave" class="waves-effect grey darken-3 btn" type="button" name="button">Guardar</button>
                                <button id="btnPreview" class="waves-effect grey darken-3 btn" type="button" name="button">Preview</button>
                            </div>
                            <div class="separator_0"></div>
                            <input id="path_img" type="hidden" name="path_img" value="<?php echo $row['idImg']; ?>">
                        </form>
                    </div>
                        
                </div>
                <div class="loading">
                    <img src="<?php echo SERVERURL; ?>img/big/loading_2.svg" alt="">
                </div>
                    <!-- LOAD PREVIEW -->
                <div id="preview-article"></div>
            </div>
        </section>
        <input type="hidden" name="" id="article_id" value="<?php echo $_GET['id']; ?>">
        <input type="hidden" name="" id="preview_id" value="">
        <input type="hidden" name="" id="save_exit" value="">
        <input type="hidden" name="" id="urlBase" value="<?php echo SERVERURL; ?>">
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
        <!-- <script type="text/javascript" src="https://code.jquery.com/jquery-3.2.1.min.js"></script> -->
        <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
        <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
        <!-- <script type="text/javascript" src="../js/materialize.min.js"></script> -->
        <script src="<?php echo SERVERURL; ?>js/materialize.js"></script>
        <script src="<?php echo SERVERURL; ?>js/material-dialog.min.js" type="text/javascript"></script>
        <script src="<?php echo SERVERURL; ?>libs/markdown/js/editormd.js"></script>
        <script src="<?php echo SERVERURL; ?>libs/markdown/js/languages/en.js"></script>
        <script src="<?php echo SERVERURL; ?>js/codeandohtml.js"></script>
        
        <script type="text/javascript">
            var testEditor;
            
            $(function() {
                testEditor = editormd("test-editormd", {
                    width   : "90%",
                    height  : 640,
                    syncScrolling : "single",
                    path    : "<?php echo SERVERURL; ?>libs/markdown/lib/",
                    htmlDecode      : "style,script,iframe"
                });
            });
        </script>
        <script type="text/javascript">
            $( function() {
                $( "#selectable" ).selectable();
            } );
            $(document).ready(function(){
                //Init Autocomplete
                $('.chips-autocomplete').material_chip();
                
                $(function() {
                    $.ajax({
                        type: 'GET',
                        url: '<?php echo SERVERURL; ?>php/tags.php',
                        success: function(response) {
                            
                            $('.chips-autocomplete').material_chip({
                                // data: [{
                                //   tag: 'Apple',
                                // }, {
                                //   tag: 'Microsoft',
                                // }, {
                                //   tag: 'Google',
                                // }],
                                data: <?php echo $objectTags; ?>,
                                autocompleteOptions: {
                                    data: response,
                                    limit: 2,
                                    minLength: 2
                                }
                            });
                            
                        }
                    });
                });

                //Obtener la img seleccionada
                $("#selectable li a img").click(function(){
                    $("#path_img").val($(this).attr("id"));
                });
                
                $(window).bind('beforeunload', function(){
                    if(($("#titulo").val() != "" || $(".editormd-markdown-textarea").val()) && $("#save_exit").val() != 1 ){
                        return false;
                    }
                }); 
            });
        </script>
    </body>
</html>