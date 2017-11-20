<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Exportar en el gridview en Yii2</title>
        <link rel="stylesheet" href="css/main.css">
        <link rel="stylesheet" href="css/font-awesome.min.css">
        <link href="https://fonts.googleapis.com/css?family=Quicksand" rel="stylesheet">
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
        <!--Import materialize.css-->
        <link type="text/css" rel="stylesheet" href="css/materialize.min.css"  media="screen,projection"/>
        <!--Let browser know website is optimized for mobile-->
        <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
        <!-- prims Monokai -->
        <link href="css/prism_monokai.css" rel="stylesheet" />
    </head>
    <body>
        <header>
            <nav class="ambar">
                <div class="nav-wrapper container">
                    <a href="index.php" class="brand-logo"><i class="fa fa-html5"></i>Codeando HTML</a>
                    <ul id="nav-mobile" class="right hide-on-med-and-down">
                        <!-- <li><a href="sass.html">Sass</a></li> -->
                        <li><a href="badges.html">Acerca de</a></li>
                        <li><a href="collapsible.html">Contacto</a></li>
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
                        <!-- Title Article -->
                        <h3 class="title-article">Exportar en el gridview en Yii2</h3>
                        <!-- Sub-title article -->
                        <h4 class="subtitle-article">Utilizando Kartik plugins</h5>
                        <div class="separator_0"></div>
                        <!-- Author article -->
                        <div class="author-article">
                            <div class="chip ">
                                <img class=""src="img/medium/fabian.png" alt="Contact Person">
                                <a class="" href="#">Por Fabián Muñoz</a>
                            </div>
                        </div>
                        <!-- Begin Article -->
                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
                        
                        <div class="separator_0"></div>
                        
                        <!-- windows bar  -->
                        <div class="top-bar">
                            <div class="circles">
                                <div id="close-circle" class="circle"></div>
                                <div id="minimize-circle" class="circle"></div>
                                <div id="maximize-circle" class="circle"></div>
                                <div class="lang-code right">PHP</div>
                            </div>
                        </div>
                        <pre class="line-numbers"><code class="language-php">&lt;?php require_once 'Zend/Uri/Http.php';

    namespace Location\Web;

    interface Factory {
        static function _factory();
    }

    abstract class URI extends BaseURI implements Factory {
        abstract function test();

        public static $st1 = 1;
        const ME = "Yo";
        var $list = NULL;
        private $var;

        /**
         * Returns a URI
         *
         * @return URI
         */
        static public function _factory($stats = array(), $uri = 'http') {
            echo __METHOD__;
            $uri = explode(':', $uri, 0b10);
            $schemeSpecific = isset($uri[1]) ? $uri[1] : '';
            $desc = 'Multi line description';

            // Security check
            if (!ctype_alnum($scheme)) {
                throw new Zend_Uri_Exception('Illegal scheme');
            }

            $this->var = 0 - self::$st;
            $this->list = list(Array("1"=> 2, 2=>self::ME, 3 => \Location\Web\URI::class));

            return [
                'uri'   => $uri,
                'value' => null,
            ];
        }
    }

    echo URI::ME . URI::$st1;

    __halt_compiler ();

?&gt;</code></pre>
                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
                    <div class="separator_0"></div>
                    <div class="top-bar">
                        <div class="circles">
                            <div id="close-circle" class="circle"></div>
                            <div id="minimize-circle" class="circle"></div>
                            <div id="maximize-circle" class="circle"></div>
                            <div class="lang-code right">HTML</div>
                        </div>
                    </div>
                    <pre class="line-numbers"><code class="language-markup">&lt;!DOCTYPE html&gt;
&lt;html&gt;
    &lt;head&gt;
        &lt;meta charset="utf-8"&gt;
        &lt;title&gt;&lt;/title&gt;
    &lt;/head&gt;
    &lt;body&gt;
        
    &lt;/body&gt;
&lt;/html&gt;</code></pre>   
                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
                    <!-- end code -->
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
                <!-- RIGHT SIDE -->
                <div class="right-side col s12  l3">
                    <!-- Most Viewer -->
                    <div class="most-viewer row">
                        <div class="col s12 ">
                            <h5 class="">Lo más visto</h5>
                            <div class="collection">
                                <a href="#!" class="truncate collection-item" title="Curso Framework Yii 2 con Bootstrap"><img src="img/medium/php.png"><span class="truncate">Curso Framework Yii 2 con Bootstrap</span></a>
                                <a href="#!" class="truncate collection-item" title="Sentencias MySQL"><img src="img/medium/mysql.png"><span class="truncate">Sentencias MySQL</span></a>
                                <a href="#!" class="truncate collection-item" title="Angular + React JS"><img src="img/medium/angular.png"><span class="truncate">Angular + React JS</span></a>
                                <a href="#!" class="truncate collection-item" title="Curso FrameworkDirectorios con Python"><img src="img/medium/python.png"><span class="truncate">Directorios con Python</span></a>
                                <a href="#!" class="truncate collection-item" title="Curso HTML5 + CSS3"><img src="img/medium/html_css.png"><span class="truncate">Curso HTML5 + CSS3</span></a>
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
            <p> Desarrollado por Fabián Muñoz &copy;</p>
        </footer>
        <!--Import jQuery before materialize.js-->
        <script type="text/javascript" src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
        <script type="text/javascript" src="js/materialize.min.js"></script>
        <!-- prims -->
        <script src="js/prism_monokai.js"></script>
    </body>
</html>