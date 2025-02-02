<?php
require __DIR__ . '/inc/functions.inc.php';

$cities = json_decode(
    file_get_contents(__DIR__ . "/data/index.json"),
    true
)

?>

<?php require __DIR__ . '/views/header.inc.php'; ?>

<ul>
    <?php foreach ($cities as $city): ?>
        <a href="./city.php?<?php echo http_build_query(['city' => e($city['city'])]) ?>">
            <li>
                <?php echo e($city['city']) . ','; ?>
                <?php echo e($city['country']) . ','; ?>
                <?php echo e($city['flag']); ?>
            </li>
        </a>
    <?php endforeach; ?>
</ul>

<a href="http://api.waqi.info/feed/almaty/?token=1320249ac3cde9d189c9e8c56cf889cdd5acf714">AQI</a>

<?php require __DIR__ . '/views/footer.inc.php'; ?> 