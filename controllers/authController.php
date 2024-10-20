<?php
session_start();
require_once __DIR__ . "/../ErrorFiles/error.php";
require_once __DIR__  . '/../Functions/Functions.php';
function authUser(){

    try {
        $pdo = getPdo();

        $login = trim(filter_var($_POST['login'], FILTER_SANITIZE_SPECIAL_CHARS));
        $password = trim(($_POST['password']));

        $password = password_hash($password, PASSWORD_DEFAULT);
        var_dump($_POST);

        $sql = "SELECT * FROM users WHERE login = ? AND password = ? LIMIT 1";
        $query = $pdo->prepare($sql);
        $query->execute([$login, $password]);


        $userId = getIdUsers($pdo, $login);

        // Сохраняем данные в сессии
        $_SESSION['user'] = [
            'id' => $userId,
            'username' => $login,
        ];

        header('Location: ../index.php');
        exit();
    } catch (PDOException $e) {
        echo $e->getMessage();
    }

}
authUser();