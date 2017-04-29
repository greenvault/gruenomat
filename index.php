<?php
$uri_parts = explode('?', $_SERVER['REQUEST_URI'], 2);
$baseurl = "http://" . $_SERVER['SERVER_NAME'] . $uri_parts[0];
?>
<!DOCTYPE html>
<html>
  <head>
    <title>Green-o-mat</title>
    <meta http-equiv="content-type" content="text/html; charset=UTF-8" />
    <meta content="Green-o-mat">
    
    <meta name="image_src" content="img/gruene-logo.jpg"/>
    <meta name="description" content="Mit dem Green-o-mat kann die eigene Position in Verhältnis zu den GRÜNEN getestet werden."/>
    
    <meta property="og:title" content="Mahlowat"/>
    <meta property="og:type"  content="website"/>
    <meta property="og:image" content="img/gruene-logo.jpg"/>
    <meta property="og:url"   content=""/>
    <meta property="og:site-name" content="example.com"/>
    <meta property="og:description" content="Mit dem Green-o-mat kann die eigene Position in Verhältnis zu den GRÜNEN getestet werden."/>
    
    <link href="css/bootstrap.min.css" rel="stylesheet" media="screen">
    <link rel="stylesheet" href="css/font-awesome.min.css">
    
    <link rel="stylesheet" type="text/css" href="css/style.css">
    
    <link href="shariff/shariff.min.css" rel="stylesheet">
    
    <script src="js/jquery-2.0.2.min.js"></script>
    
  </head>
  <body>
  
  <div class="container mow-container" style="margin-top:20px;">
  
  <div class="text-center">
  
    <img src="img/gruene-logo.jpg" title="GRÜNE Logo" />
    
    <h1><small>Der</small> Green-o-mat</h1>
  </div>
    <p>Mit dem Green-o-mat könnt Ihr überprüfen, wie gut die GRÜNEN zu Euch oder Ihr zu den GRÜNEN passt.</p>
    
    <p class="text-center"><a class="btn btn-large btn-primary" href="mahlowat.php" title="Mahlowat starten">Mit der Befragung beginnen!</a></p>
    
    <p class="text-center"><a href="faq.php" title="Fragen und Antworten"><small>FAQ</small></a></p>
    
    
    <div class="shariff" data-url="<?php echo $baseurl; ?>" data-referrer-track=null></div>
    <script src="shariff/shariff.min.js"></script>
  </div>
  
  </body>
</html>
