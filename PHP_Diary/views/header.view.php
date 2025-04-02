<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="./styles/normalize.css">
    <link rel="stylesheet" type="text/css" href="./styles/styles.css">
    <title>PHP Diary</title>
</head>

<body>
    <!-- Подключение к файлу с базами данных -->
    <?php require __DIR__ . "/../inc/config.php"; ?>
    <!-- -->
    <?php
    $dir = opendir(__DIR__ . '/../images');
    $currentFile = readdir($dir);
    while (($currentFile = readdir($dir)) !== false) {
        if ($currentFile === '.' || $currentFile === '..') continue;
        $images[] = $currentFile;
    }
    ?>
    <nav class="nav">
        <div class="container">