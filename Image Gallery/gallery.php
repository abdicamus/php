<?php
include './inc/functions.inc.php';
include './inc/images.inc.php';

?>
<?php include './views/header.php'; ?>

<?php include './views/footer.php'; ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Форма с карточками</title>
    <link rel="stylesheet" href="styles/styles.css">
</head>

<body>
    <div class="container">
        <?php foreach ($imageTitles as $key => $value): ?>
            <a href="image.php?image=<?php echo e($key); ?>">
                <div class="card">
                    <img src="images/<?php echo e($key); ?>" alt="<?php echo e($key); ?>">
                    <p><?php echo e($value) ?></p>
                </div>
            </a>

            <?php if (isset($_GET[$key])): ?>
                <?php $clickedLink = $_GET[$key]; ?>
                <?php header("Location: $clickedLink"); ?>
            <?php endif; ?>
        <?php endforeach; ?>
    </div>
</body>

</html>