<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Exportar en el gridview en Yii2</title>
        <link rel="stylesheet" href="../css/main.css">
        <link rel="stylesheet" href="../markdown/css/editormd.css" />
        <link rel="stylesheet" href="../css/markdown.css" />
        <link rel="stylesheet" href="../css/font-awesome.min.css">
        <link href="https://fonts.googleapis.com/css?family=Quicksand" rel="stylesheet">
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
        <!--Import materialize.css-->
        <link type="text/css" rel="stylesheet" href="../css/materialize.min.css"  media="screen,projection"/>
        <!--Let browser know website is optimized for mobile-->
        <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
        <!-- prims Monokai -->
        <!-- <link href="../css/prism_monokai.css" rel="stylesheet" /> -->
        <!-- Default -->
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
        </header>
        <br>
        <section class="grid add-article">
            <!-- Page Layout here -->
            <div class="row container" id="">
                
                
                
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
                            <div id="test-editormd"></div>
                            <div class="separator_1"></div>
                            <div class="button-more">
                                <button id="btnSave" class="waves-effect grey darken-3 btn" type="button" name="button">Guardar</button>
                                <button id="btnPreview" class="waves-effect grey darken-3 btn" type="button" name="button">Preview</button>
                            </div>
                            <div class="separator_0"></div>
                            
                        </form>
                        
                        </div>
                        
                    </div>
                    
                    <!-- LOAD PREVIEW -->
                    <div id="preview-article">
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
        <script type="text/javascript" src="../js/materialize.min.js"></script>
        
        <!-- prims -->
        <!-- <script src="../js/prism_monokai.js"></script> -->
        <!-- Markdown -->
        <script type="text/javascript" src="../markdown/js/editormd.min.js"></script>
        <script src="../markdown/js/languages/en.js"></script>
        
        <script src="../markdown/lib/marked.min.js"></script>
        <script src="../markdown/lib/prettify.min.js"></script>
        
        <script src="../markdown/lib/raphael.min.js"></script>
        <script src="../markdown/lib/underscore.min.js"></script>
        <script src="../markdown/lib/sequence-diagram.min.js"></script>
        <script src="../markdown/lib/flowchart.min.js"></script>
        <script src="../markdown/lib/jquery.flowchart.min.js"></script>
        
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
                
                /*
                // or
                testEditor = editormd({
                    id      : "test-editormd",
                    width   : "90%",
                    height  : 640,
                    path    : "../lib/"
                });
                */
            });
        </script>
        <script type="text/javascript">
            $(document).ready(function(){
                
                $("#btnSave").click(function(){
                    saveArticle(0,"");
                });
                $("#btnPreview").click(function(){
                    
                    // $.get("test.md", function(markdown) {
                    // 
                    //     var testEditormdView;
                    // 
    				//     testEditormdView = editormd.markdownToHTML("preview-article", {
                    //         markdown        : markdown ,//+ "\r\n" + $("#append-test").text(),
                    //         //htmlDecode      : true,       // 开启 HTML 标签解析，为了安全性，默认不开启
                    //         htmlDecode      : "style,script,iframe",  // you can filter tags decode
                    //         //toc             : false,
                    //         tocm            : true,    // Using [TOCM]
                    //         //tocContainer    : "#custom-toc-container", // 自定义 ToC 容器层
                    //         //gfm             : false,
                    //         //tocDropdown     : true,
                    //         // markdownSourceCode : true, // 是否保留 Markdown 源码，即是否删除保存源码的 Textarea 标签
                    //         emoji           : true,
                    //         taskList        : true,
                    //         tex             : true,  // 默认不解析
                    //         // flowChart       : true,  // 默认不解析
                    //         sequenceDiagram : true,  // 默认不解析
                    //     });
                    // 
                    //     //console.log("返回一个 jQuery 实例 =>", testEditormdView);
                    // 
                    //     // 获取Markdown源码
                    //     //console.log(testEditormdView.getMarkdown());
                    // 
                    //     //alert(testEditormdView.getMarkdown());
                    // });
                    
                    var preview_id = $("#preview_id").val();
                    
                    saveArticle(1,preview_id);
                    
                    // $(".preview-article").load("preview.php?id=2");
                    
                });
                
                function saveArticle(preview,id){
                    // console.log(id);
                    var title = $("#titulo").val();
                    var subtitle = $("#subtitulo").val();
                    var content = $(".editormd-markdown-textarea").val();
                    
                    $.ajax({
                        type: 'POST',
                        url: "../php/insert-article.php",
                        data: {"titulo":title,"subtitulo":subtitle,"contenido":content,"id":id,"preview":preview},
                        beforeSend: function(){
                            // Loading.show();
                        },
                        complete: function(){
                            // Loading.hide();
                        },
                        success: function(data){
                            if(data.success){    
                                //Si se retorna el ID, quiere decir que es un preview
                                if(data.id){
                                    console.log(data.id)
                                    // $.get("preview.php?id=" + data.id, function(markdown) {
                                    // 
                                    //     var testEditormdView;
                                    // 
                    				//     testEditormdView = editormd.markdownToHTML("preview-article", {
                                    //         markdown        : markdown ,//+ "\r\n" + $("#append-test").text(),
                                    //         //htmlDecode      : true,       // 开启 HTML 标签解析，为了安全性，默认不开启
                                    //         htmlDecode      : "style,script,iframe",  // you can filter tags decode
                                    //         //toc             : false,
                                    //         tocm            : true,    // Using [TOCM]
                                    //         //tocContainer    : "#custom-toc-container", // 自定义 ToC 容器层
                                    //         //gfm             : false,
                                    //         //tocDropdown     : true,
                                    //         // markdownSourceCode : true, // 是否保留 Markdown 源码，即是否删除保存源码的 Textarea 标签
                                    //         emoji           : true,
                                    //         taskList        : true,
                                    //         tex             : true,  // 默认不解析
                                    //         // flowChart       : true,  // 默认不解析
                                    //         sequenceDiagram : true,  // 默认不解析
                                    //     });
                                    // });
                                    
                                    $("#preview-article").load("preview.php?id=" + data.id );
                                }else{ //De lo contrario sólo redireccionará a la página principal
                                    console.log("TODO OK...")
                                }
                            }
                        }
                    });
                    
                }
                
            });
        </script>
    </body>
</html>