<?php
require __DIR__ . '/inc/functions.inc.php';

$cities = json_decode(
    file_get_contents(__DIR__ . "/data/index.json"),
    true
)

?>

<?php require __DIR__ . '/views/header.inc.php'; ?>

<?php

if (!empty($_GET['city'])) $city = $_GET['city'];

foreach ($cities AS $currentCity) {
    if ($currentCity['city'] === $city) {
        $filename = $currentCity['filename'];
        break;
    }
}

if (!empty($filename)) {
    $data = json_decode(
        file_get_contents('compress.bzip2://' . __DIR__ . '/data/'. $filename),
        true
    );
    var_dump($data);
}

?>

<?php require __DIR__ . '/views/footer.inc.php'; ?>