<?php
require_once __DIR__ . "/../Model/dbConfig.php";
require_once __DIR__ . "/../ErrorFiles/error.php";
require_once __DIR__ . "/../Functions/Functions.php";
try {
    session_start();

    $pdo = getPdo();
    $card_id = $_GET['id'];
    deleteAllOnTableWhere($pdo, "likes", "id", $card_id);
    header("location: ../pages/like.php");
} catch (Exception $e) {
    echo $e->getMessage();
}