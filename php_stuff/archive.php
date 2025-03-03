<?php

$zip = new ZipArchive();
$filename = 'archive.zip';

// $numFiles = $zip->count();

if ($zip->open($filename) === true) {
    for ($i = 0; $i < $zip->numFiles; $i++) {
        echo $zip->getNameIndex($i) . '<br>';
    }
} else {
    echo 'Ошибка при открытий архива';
}