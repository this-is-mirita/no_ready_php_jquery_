<?php
session_start();
require_once __DIR__ . "/../ErrorFiles/error.php";
require_once __DIR__  . '/../Functions/Functions.php';
function registrationUser(){
    try {
        $pdo = getPdo();

        //var_dump($_POST); // Проверить данные из формы
        $username = trim(filter_var($_POST['username'], FILTER_SANITIZE_SPECIAL_CHARS));
        $login = trim(filter_var($_POST['login'], FILTER_SANITIZE_SPECIAL_CHARS));
        $email = trim(filter_var($_POST['email'], FILTER_SANITIZE_SPECIAL_CHARS));
        $password = trim(filter_var($_POST['password'], FILTER_SANITIZE_SPECIAL_CHARS));
        $is_admin = isset($_POST['is_admin']) ? $_POST['is_admin'] : 0;
        $img = trim(filter_var($_POST['linkimg'], FILTER_SANITIZE_SPECIAL_CHARS));

        if(insertRegistrationUser($pdo,$username,$login, $email,$password,$is_admin,$img)){
            // Получаем id пользователя используя функцию для получения id по логину
            $userId = getIdUsers($pdo, $login);
            // Сохраняем данные в сессии
            $_SESSION['user'] = [
                'id' => $userId,
                'username' => $username,
                'login' => $login,
                'email' => $email,
                'is_admin' => $is_admin,
            ];
            var_dump($_SESSION);
            header('Location: ../index.php');
            exit();
        } else {
            echo "Ошибка регистрации.";
        }

    } catch (PDOException $e) {
        echo $e->getMessage();
    }
}
// Вызов функции регистрации
registrationUser();