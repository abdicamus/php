<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="./simple.css" />
    <title>Document</title>
</head>

<body>
    <?php
    function e($value)
    {
        return htmlspecialchars($value, ENT_QUOTES, 'UTF-8');
    }

    $pages = [
        'citrus_salmon' => 'Citrus Symphony Salmon',
        'mediterranian_pasta' => 'Mediterranean Marvel Pasta',
        'sunset_risotto' => 'Sunset Risotto',
        'tropical_tacos' => 'Tropical Tango Tacos',
    ];

    $result = "";

    ?>

    <form method="GET" action="index.php">
        <select name="page">
            <option value="">Please select a recipe</option>
            <?php foreach ($pages as $key => $value): ?>
                <option value="<?php echo $key ?>"><?php echo $value ?></option>
                <?php $result = $key; ?>
            <?php endforeach; ?>
        </select>
        <input type="submit" value="Submit!" />
    </form>

    <?php
    echo $result;
    ?>

</body>

</html>