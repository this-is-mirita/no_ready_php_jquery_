<?php
    session_start();
    require_once __DIR__ . "/../ErrorFiles/error.php";
    require_once __DIR__ . "/../Functions/Functions.php";
    try {
        $pdo = getPdo();
        $card_id = isset($_GET["id"]) ? $_GET["id"] : "";

        // Используем новую функцию
        likePost($pdo, $card_id, $_SESSION['user']['id']);
        header("Location: ../index.php");
    } catch (PDOException $e) {
        echo $e->getMessage();
    }
?>
