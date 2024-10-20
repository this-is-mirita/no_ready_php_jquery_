<?php
session_start(); // Запускаем сессию

if (isset($_SESSION['user'])) { // Проверка, существует ли пользовательская сессия
    session_unset(); // Удаляет все переменные сессии
    session_destroy(); // Удаляет саму сессию
}
header('Location: ../index.php'); // Перенаправление на главную страницу
exit();
