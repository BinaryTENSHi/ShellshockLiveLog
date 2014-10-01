<?php

$PATH = "logfiles/";
$files = array_diff(scandir($PATH), array(".", ".."));

if(!isset($_GET["file"]))
{
    http_response_code(404);
    return;
}

$file = "#" . $_GET["file"];

if(!in_array($file, $files))
{
    http_response_code(404);
    return;
}

echo nl2br(file_get_contents($PATH . $file));