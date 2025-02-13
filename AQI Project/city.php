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

$units = [
    'pm25' => null,
    'pm10' => null,
    'no2' => null,
];

//Находим единицы измерения для каждого пункта
foreach ($results as $result) {
    if (!empty($units['pm25']) and !empty($units['pm10']) and !empty($units['no2']))
        break;
    if ($result['parameter'] === 'pm25')
        $units['pm25'] = $result['unit'];
    if ($result['parameter'] === 'pm10')
        $units['pm10'] = $result['unit'];
    if ($result['parameter'] === 'no2')
        $units['no2'] = $result['unit'];
}

//Собираем данные ввиде float значений
$stats = [];
$max = 0;
$min = -1000;
foreach ($results as $result) {
    if ($result['parameter'] !== 'pm25' and $result['parameter'] !== 'pm10' and $result['parameter'] !== 'no2')
        continue;
    if ($result['value'] < 0)
        continue;

    $month = substr($result['date']['local'], 0, 7);
    if (!isset($stats[$month])) {
        $stats[$month] = [
            'pm25' => [],
            'pm10' => [],
            'no2' => [],
        ];
    }
    if ($result['value'] > $max) $max = $result['value'];
    if ($result['value'] < $min) $min = $result['value'];
    $stats[$month][$result['parameter']][] = $result['value'];
}

?>

<?php require __DIR__ . '/views/header.inc.php'; ?>
<?php if (empty($city)): ?>
    <p>The city cannot be loaded.</p>
<?php else: ?>
    <?php if (!empty($stats)): ?>
        <canvas id="aqi-chart" style="width: 400px; height: 300px" ;></canvas>
        <script src="scripts/chart.umd.js"></script>
        <script>
            <?php
            $labels = array_keys($stats);
            sort($labels);

            $pm25 = [];
            foreach ($labels as $label) {
                $measurements = $stats[$label];
                if (count($measurements['pm25']) !== 0) {
                    $pm25[] = array_sum($measurements['pm25']) / count($measurements['pm25']);
                } else {
                    $pm25[] = 0;
                }
            }

            $pm10 = [];
            foreach ($labels as $label) {
                $measurements = $stats[$label];
                if (count($measurements['pm10']) !== 0) {
                    $pm10[] = array_sum($measurements['pm10']) / count($measurements['pm10']);
                } else {
                    $pm10[] = 0;
                }
            }

            $no2 = [];
            foreach ($labels as $label) {
                $measurements = $stats[$label];
                if (count($measurements['no2']) !== 0) {
                    $no2[] = array_sum($measurements['no2']) / count($measurements['no2']);
                } else {
                    $no2[] = 0;
                }
            }

            $datasets = [];

            if (array_sum($pm25) > 0) {
                $datasets[] = [
                    'label' => "AQI, PM2.5 in {$units['pm25']}",
                    'data' => $pm25,
                    'fill' => false,
                    'borderColor' => 'rgb(75, 192, 192)',
                    'tension' => 0.1,
                ];
            }
            if (array_sum($pm10) > 0) {
                $datasets[] = [
                    'label' => "AQI, PM10 in {$units['pm10']}",
                    'data' => $pm10,
                    'fill' => false,
                    'borderColor' => 'rgb(192, 89, 75)',
                    'tension' => 0.1,
                ];
            }
            if (array_sum($no2) > 0) {
                $datasets[] = [
                    'label' => "AQI, NO2 in {$units['no2']}",
                    'data' => $no2,
                    'fill' => false,
                    'borderColor' => 'rgb(95, 192, 75)',
                    'tension' => 0.1,
                ];
            }
            ?>
            document.addEventListener('DOMContentLoaded', function () {
                const ctx = document.getElementById('aqi-chart');
                const chart = new Chart(ctx, {
                    type: 'line',
                    data: {
                        labels: <?php echo json_encode($labels); ?>,
                        datasets: <?php echo json_encode($datasets); ?>
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
                    <th>NO2 concentration</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($stats as $month => $measurements): ?>
                    <tr>
                        <th><?php echo e($month); ?></th>
                        <td>
                            <?php if (count($measurements['pm25']) > 0): ?>
                                <?php echo e(round(array_sum($measurements['pm25']) / count($measurements['pm25']), 2)); ?>
                                <?php echo e($units['pm25']); ?>
                            <?php else: ?>
                                <?php echo "No data available"; ?>
                            <?php endif; ?>
                        </td>
                        <td>
                            <?php if (count($measurements['pm10']) > 0): ?>
                                <?php echo e(round(array_sum($measurements['pm10']) / count($measurements['pm10']), 2)); ?>
                                <?php echo e($units['pm10']); ?>
                            <?php else: ?>
                                <?php echo "No data available"; ?>
                            <?php endif; ?>
                        </td>
                        <td>
                            <?php if (count($measurements['no2']) > 0): ?>
                                <?php echo e(round(array_sum($measurements['no2']) / count($measurements['no2']), 2)); ?>
                                <?php echo e($units['no2']); ?>
                            <?php else: ?>
                                <?php echo "No data available"; ?>
                            <?php endif; ?>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php endif; ?>
<?php endif; ?>


<?php require __DIR__ . '/views/footer.inc.php'; ?>