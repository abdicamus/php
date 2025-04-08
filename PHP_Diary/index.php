<?php 
require __DIR__ . "/views/header.view.php"; 
require __DIR__ . "/inc/config.php";

$perPage = 5;
$page = (int) ($_GET['page'] ?? 1);

$offset = ($page - 1) * $perPage;

$stmt = $pdo->prepare("SELECT * FROM `diary` ORDER BY `date` ASC LIMIT :limit OFFSET :offset");
$stmt->bindValue(':limit', $perPage, PDO::PARAM_INT);
$stmt->bindValue(':offset', $offset, PDO::PARAM_INT);
$stmt->execute();
$result = $stmt->fetchAll(PDO::FETCH_ASSOC);

?>
            <div class="nav__layout">
                <a href="index.html" class="nav-brand">
                    <svg class="nav-brand__image" viewBox="0 0 24 24">
                        <path style="fill: currentColor" d="M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5 2 5.42 4.42 3 7.5 3c1.74 0 3.41.81 4.5 2.09C13.09 3.81 14.76 3 16.5 3 19.58 3 22 5.42 22 8.5c0 3.78-3.4 6.86-8.55 11.54L12 21.35z" />
                    </svg>
                    PHP Diary
                </a>
                <a href="form.php" class="button">
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
                <?php if ($counter === count($result) - 1) $counter = 0; ?>
                <div class="card">
                    <div class="card__image-container">
                        <img class="card__image" src="<?php echo 'images/' . e($images[$counter]); ?>" alt="Изображение <?php echo $counter; ?>">
                    </div>
                    <div class="card__desc-container">
                        <div class="card__desc-time"><?php echo e($item['date']); ?></div>
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
<?php require __DIR__ . "/views/footer.view.php"; ?>