<?php

$PATH = "logfiles/";
$files = array_diff(scandir($PATH), array(".", ".."));

?>
<html class="no-js" lang="en">
<head>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>Foundation | Welcome</title>
    <link rel="stylesheet" href="css/foundation.css"/>
    <script src="js/vendor/modernizr.js"></script>
</head>
<body>

<div class="row">
    <div class="large-12 columns text-center">
        <h1>#ShellShock: Live botnet log</h1>
    </div>
</div>

<div class="row large-12 alert-box">
    <dl class="tabs" data-tab>
<?php
$first = false;
foreach ($files as $file):
    $filetr = trim(pathinfo($file)["filename"], '#');
?>
        <dd<?php if (!$first): ?> class="active"<?php endif ?>>
            <a href="#panel_<?=$filetr?>">File: <?=$file?></a>
        </dd>
<?php
    $first = true;
endforeach; ?>
    </dl>
    <div class="tabs-content">
<?php
$first = false;
foreach ($files as $file):
    $filetr = trim(pathinfo($file)["filename"], '#');
?>
        <div class="content<?php if (!$first): ?> active<?php endif ?>" id="panel_<?=$filetr?>">
            <div style="background: #444444; font-family: Consolas; font-size: 11pt" class="small-text-left">
                <?= nl2br(file_get_contents($PATH . $file)) ?>
            </div>
        </div>
<?php
    $first = true;
endforeach; ?>
    </div>
</div>

<script src="js/vendor/jquery.js"></script>
<script src="js/foundation.min.js"></script>
<script>
    function refresh() {
        var id = $(".content.active")[0].id;
        var file = id.replace('panel_', '');
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function () {
            if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                $("#" + id).find('div')[0].innerHTML = xmlhttp.responseText;
            }
        };
        xmlhttp.open("GET", "refresh.php?file=" + file + ".log", true);
        xmlhttp.send();
    }
</script>
<script>
    $(document).foundation();
    window.setInterval(refresh, 60000);
</script>
</body>
</html>
