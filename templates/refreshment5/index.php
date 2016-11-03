<!DOCTYPE html>
<html>
    <head>
        <link href='http://fonts.googleapis.com/css?family=Open+Sans:400,600' rel=
              'stylesheet' type='text/css'>
        <link href="main.css" rel="stylesheet" type="text/css">

        <title>PAGETITLE</title>
        <script src="http://code.jquery.com/jquery-1.11.1.min.js" type=
        "text/javascript"></script>
        <meta content="text/html; charset=utf-8" http-equiv="Content-Type">
        <meta charset="utf-8">
        <meta content="width=device-width; initial-scale=1.0; maximum-scale=1.0;"
              name="viewport">
        <script type="text/javascript">
            $(document).ready(function () {
                $('#menu_opener').click(function () {
                    $('#mainMenu').show('slow');
                });
                $('#wrapper').click(function () {
                    if ($('#mainMenu').is(":visible")) {
                        $('#mainMenu').hide('slow');
                    }
                });
                $('#mainMenu').click(function () {
                    if ($('#mainMenu').is(":visible")) {
                        $('#mainMenu').hide('slow');
                    }
                });
                $('.img_box').hover(
                        function () {
                            $(this).animate({'width': '110%', 'marginLeft': '-5%', 'opacity': '.7'}, 200);
                        }
                ,
                        function () {
                            $(this).animate({'width': '100%', 'marginLeft': '0', 'opacity': '1'}, 200);
                        }
                );
            });
        </script>
    </head>

    <body>
        <a class="arrow-up" href="#top"></a>

        <!-- Seitennavigation -->

        <div class="container" id="main_nav">
            <a id="home" href="[{$PAGEROOT}]">
                <img src="img/logo_black.png" alt="home">
            </a>
        </a>
        <a class="clearfix" href="#" id="menu_opener" name="top">&#9776;
            Menu</a><br style="clear:both">

        <ul id="mainMenu">
            <li>
                <a href="[{$PAGEROOT}]" id="lnk_home" title=
                   "Zurück zur Startseite">Startseite</a>
            </li>

            <li>
                <a href="[{$PAGEROOT}]blog" id="lnk_blog" title=
                   "Weblog über Musikproduktion. Filme. Deejaying. Kunst und Kultur">
                    blog</a>
            </li>

            <li>
                <a href="[{$PAGEROOT}]music" id="lnk_music" title=
                   "MP3-Dateien, Fasttracker II-Dateien, Impulse Tracker, Hardstyle, Trance, Dubstep">
                    music</a>
            </li>

            <li>
                <a href="[{$PAGEROOT}]page/cms/Tutorials/index" id="lnk_tut"
                   title=
                   "Tutorials. Wie wird man Musikproduzent? Wie wird man ein richtig guter Deejay?">
                    tutorials</a>
            </li>

            <li>
                <a href="[{$PAGEROOT}]page/cms/personal/Ueber+mich" title=
                   "Alles über mich. Marcel Schindler aka DJ Marc Shake">Über
                    mich</a>
            </li>

            <li>
                <form action="[{$PAGEROOT}]search/" class="suche" method="get">
                    <fieldset>
                        <legend>Suche</legend> <input class="textfeld" name="q"
                                                      placeholder="Suche..." type="text"> <input name="go"
                                                      type="submit" value="go">
                    </fieldset>
                </form>
            </li>

            <li>
                <form action="[{$PAGEROOT}]profile/login" method="post">
                    <fieldset>
                        <legend>Login</legend> <input class="textfeld" name=
                                                      "uname" placeholder="Username" type="text">
                        <input class="textfeld" name="upass" placeholder=
                               "Password" type="password"> <input class="txtfield"
                               name="login" type="submit" value="login">
                    </fieldset>
                </form>
            </li>
        </ul>
    </div>

    <div class="container clearfix" id="wrapper">
        <!-- END of Header -->

        <div class="teaser_blocks">
            <!-- Repeat 4 Times //-->
            <div class="tease">
                <h2>Post</h2>
                <div class="img_box">
                    <img src="http://img.youtube.com/vi/iN6Wc-9r3l4/maxresdefault.jpg" alt="Bild">
                </div>
            </div>
            <!-- END of Repeat //-->

        </div>



        <div class="postlist clearfix">
            <!-- Per Blog Entry //-->
            <div class="entry_content">
                <article>
                    <header>
                        <h2>Content Headline</h2>Written by <a href=
                                                               "author">Author</a>
                    </header>

                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.
                        Proin eget dictum nisi. Sed nec tincidunt leo. Quisque quam
                        tortor, scelerisque ut justo sed, fermentum imperdiet diam.
                        Vestibulum ante ipsum primis in faucibus orci luctus et
                        ultrices posuere cubilia Curae; Duis accumsan tempor ipsum, non
                        iaculis arcu sagittis vitae. Suspendisse potenti. Nunc sit amet
                        justo eu ante congue blandit. Maecenas lobortis sit amet neque
                        a placerat. Suspendisse tincidunt, purus eget tincidunt
                        porttitor, neque augue placerat velit, nec gravida leo orci at
                        sem. Vestibulum luctus purus augue, vitae porta ex porttitor
                        in. Sed accumsan, sem a ultrices lobortis, massa tellus
                        scelerisque erat, eu feugiat tellus velit in risus. Aliquam sed
                        rhoncus sapien. In volutpat placerat ornare.</p>
                    <p>
                        <img src="http://cdn.trancefish.de/gommel_godstime.jpg" alt="Bild">
                    </p>

                    <p>Nulla sit amet risus cursus, sagittis arcu vel, pharetra
                        turpis. Suspendisse porttitor, urna quis varius egestas, felis
                        erat facilisis lacus, et fermentum nulla ipsum vel nisl. Ut sit
                        amet augue et nisi ornare malesuada. Cras sodales vel elit at
                        iaculis. Morbi fermentum ligula pharetra consequat
                        sollicitudin. Sed sed laoreet lectus, vel consectetur odio.
                        Vestibulum rutrum at ipsum vel imperdiet. Duis gravida
                        hendrerit porta. Vestibulum ac venenatis urna. Nam eu porttitor
                        erat, semper consequat justo.</p>

                    <p>Cras volutpat id mi sit amet lacinia. Etiam ac ultricies
                        lectus, id facilisis nulla. Aenean accumsan nisl quis maximus
                        facilisis. Nulla aliquet eget dui sed vestibulum. Ut
                        pellentesque quam a gravida vehicula. Phasellus eget quam quis
                        tellus fringilla ultricies. Aliquam efficitur nisi ut justo
                        ornare aliquet. Mauris luctus nisl non erat ultrices, ut
                        blandit sapien egestas. Phasellus cursus mauris vitae sagittis
                        cursus. Pellentesque ut tortor convallis, vulputate justo vel,
                        eleifend justo. Donec a quam pharetra, semper massa eget,
                        varius nisl.</p>

                    <p>Etiam porttitor, nibh ut tempor finibus, sapien urna
                        tristique arcu, nec convallis mi odio a risus. Lorem ipsum
                        dolor sit amet, consectetur adipiscing elit. Vestibulum non
                        pharetra ex. Donec neque erat, volutpat at posuere in, molestie
                        ut velit. Morbi tincidunt lorem augue, a cursus tellus pretium
                        finibus. Phasellus vel erat nec lacus rutrum venenatis. Nam
                        odio lorem, lobortis at tellus non, tristique consequat metus.
                        Maecenas sed lectus eu mauris ullamcorper finibus nec eget
                        nunc. Vestibulum ante ipsum primis in faucibus orci luctus et
                        ultrices posuere cubilia Curae; Morbi dapibus mi varius, semper
                        diam eu, tempor ex. Nullam blandit eros ultricies purus pretium
                        efficitur. Cras posuere leo at euismod accumsan. Pellentesque
                        in pretium sem.</p>

                    <p>Praesent at metus suscipit, blandit justo ut, malesuada
                        arcu. Ut vel nulla sed ante lobortis sollicitudin. Cras sit
                        amet viverra est, et sagittis orci. In hac habitasse platea
                        dictumst. Phasellus commodo arcu sed dolor porta auctor. Nulla
                        tellus ipsum, porta vel libero sit amet, mattis volutpat
                        turpis. Morbi eget nisl convallis, bibendum ante non, aliquam
                        odio. Sed porta vehicula est eget efficitur. Praesent at augue
                        rutrum, semper diam nec, accumsan neque. Proin malesuada neque
                        eu lacus interdum, et mattis sem congue. Suspendisse ipsum
                        felis, ullamcorper eu dui quis, posuere feugiat tortor.</p>

                    <div class="tags">
                        <a href="shhshs">Schalala</a>
                    </div>
                </article>
            </div>
            <!-- END of Blogentry //-->

        </div>
        <!-- Hallo. This block is context. This is the search, the stuff, the icons and so on -->

        <div id="context">
            <div class="social_networks">
                <h3>Verlinke diese Seite</h3>

                <ul class="icons">
                    <li>
                        <a href="#"><img alt="Digg" src="icons/digg.png"></a>
                    </li>

                    <li>
                        <a href="#"><img alt="Dribbble" src=
                                         "icons/dribbble.png"></a>
                    </li>

                    <li>
                        <a href="#"><img alt="Email" src="icons/email.png"></a>
                    </li>

                    <li>
                        <a href="#"><img alt="Facebook" src=
                                         "icons/facebook.png"></a>
                    </li>

                    <li>
                        <a href="#"><img alt="G+" src=
                                         "icons/googleplus.png"></a>
                    </li>

                    <li>
                        <a href="#"><img alt="LinkedIn" src=
                                         "icons/linkedin.png"></a>
                    </li>

                    <li>
                        <a href="#"><img alt="Pinterest" src=
                                         "icons/pinterest.png"></a>
                    </li>

                    <li>
                        <a href="#"><img alt="RSS-Feed" src=
                                         "icons/rss.png"></a>
                    </li>

                    <li>
                        <a href="#"><img alt="Tumblr" src=
                                         "icons/tumblr.png"></a>
                    </li>

                    <li>
                        <a href="#"><img alt="Twitter" src=
                                         "icons/twitter.png"></a>
                    </li>
                </ul>
            </div>
        </div>




    </div>

    <div id="main_footer">
        © Marcel Schindler
    </div>
</body>
</html>
