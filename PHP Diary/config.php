<?php

function e($value) {
    return htmlspecialchars($value, ENT_QUOTES, 'UTF-8');
}

$pdo = new PDO("mysql:host=localhost:8889;dbname=php_diary", "root", "root", [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
]);

$stmt = $pdo->prepare("SELECT * FROM `diary`");
$stmt->execute();
$result = $stmt->fetchAll(PDO::FETCH_ASSOC);

// foreach ($result as $item) {
//     echo "<p>" . $item['title'] . "</p><br>";
//     echo "<p>" . $item['content'] . "</p>";
// }