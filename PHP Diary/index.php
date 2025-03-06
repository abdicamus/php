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
    <?php include __DIR__ . "/config.php"; ?>
    <!-- -->
    <?php
    $dir = opendir(__DIR__ . '/images');
    $currentFile = readdir($dir);
    while (($currentFile = readdir($dir)) !== false) {
        if ($currentFile === '.' || $currentFile === '..') continue;
        $images[] = $currentFile;
    }
    ?>
    <nav class="nav">
        <div class="container">
            <div class="nav__layout">
                <a href="index.html" class="nav-brand">
                    <svg class="nav-brand__image" viewBox="0 0 24 24">
                        <path style="fill: currentColor" d="M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5 2 5.42 4.42 3 7.5 3c1.74 0 3.41.81 4.5 2.09C13.09 3.81 14.76 3 16.5 3 19.58 3 22 5.42 22 8.5c0 3.78-3.4 6.86-8.55 11.54L12 21.35z" />
                    </svg>
                    PHP Diary
                </a>
                <a href="form.html" class="button">
                    <svg class="button_icon" viewBox="0 0 44.4901230052 44.4901230053">
                        <g style="fill: none;stroke: #f3f4f5;stroke-linecap: round;stroke-linejoin: round;stroke-width: 2px;">
                            <circle cx="22.2450615026" cy="22.2450615026" r="21.2450615026" />
                            <line x1="22.2450615026" y1="13.4699274037" x2="22.2450615026" y2="31.0201956015" />
                            <line x1="31.0201956015" y1="22.2450658041" x2="13.4699274037" y2="22.2450572011" />
                        </g>
                    </svg>
                    New Entry
                </a>
            </div>
        </div>
    </nav>
    <main class="main">
        <div class="container">
            <h1 class="main-header">Entries</h1>
            <?php $counter = 0;
            foreach ($result as $item): ?>
                <div class="card">
                    <div class="card__image-container">
                        <img class="card__image" src="<?php echo __DIR__ . '/images/' . e($images[$counter]); ?>" alt="">
                    </div>
                    <div class="card__desc-container">
                        <div class="card__desc-time">Неделя 1</div>
                        <h3 class="card__header"><?php echo e($item['title']); ?></h3>
                        <p class="card__paragraph"><?php echo e($item['content']); ?></p>
                    </div>
                </div>
            <?php $counter++;
            endforeach; ?>
            <ul class="pagination">
                <li class="pagination__li">
                    <a class="pagination__link pagination__link--arrow" href="#">⏴</a>
                </li>
                <li class="pagination__li">
                    <a class="pagination__link pagination__link--active" href="#">1</a>
                </li>
                <li class="pagination__li">
                    <a class="pagination__link" href="#">2</a>
                </li>
                <li class="pagination__li">
                    <a class="pagination__link" href="#">3</a>
                </li>
                <li class="pagination__li">
                    <a class="pagination__link" href="#">4</a>
                </li>
                <li class="pagination__li">
                    <a class="pagination__link pagination__link--arrow" href="#">⏵</a>
                </li>
            </ul>
        </div>
    </main>
    <footer class="footer">
        <div class="container">
            <h3 class="footer__header-container">PHP Diary проект</h3>
            <p class="footer__paragraph-container">Этот проект дневника PHP позволяет пользователям<br> систематически документировать и размышлять о своем<br> учебном пути, повышая удержание и предоставляя ценную<br> информацию о своем личностном росте и развитии.</p>
        </div>
    </footer>
</body>

</html>