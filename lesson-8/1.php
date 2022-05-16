<?php
$dir = new RecursiveDirectoryIterator("./");
$rdir = new RecursiveIteratorIterator($dir, true);

foreach ($rdir as $item) {
    echo str_repeat("___", $rdir->getDepth()) . $item . "<br>";
}