<?php
require __DIR__ . '/inc/functions.inc.php';

$cities = json_decode(
    file_get_contents(__DIR__ . "/data/index.json"),
    true
)

    ?>

<?php

if (!empty($_GET['city']))
    $city = $_GET['city'];

foreach ($cities as $currentCity) {
    if ($currentCity['city'] === $city) {
        $filename = $currentCity['filename'];
        break;
    }
}

if (!empty($filename)) {
    $results = json_decode(
        file_get_contents('compress.bzip2://' . __DIR__ . '/data/' . $filename),
        true
    )['results'];
}
// print_r($results);

$units = [
    'pm25' => null,
    'pm10' => null,
];

foreach ($results as $result) {
    if (!empty($units['pm25']) && !empty($units['pm10']))
        break;
    if ($result['parameter'] === 'pm25')
        $units['pm25'] = $result['unit'];
    if ($result['parameter'] === 'pm10')
        $units['pm10'] = $result['unit'];
}

$stats = [];
foreach ($results as $result) {
    if ($result['parameter'] !== 'pm25' and $result['parameter'] !== 'pm10')
        continue;
    if ($result['value'] < 0)
        continue;

    $month = substr($result['date']['local'], 0, 7);
    if (!isset($stats[$month])) {
        $stats[$month] = [
            'pm25' => [],
            'pm10' => [],
        ];
    }
    $stats[$month][$result['parameter']][] = $result['value'];
}

?>

<?php require __DIR__ . '/views/header.inc.php'; ?>
<?php if (empty($city)): ?>
    <p>The city cannot be loaded.</p>
<?php else: ?>
    <?php if (!empty($stats)): ?>
        <canvas id="aqi-chart" style="width: 300px; height: 200px" ;></canvas>
        <script src="scripts/chart.umd.js"></script>
        <script>
            document.addEventListener('DOMContentLoaded', function () {
                const ctx = document.getElementById('aqi-chart');
                const chart = new Chart(ctx, {
                    type: 'line',
                    data: {
                        labels: [
                            <?php foreach ($stats as $month => $measurements): ?>
                                <?php echo e($month).','; ?>
                            <?php endforeach; ?>
                        ],
                        datasets: [{
                            label: 'PM 2.5 Concentration',
                            data: [
                                <?php foreach ($stats as $month => $measurements): ?>
                                    <?php echo round(array_sum($measurements['pm25']) / count($measurements['pm25'])).','; ?>
                                <?php endforeach; ?>
                            ],
                            fill: false,
                            borderColor: 'rgb(75, 192, 192)',
                            tension: 0.1
                        }, {
                            label: 'PM 10 Concentration',
                            data: [
                                <?php foreach ($stats as $month => $measurements): ?>
                                    <?php echo round(array_sum($measurements['pm10']) / count($measurements['pm10'])).','; ?>
                                <?php endforeach; ?>
                            ],
                            fill: false,
                            borderColor: 'rgb(192, 89, 75)',
                            tension: 0.1
                        }],
                    }
                });
            });
        </script>
        <table>
            <thead>
                <h1><?php echo $_GET['city']; ?></h1>
                <tr>
                    <th>Month</th>
                    <th>PM 2.5 concentration</th>
                    <th>PM 10 concentration</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($stats as $month => $measurements): ?>
                    <tr>
                        <th><?php echo e($month); ?></th>
                        <td>
                            <?php echo e(round(array_sum($measurements['pm25']) / count($measurements['pm25'])), 2); ?>
                            <?php echo e($units['pm25']) ?>
                        </td>
                        <td>
                            <?php echo e(round(array_sum($measurements['pm10']) / count($measurements['pm10'])), 2); ?>
                            <?php echo e($units['pm10']) ?>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php endif; ?>
<?php endif; ?>


<?php require __DIR__ . '/views/footer.inc.php'; ?>