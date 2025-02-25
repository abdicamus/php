<?php 

$pdo = new PDO("mysql:host=localhost:8889;dbname=note_app", "root", "root", [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
]);

$title = "Title from PHP";
$content = "Content from PHP";

//Читаем данные из таблицы
// $stmt = $pdo->prepare("SELECT * FROM `notes` WHERE `id` = :id");
// $stmt->bindValue('id', $_GET['id']);
// $stmt->execute();

//Добавляем данные в таблицу
// $stmt = $pdo->prepare("INSERT INTO `notes` (`id`, `title`, `content`) VALUES (NULL, :title, :content)");
// $stmt->bindValue('title', $title);
// $stmt->bindValue('content', $content);
// $stmt->execute();
// $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

//Удаляем поля из таблицы
// $stmt = $pdo->prepare("DELETE FROM `notes` WHERE `id` = :id");
// $stmt->bindValue('id', $_GET['id']);о
// $success = $stmt->execute();
// $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

//Обновляем данные из таблицы
// $stmt = $pdo->prepare("UPDATE `notes` SET `title` = :title, `content` = :content WHERE `id` = :id");
// $stmt->bindValue('title', );
// $stmt->bindValue('content', );
// $stmt->bindValue('id', $_GET['id']);


// foreach ($result as $str) {
//     echo '<h3>' . $str['title'] . '</h3>';
//     echo '<p>' . $str['content'] . '</p>';
// }
// if ($success) {
//     echo "Элемент с ID->{$_GET['id']} успешно удален из базы данных.";
// } else {
//     echo "Запрос не выполнен.";
// }