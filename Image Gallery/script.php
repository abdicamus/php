<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <pre>
    <?php 
    $images = [];
    $handle = opendir(__DIR__ . '/images'); 
    var_dump(pathinfo('gallery.php', PATHINFO_FILENAME));
    die();
    $currentFile = readdir($handle);
    while (($currentFile = readdir($handle)) !== false) {
        if ($currentFile === '.' || $currentFile === '..') continue;
        $images[] = $currentFile;
    }
    ?>
    </pre>
    <?php foreach ($images as $image): ?>
        <img src="<?php echo 'images/' . $image?>" alt="" width="200px">
    <?php endforeach; ?>
</body>
</html>