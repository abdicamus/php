<?php
include './inc/functions.inc.php';
include './inc/images.inc.php';

?>
<?php include './views/header.php'; ?>


<?php include './views/footer.php'; ?>

<?php foreach ($imageDescriptions as $key => $value): ?>
    <?php if (isset($_GET['image']) && $key == $_GET['image']): ?>
        <img src="images/<?php echo e($key); ?>" alt="<?php echo e($key); ?>">
        <p> <?php echo e($value); ?> </p>
    <?php endif; ?>
<?php endforeach; ?>
<a href="">Go back</a>