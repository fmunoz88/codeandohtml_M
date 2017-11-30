<?php 
    include_once('../config/conexion.php');
    $db = db_connect();
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Exportar en el gridview en Yii2</title>
        <!--Let browser know website is optimized for mobile-->
        <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
        <!-- Mine Styles -->
        <link rel="stylesheet" href="../css/main.css">
        <link rel="stylesheet" href="../markdown/css/editormd.css" />
        <link rel="stylesheet" href="../css/markdown.css" />
        <link rel="stylesheet" href="../css/font-awesome.min.css">
        <!-- Fonts Google -->
        <link href="https://fonts.googleapis.com/css?family=Quicksand" rel="stylesheet">
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
        <!--Import materialize.css-->
        <link rel="stylesheet" href="../css/materialize.min.css" media="screen,projection"/>
    </head>
    <body>
        <header>
            <nav class="ambar">
                <div class="nav-wrapper container">
                    <a href="../index.php" class="brand-logo"><i class="fa fa-html5"></i>Codeando HTML</a>
                    <ul id="nav-mobile" class="right hide-on-med-and-down">
                        <!-- <li><a href="sass.html">Sass</a></li> -->
                        <li><a href="badges.html">Acerca de</a></li>
                        <li><a href="collapsible.html">Contacto</a></li>
                    </ul>
                </div>
            </nav>
            <div class="alert-articles ">
                <div class="container">
                    <span>Tienes un artículo pendiente <a href="#">AQUÍ</a>. Favor de terminarlo o cancelarlo <a href="#">AQUÍ</a>.</span>
                </div>
            </div>
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
                        <form method="post" action="../inc/insert-article.php" class="col s12">
                            <div class="row">
                                <div class="input-field col s12">
                                    <i class="material-icons prefix">account_circle</i>
                                    <input name="titulo" id="titulo" type="text" class="validate">
                                    <label for="icon_prefix">Título</label>
                                </div>
                                <div class="input-field col s12">
                                    <i class="material-icons prefix">phone</i>
                                    <input name="subtitulo" id="subtitulo" type="text" class="validate">
                                    <label for="icon_telephone">Sub Título</label>
                                </div>
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
                                            
                                            foreach ($record as $v) {
                                                echo ('<li> <a href="#"> <img id="'.$v['id'].'" src="../img/medium/'.$v['path'].'" alt=""> </a> </li>');    
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
                            <div id="test-editormd"></div>
                            <!-- END MARKDOWN -->
                            <div class="separator_1"></div>
                            <div class="button-more">
                                <button id="btnSave" class="waves-effect grey darken-3 btn" type="button" name="button">Guardar</button>
                                <button id="btnPreview" class="waves-effect grey darken-3 btn" type="button" name="button">Preview</button>
                            </div>
                            <div class="separator_0"></div>
                            <input id="path_img" type="hidden" name="path_img" value="">
                        </form>
                        
                    </div>
                        
                </div>
                <div class="loading">
                    <img src="../img/big/loading_2.svg" alt="">
                </div>
                    <!-- LOAD PREVIEW -->
                <div id="preview-article"></div>
            </div>
        </section>
        <input type="hidden" name="" id="preview_id" value="<?php echo $_GET['id']; ?>">
        <input type="hidden" name="" id="save_exit" value="">
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
        <script type="text/javascript" src="../js/materialize.min.js"></script>
        <script src="../js/material-dialog.min.js" type="text/javascript"></script>
        <script type="text/javascript" src="../markdown/js/editormd.min.js"></script>
        <script src="../markdown/js/languages/en.js"></script>
        
        <script type="text/javascript">
            var testEditor;
            
            $(function() {
                testEditor = editormd("test-editormd", {
                    width   : "90%",
                    height  : 640,
                    syncScrolling : "single",
                    path    : "../markdown/lib/",
                    // emoji : true
                });
            });
        </script>
        <script type="text/javascript">
            $( function() {
                $( "#selectable" ).selectable();
            } );
            $(document).ready(function(){
                
                // $('ul.tabs').tabs();
                
                //Obtener la img seleccionada
                $("#selectable li a img").click(function(){
                    $("#path_img").val($(this).attr("id"));
                    // console.log($(this).attr("id"));
                });
                
                $("#btnSave").click(function(){
                
                    var title = $("#titulo").val();
                    var content = $(".editormd-markdown-textarea").val();
                
                    if(validate(title, content)){
                        MaterialDialog.dialog("¿Desea publicar este artículo? <br> - Quedará pendiente de revisón por un Administrador.", {
                    		title:"Confirmación",
                    		modalType:"modal", // Can be empty, modal-fixed-footer or bottom-sheet
                    		buttons:{
                    			// Use by default close and confirm buttons
                    			close:{
                    				className:"red",
                    				text:"Cerrar",
                    				callback:function(){
                    					// alert("closed!");
                    				}
                    			},
                    			confirm:{
                    				className:"blue",
                    				text:"Publicar",
                    				modalClose:true,
                    				callback:function(){
                                        $("#save_exit").val(1);
                                        saveArticle(0,$("#preview_id").val());
                    				}
                    			}
                    		}
                    	});
                    }
                
                });
                
                $("#btnPreview").click(function(){
                    var preview_id = $("#preview_id").val();
                    saveArticle(1,preview_id);
                });
                
                function saveArticle(preview,id){
                    
                    var title = $("#titulo").val();
                    var subtitle = $("#subtitulo").val();
                    var content = $(".editormd-markdown-textarea").val();
                    var id_img = $("#path_img").val();
                    
                    if(validate(title, content, id_img)){
                        $.ajax({
                            type: 'POST',
                            url: "../php/insert-article.php",
                            data: {"titulo":title,"subtitulo":subtitle,"contenido":content,"id":id,"preview":preview,"id_img":id_img},
                            beforeSend: function(){
                                $(".loading").slideDown(400);
                                $("#preview-article").slideUp(400);
                            },
                            complete: function(){
                                $(".loading").slideUp(400);
                                $("#preview-article").slideDown(400);
                            },
                            success: function(data){
                                if(data.success){
                                    //Si se retorna el ID y el valor preview == 1, quiere decir que es un preview
                                    if(data.id && data.preview == 1){
                                        console.log(data.id)
                                        $("#preview-article").load("preview.php?id=" + data.id );
                                        $("#preview_id").val(data.id);
                                    }else{ //De lo contrario sólo redireccionará a la página principal
                                        console.log("TODO OK...");
                                        $(location).attr('href','../index.php');
                                    }
                                }else{
                                    console.log(data.message)
                                }
                            }
                        });    
                    }
                    
                }
                
                //Función que valida los campos vación al guardar o preview el artículo
                function validate(title, content, img){
                    var text = "";
                    if(title == ""){
                        text += "- <b>Título no puede estar vacío.</b>";
                    }
                    if(img == ""){
                        text += "<br>- <b>Debe seleccionar una imagen.</b>";
                    }
                    if(content == ""){
                        text += "<br>- <b>Se tiene que agregar un contenido al artículo.</b>";
                    }
                    if(text != ""){
                        MaterialDialog.alert( text, {
                    		title:'Validando datos', // Modal title
                    		buttons:{ // Receive buttons (Alert only use close buttons)
                    			close:{
                    				text:'Cerrar', //Text of close button
                    				className:'red', // Class of the close button
                    				callback:function(){ }// Function for modal click
                    			}
                    		}
                    	});
                        return false;
                    }else{
                        console.log("VALIDACIÓN BIEN");
                        return true;
                    }
                }

                $(window).bind('beforeunload', function(){
                    if(($("#titulo").val() != "" || $(".editormd-markdown-textarea").val()) && $("#save_exit").val() != 1 ){
                        return false;
                    }
                }); 
            });
        </script>
    </body>
</html>