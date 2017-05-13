<?php
include 'includes/functions.php';
include 'includes/elements.php';
//include 'includes/theses.php';

$data_content = file_get_contents("config/data.json");
if (!$data_content) {
    echo "ERROR READING CONFIG";
} else {
    $data = json_decode($data_content, true);

    if ($data == NULL) {
        echo "ERROR PARSING CONFIG";
    }

    $css = Array();
    $css[0] = "bootstrap.min.css";
    $css[1] = "cerulean.min.css";
    $css[2] = "cosmo.min.css";
    $css[3] = "cyborg.min.css";
    $css[4] = "darkly.min.css";
    $css[5] = "flatly.min.css";
    $css[6] = "journal.min.css";
    $css[7] = "lumen.min.css";
    $css[8] = "paper.min.css";
    $css[9] = "readable.min.css";
    $css[10] = "sandstone.min.css";
    $css[11] = "simplex.min.css";
    $css[12] = "slate.min.css";
    $css[13] = "spacelab.min.css";
    $css[14] = "superhero.min.css";
    $css[15] = "united.min.css";
    $css[16] = "yeti.min.css";
    $css_id = 9;
    if (isset($_GET['css'])) {
        $css_id = intval($_GET['css']);
        if ($css_id < 0 || $css_id > 16) {
            $css_id = 0;
        }
    }

    //$theses = get_theses_array();
    $theses = $data['theses'];

    $theses_count = sizeof($theses);

    $ans = Array();
    $emph = Array();
    $answerstring = '';
    $warning = false;
    $count = 'undefined';

    if (isset($_POST['count'])) {
        $count = $_POST['count'];
    }

    if (isset($_POST['ans'])) {
        $answerstring = $_POST['ans'];
        $retval = result_from_string($answerstring, $theses_count);
        $ans = $retval[0];
        $emph = $retval[1];
    } elseif (isset($_GET['ans'])) {
        $answerstring = $_GET['ans'];
        $retval = result_from_string($answerstring, $theses_count);
        $ans = $retval[0];
        $emph = $retval[1];
    } else {
        $warning = true;
        for ($i = 0; $i < $theses_count; $i++) {
            $ans[$i] = 'skip';
            $emph[$i] = 1;
        }
    }
}


?>
<!DOCTYPE html>
<html>
<head>
    <title>Green-o-mat</title>
    <meta http-equiv="content-type" content="text/html; charset=UTF-8"/>
    <meta content="Green-o-mat">
    <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no"/>
    <!--<link href="css/bootstrap.min.css" rel="stylesheet" media="screen">-->
    <link href="css/<?php echo $css[$css_id]; ?>" rel="stylesheet" media="screen">

    <link rel="stylesheet" type="text/css" href="css/style.css">
</head>
<body>
<script src="js/jquery-2.0.2.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/mahlowat.js"></script>

<div id="savemodal" class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog"
     aria-labelledby="mySmallModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span
                            class="sr-only">Close</span></button>
                <h4 class="modal-title" id="myModalLabel">Statistik</h4>
            </div>
            <div class="modal-body">
                Erlaubst du, dass dein Aufruf für die Statistik gezählt wird?<br>
                Falls du Nein auswählst, bist du lediglich als Logeintrag auf dem Server verewigt.<br>
                <small><a href="faq.php#log" target="_blank">Ich will aber gar keinen Logeintrag!</a></small>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" onclick="callResult(false)" style="width: 100px;"><span
                            class="glyphicon glyphicon-remove"></span> Nein
                </button>
                <button type="button" class="btn btn-primary" onclick="callResult(true)" style="width: 100px;"><span
                            class="glyphicon glyphicon-ok"></span> Ja
                </button>
            </div>
        </div>
    </div>
</div>

<div class="container" style="margin-top: 20px;">
    <img src="img/sonnenblume.png" title="GRÜNEN Logo Sonneblume" class="pull-right" onclick="changeText('green-o-mat')"
         style="height: 125px"/>
    <p id="spruch" class="pull-right"></p>
    <div class="bottom-buffer top-buffer">

        <?php print_pagination($theses_count); ?>

        <?php print_thesesbox($theses); ?>

        <p class='text-center'>
            <button id="weight" type="button" class="btn btn-default" data-toggle="button">These doppelt gewichten
            </button>
        </p>

        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12 option">
                <button id='yes' type='submit' class='btn btn-default btn-block' name='yes' onclick="nextThesis('a')">
                    <span id="option1">Zustimmung</span></button>
            </div>
        </div>
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12 option">
                <button id='neutral' type='submit' class='btn btn-default btn-block' name='neutral'
                        onclick="nextThesis('b')"><span id="option2">Neutral</span></button>
            </div>
        </div>
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12 option">
                <button id='no' type='submit' class='btn btn-default btn-block' name='no' onclick="nextThesis('c')">
                    <span id="option3">Nein</span></button>
            </div>
        </div>

        <p class="text-center">
            <button id='skip' type='submit' class='btn btn-default' name='skip' onclick="nextThesis('d')"><span
                        class="glyphicon glyphicon-share-alt"></span> Überspringen
            </button>
        </p>


        <div class="text-right">
            <hr/>
            <small>Du kannst die Befragung
                <a href="index.php" title="Von vorn beginnen">neu starten</a>
                oder den Rest der Thesen
                <a href="#" title="Auswertung anzeigen" onclick="gotoResultPage(resultArray)">überspringen</a>.<br/>
                Außerdem haben wir auch eine <a href="faq.php?from=mahlowat.php"
                                                onclick="gotoFAQPage(event, resultArray)" title="FAQ">FAQ-Seite</a>.
            </small>

        </div>
    </div>
