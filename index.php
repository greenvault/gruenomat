<?php
$uri_parts = explode('?', $_SERVER['REQUEST_URI'], 2);
$baseurl = "http://" . $_SERVER['SERVER_NAME'] . $uri_parts[0];
?>
<!DOCTYPE html>
<html>
<head>
    <title>Green-o-mat</title>
    <meta http-equiv="content-type" content="text/html; charset=UTF-8"/>
    <meta content="Green-o-mat">

    <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no"/>
    
    <meta name="image_src" content="img/gruene-logo.jpg"/>
    <meta name="description"
          content="Mit dem Green-o-mat kann die eigene Position in Verhältnis zu den GRÜNEN getestet werden."/>

    <meta property="og:title" content="Mahlowat"/>
    <meta property="og:type" content="website"/>
    <meta property="og:image" content="img/sonnenblume.png"/>
    <meta property="og:url" content=""/>
    <meta property="og:site-name" content="example.com"/>
    <meta property="og:description"
          content="Mit dem Green-o-mat kann die eigene Position in Verhältnis zu den GRÜNEN getestet werden."/>

    <link href="css/bootstrap.min.css" rel="stylesheet" media="screen">
    <link rel="stylesheet" href="css/font-awesome.min.css">

    <link rel="stylesheet" type="text/css" href="css/style.css">

    <link href="shariff/shariff.min.css" rel="stylesheet">

    <script src="js/jquery-2.0.2.min.js"></script>

</head>
<body>

<div class="container mow-container" style="margin-top:20px;">

    <div class="text-center">

        <img src="img/sonnenblume.png" title="GRÜNE Logo" style="height: 125px"/>

        <h1>
            Green-O-Mat
        </h1>
    </div>
    <p style="text-align:center;">Finde in zehn Fragen heraus, wie gut die GRÜNEN zu dir und wie gut du zu den GRÜNEN passt.</p> <br><br/>

    <p class="text-center"><a class="btn btn-large btn-primary" href="mahlowat.php" title="Green-o-mat starten">Lass uns starten!</a></p> <br/>

    <p class="text-center"><a href="faq.php" title="Fragen und Antworten">
            <small>FAQ</small>
        </a></p>


    <div class="shariff" data-url="<?php echo $baseurl; ?>" data-referrer-track=null></div>
    <script src="shariff/shariff.min.js"></script>
</div>

</body>
</html>
