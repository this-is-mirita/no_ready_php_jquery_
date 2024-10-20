<?php
session_start();
//echo "<pre>";
//print_r($_SESSION);
//echo "</pre>";
//база
$page = isset($_GET['page']) ? (int)$_GET['page'] : 0;
require_once __DIR__ . '/Model/dbConfig.php';
$pdo = getPdo();
//ошибки
require_once __DIR__ . '/ErrorFiles/error.php';
//все функции
require_once __DIR__ . '/Functions/Functions.php';
//шляпа
require_once __DIR__ . '/templates/header.php';
// foto
require_once __DIR__ . '/templates/prew.php';
//пагинация
require_once __DIR__ . '/templates/cardPaginations.php';
// слайдер
require_once __DIR__ . '/templates/slider.php';
//4 мини каточки
require_once __DIR__ . '/templates/services.php';

require_once __DIR__ . '/templates/prewfooter.php';

require_once __DIR__ . '/templates/footer.php';
?>