<?php
require_once(__DIR__ . "/../Model/dbConfig.php");
require_once(__DIR__ . "/../Functions/Functions.php");

$pdo = getPdo();

$res = [
    'users' => count(selectAllOnTable($pdo, "users")),
    'posts' => count(selectAllOnTable($pdo, "posts")),
    'comments' => count(selectAllOnTable($pdo, "comments")),
    'services' => count(selectAllOnTable($pdo, "services")),
    'sliders' => count(selectAllOnTable($pdo, "sliders")),
    'animeServices' => count(selectAllOnTable($pdo, "AnimeServices")),
    'likes' => count(selectAllOnTable($pdo, "likes"))
];
// Установите заголовок, чтобы указать, что это JSON
header('Content-Type: application/json');

// Возвращаем только JSON
echo json_encode($res);
//получать количество записей в каждой таблице и возвращать результат в формате JSON.