</div>
<script type="text/javascript">
    "use strict";
    var resultArray;
    var activeThesis = 0;
    var answerstring = '<?php echo $answerstring; ?>';
    var theses = <?php echo json_encode($theses); ?>;
    var pagination = $('#navigation').find('li');
    var thesesboxes = $('.singlethesis');

    $(function () {
        $('.tt').tooltip();
        $('.explic').hide();
        var $weight = $('#weight');
        $weight.click(function () {
            $weight.toggleClass('btn-default');
            $weight.toggleClass('btn-info');
            if ($weight.text() === 'These doppelt gewichten') {
                $weight.text('These wird doppelt gewichtet');
            } else {
                $weight.text('These doppelt gewichten');
            }
        });
        $('.explanationbutton').click(function (event) {
            event.preventDefault();
            $('.explic').toggle(200);
        });

        resultArray = resultStringToArray(answerstring, thesesboxes.length);

        setPaginationColors(resultArray);

        // Remove the # from the hash, as different browsers may or may not include it
        var hash = location.hash.replace('#', '');

        if (hash !== '' && jQuery.isNumeric(hash)) {
            // Show the hash if it's set
            loadThesis(hash);
        } else {
            loadThesis(activeThesis + 1);
        }

    });

    function gotoResultPage(result) {
        var count = '<?php echo $count; ?>';
        if (count !== 'true' && count !== 'false') {
            $('#savemodal').modal('show');
        } else if (count === 'true') {
            callResult(true);
        } else {
            callResult(false);
        }
    }

    function gotoFAQPage(evt, result) {
        callPage(evt, 'faq.php?from=mahlowat.php' + window.location.hash, array2str(result), '<?php echo $count; ?>');
    }

    function callResult(count) {
        var ans = array2str(resultArray);
        if (count) {
            var url = "count.php?ans=" + ans;
            jQuery.get(url, function (data) {
                callPage(null, 'result.php', ans, 'true');
            });
        } else {
            jQuery.get("count.php?false", function (data) {
                callPage(null, 'result.php', ans, 'false');
            });
        }
    }

    function nextThesis(selection) {
        var multiply = $('#weight').hasClass('active');
        resultArray[activeThesis] = result2letter(selection, multiply);
        pagination.eq(activeThesis).removeClass('pagination-yes pagination-neutral pagination-no');
        pagination.eq(activeThesis).addClass(letter2paginationclass(selection));
        if (activeThesis + 1 < thesesboxes.length) {
            loadThesis(activeThesis + 2);
        } else {
            // call result page
            gotoResultPage(resultArray);
        }
    }

    function loadThesis(number) {
        if (number > thesesboxes.length) {
            number = 1;
        }
        activeThesis = number - 1;
        thesesboxes.hide();
        pagination.removeClass('active');

        setClasses(resultArray[activeThesis]);
        setButtons(theses[activeThesis].a);

        thesesboxes.eq(number - 1).show();
        pagination.eq(number - 1).addClass('active');
        location.hash = number;

    }

    function letter2paginationclass(letter) {
        switch (letter) {
            case 'a':
            case 'e':
                return 'pagination-yes';
                break;
            case 'b':
            case 'f':
                return 'pagination-neutral';
                break;
            case 'c':
            case 'g':
                return 'pagination-no';
                break;
            case 'd':
            case 'h':
                return '';
                break;
        }
    }

    function setButtons(answers) {
        var answersArray = answers.split("\n");
        $('#option1').text(answersArray[0]);
        $('#option2').text(answersArray[1]);
        $('#option3').text(answersArray[2]);
    }

    function setClasses(code) {
        $('.explic').hide();
        var $weight = $('#weight');
        if (code < 'e') {
            $weight.removeClass('btn-info');
            $weight.addClass('btn-default');
            $weight.removeClass('active');
            $weight.text('These doppelt gewichten');
        } else {
            $weight.addClass('btn-info');
            $weight.removeClass('btn-default');
            $weight.addClass('active');
            $weight.text('These wird doppelt gewichtet');
        }
        var $yes = $('#yes');
        var $neutral = $('#neutral');
        var $no = $('#no');
        switch (code) {
            case 'a':
            case 'e':
                $yes.addClass('btn-success');
                $yes.removeClass('btn-default');
                $neutral.addClass('btn-default');
                $neutral.removeClass('btn-warning');
                $no.addClass('btn-default');
                $no.removeClass('btn-danger');
                break;
            case 'b':
            case 'f':
                $yes.addClass('btn-default');
                $yes.removeClass('btn-success');
                $neutral.addClass('btn-warning');
                $neutral.removeClass('btn-default');
                $no.addClass('btn-default');
                $no.removeClass('btn-danger');
                break;
            case 'c':
            case 'g':
                $yes.addClass('btn-default');
                $yes.removeClass('btn-success');
                $neutral.addClass('btn-default');
                $neutral.removeClass('btn-warning');
                $no.addClass('btn-danger');
                $no.removeClass('btn-default');
                break;
            case 'd':
            case 'h':
                $yes.addClass('btn-default');
                $yes.removeClass('btn-success');
                $neutral.addClass('btn-default');
                $neutral.removeClass('btn-warning');
                $no.addClass('btn-default');
                $no.removeClass('btn-danger');
                break;
        }
    }


    function setPaginationColors(array) {
        for (var i = 0; i < array.length; i++) {
            pagination.eq(i).addClass(letter2paginationclass(array[i]));
        }
    }


</script>
</body>
</html>
