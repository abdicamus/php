<?php 
require __DIR__ . "/views/header.view.php";

if (!empty($_GET)) {
    $title = (string) ($_GET['title'] ?? '');
    $date = (string) ($_GET['date'] ?? '');
    $content = (string) ($_GET['content'] ?? '');

    $stmt = $pdo->prepare('INSERT INTO `diary` (`title`, `date` `content`) VALUES (:title, :date, :content)');
    $stmt->bindValue(':title', $title);
    $stmt->bindValue(':date', $date);
    $stmt->bindValue(':content', $content);
    $stmt->execute(); 
}

?>
<div class="nav__layout">
    <a href="index.html" class="nav-brand">
        <svg class="nav-brand__image" viewBox="0 0 24 24">
            <path style="fill: currentColor" d="M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5 2 5.42 4.42 3 7.5 3c1.74 0 3.41.81 4.5 2.09C13.09 3.81 14.76 3 16.5 3 19.58 3 22 5.42 22 8.5c0 3.78-3.4 6.86-8.55 11.54L12 21.35z" />
        </svg>
        PHP Diary
    </a>
</div>
</div>
</nav>
<main class="main">
    <h1 class="main-header">New Entry</h1>
    <form action="GET" action="form.php">
        <div class="container-form">
            <input class="input__title" type="text" placeholder="TITLE:" id="title" name="title" required>
            <input class="input__date" type="date" placeholder="DATE:" id="date" name="date" required>
            <textarea class="input__content" type="text">
            </textarea>
            <button class="form__button" type="submit">Submit</button>
        </div>
    </form>
<?php require __DIR__ . "/views/footer.view.php"; ?>