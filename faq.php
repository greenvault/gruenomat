<?php 
	isset($_GET['from']) ? $back = $_GET['from'] : $back = "index.php";
	if($back != 'index.php' and substr($back, 0, 14) != 'multiplier.php' and substr($back, 0, 10) != 'result.php' and substr($back, 0, 12) != 'mahlowat.php'){
		$back = "index.php";
	}
	
	$answerstring = '';
	if(isset($_POST['ans'])){
		$answerstring = $_POST['ans'];
	}
	
	$count = 'undefined';
	if(isset($_POST['count'])){
		$count = $_POST['count'];
	}
    
?>
<!DOCTYPE html>
<html>
  <head>
    <title>Green-o-mat - FAQ</title>
    <meta http-equiv="content-type" content="text/html; charset=UTF-8" />
    <meta content="">
    <link href="css/bootstrap.min.css" rel="stylesheet" media="screen">
    
    <link rel="stylesheet" type="text/css" href="css/style.css">
  </head>
  <body>
  
  <script src="js/jquery-2.0.2.min.js"></script>
  <script src="js/bootstrap.min.js"></script>
  <script src="js/mahlowat.js"></script>
  
  <div class="container" style="margin-top: 20px;">
      <img src="img/gruene-logo.jpg" title="GRÜNEN Logo" class="pull-right" onclick="changeText()" style="height: 125px" />
	<p id="spruch" class="pull-right"></p>
      <div class="bottom-buffer top-buffer">
    
    <h1>FAQ</h1>

    <h4>Wer macht den Green-o-mat?</h4>
    <p>Motivierte Menschen der GRÜNEN.</p>
    
    <h4>Wer hat die Thesen erarbeitet?</h4>
    <p>Eine Arbeitsgruppe auf dem 5. Camp Netzbegrünung der GRÜNEN.</p>
    
    <h4>Von welcher Wahl reden wir hier überhaupt?</h4>
    <p>Bundestagswahl 2017</p>
    
    <h4>Wer hat das hier programmiert?</h4>
    <p>Der <a href="http://jim.2martens.de" title="jim.2martens.de" target="_blank">Jim</a>, weil der das kann.</p>
    
    <h4>Funktioniert das hier wie der "echte" Wahl-O-Mat der bpb?</h4>
    <p>Nein.</p>
    
    <h4>Wie werden die Punkte berechnet?</h4>
    <p>Die Antworten der Testperson (das bist du) werden mit den vorgegebenen Antworten der GRÜNEN abgeglichen.</p>
    <ul>
      <li>Stimmt die Antwort überein, werden den GRÜNEN 2 Punkte gutgeschrieben;</li>
      <li>Weicht die Antwort leicht ab (Zustimmung/Neutral oder Neutral/Ablehnung), wird den GRÜNEN 1 Punkt gutgeschrieben;</li>
      <li>Sind die Antworten entgegengesetzt, gibt es keine Punkte für die Gruppe.</li>
    </ul>
    <p>Eine Frage, die die Testperson übersprungen hat, wird nicht gewertet. Entsprechend gibt es dann insgesamt weniger Punkte zu erreichen.</p>
    <p>Eine Frage, die doppelt gewichtet werden soll, wird doppelt gewichtet, das heißt, für sie wird die doppelte Punktzahl gutgeschrieben (0/2/4). Entsprechend gibt es insgesamt mehr Punkte zu erreichen.</p>
    
    <div id='log'>
    <h4>Werden meine Antworten gespeichert?</h4>
    <p>Vor der Auswertung wirst du gefragt, ob wir deine Antworten speichern dürfen.<br>
    Du kannst dann "Ja" auswählen, was bedeutet, dass wir deine Antwortkombination zusammen mit einer ID speichern, die aus deiner IP-Adresse und einem täglich wechselnden zufälligen Wert errechnet wird. Bereits am nächsten Tag kann dein Eintrag auf keinen Fall mehr einer konkreten IP-Adresse zugeordnet werden.<br>
    Wenn du "Nein" auswählst, wird lediglich ein Zähler um 1 erhöht.</p>
    <p></p>
    
    <h4>Ich möchte gar nicht gezählt werden!</h4>
    <p>Unser Webserver legt bei jedem Seitenaufruf einen Log-Eintrag an, der unter anderem einen Zeitstempel, deine IP-Adresse und die aufgerufene URL enthält. Es wäre also unaufrichtig, dir vorzumachen, dass dein Aufruf des Mahlowat nicht gezählt wird. Der Mahlowat wurde jedoch so konzipiert, dass aus den Server-Logdateien nicht ersichtlich ist, welche Antworten du ausgewählt hast. Dies sehen wir tatsächlich nur, wenn du dem am Ende explizit zustimmst.</p>
    </div>
    
    <h4>Ich habe einen Fehler gefunden!</h4>
    <p>Dann solltest du das melden. Wir freuen uns über sachdienliche Hinweise.</p>

    <a class="btn btn-primary" href="<?php echo $back; ?>" onclick="callPage(event, '<?php echo $back; ?>')" title="Zurück zum Mahlowat">Zurück zum Green-o-mat</a>
  </div>
  </div>


  <script type="text/javascript">
	$( document ).ready( function(){
		if(window.location.hash == '#log'){
			setTimeout(function() {
				$('#log').css("background-color","#ffff55");
			}, 1000);
		}
	} );
  
      function callPage(evt, action){
		evt.preventDefault();
		var html = "<input name='ans' value='<?php echo $answerstring;?>'/><input name='count' value='<?php echo $count; ?>'/>";
		$('<form style="display: none;" method="post"/>').attr('action', action).html(html).appendTo('body').submit();
	}
  </script>

  
  </body>
</html>
