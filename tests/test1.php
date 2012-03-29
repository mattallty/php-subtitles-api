<?php
require("../php-subtitles.php");
$sub = new PHP_Subtitles();
$foo = $sub->driver('tvsubtitles');

var_dump($foo);
?>