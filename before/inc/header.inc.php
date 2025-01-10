<!DOCTYPE html>
<?php $pageKey = 'mission'?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./styles/simple.css" />
    <link rel="stylesheet" href="./styles/custom.css" />
    <title>Culinary Cove &bull;
        <?php if (isset($pageTitle)) {
            echo $pageTitle;
        } else {
            echo "Default title";
        }?>
    </title>
</head>
<body>
  <header class="header-with-background" style="background-image: url('<?php if (isset($headerImg)) {
      echo $headerImg;
  } else {
      echo "pexels-rachel-claire-4577740.jpg";
  }
  ?>'); ">

    <h1>Culinary Cove</h1>
    <p>Your sanctuary for exceptional flavors</p>
    <nav>
        <?php if ($pageKey === 'mission'): ?>
            <a class="active;" href="our-mission.php">Our mission</a>
        <?php elseif($pageKey === 'ingredients'): ?>
            <a class="active;" href="ingredients.php">Ingredients</a>
        <?php else: ?>
            <a class="active;" href="menu.php">Menu</a>
        <?php endif; ?>
    </nav>
  </header>

  <main>