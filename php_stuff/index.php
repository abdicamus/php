<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DataBase</title>
</head>

<body>

    <?php //include __DIR__ . "/database.php";
    phpinfo();
    die;
    $stmt = $pdo->prepare("SELECT `id`, `title` FROM `notes`");
    $success = $stmt->execute();
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    ?>
    <h3>Выберите элемент для изменения</h3>
    <form method="GET">
        <select style="font-size: 16px;" name="id">
            <?php if ($success): ?>
                <?php foreach ($result as $item): ?>
                    <option value="<?php echo $item['id']; ?>"><?php echo $item['title']; ?></option>
                <?php endforeach; ?>
            <?php endif; ?>
        </select>
        <button type="submit">Выбрать</button>
        <?php if (!empty($_GET['id'])) $id = $_GET['id']; ?>
    </form>

    <form method="GET">
        <input style="font-size: 16px; width: 220px;" type="text" name="title" placeholder="Название нового заголовка"> <br>
        <input style="font-size: 16px; width: 300px;" type="text" name="content" placeholder="Название нового содержимого"> <br>
        <input type="submit" value="start">
    </form>

    <?php
    $title = filter_input(INPUT_GET, 'title');
    $content = filter_input(INPUT_GET, 'content');
    $stmt = $pdo->prepare("UPDATE `notes` SET `title` = :title, `content` = :content WHERE `id` = :id");
    $stmt->bindValue('id', $id);
    $stmt->bindValue('title', $title);
    $stmt->bindValue('content', $content);
    $success1 = $stmt->execute();
    if ($success1) {
        echo "Данные успешно обновлены";
    } else {
        echo "Ошибка";
    }
    ?>

</body>

</html>