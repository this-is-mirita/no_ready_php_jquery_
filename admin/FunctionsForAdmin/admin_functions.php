<?php
require_once (__DIR__ . "/../../ErrorFiles/error.php");
require_once(__DIR__ . "/../../Model/dbConfig.php");

function updeteUser($pdo,$login,$username,$email,$password, $is_admin,$linkimg, $paramentr, $where ){
    try {
        // Создание запроса
        $sql = "UPDATE users SET login = ?,username = ?,email = ?,password = ?,is_admin = ?,linkimg = ? WHERE $paramentr = $where";
        $query = $pdo->prepare($sql);
        $query->execute([$login,$username,$email,$password,$is_admin,$linkimg]);
    } catch (PDOException $e) {
        echo $e->getMessage();
    }
}
function updetePost($pdo,$profileImage,$followers,$description,$name_tyan, $paramentr, $where ){
    try {
        // Создание запроса
        $sql = "UPDATE posts SET image = ?,followers = ?,description = ?,name_tyan = ? WHERE $paramentr = $where";
        $query = $pdo->prepare($sql);
        $query->execute([$profileImage,$followers,$description,$name_tyan]);
    } catch (PDOException $e) {
        echo $e->getMessage();
    }
}
function searchPost($pdo,$table, $col_one, $col_two,  $column_search_one, $column_search_two) {
    $sql = "SELECT * FROM `$table` 
            WHERE `$col_one` LIKE ? 
            OR `$col_two` LIKE ? 
            LIMIT 0, 25";

    $query = $pdo->prepare($sql);

    // Добавляем % для поиска по подстроке
    $column_search_one = '%' . $column_search_one . '%';
    $column_search_two = '%' . $column_search_two . '%';

    // Выполняем запрос с подстановкой значений
    $query->execute([$column_search_one, $column_search_two]);

    // Возвращаем результат
    return $query->fetchAll();
//    В вашем SQL запросе с использованием подстановки переменных через ? есть ошибка,
//    так как нельзя напрямую вставлять подстановочные символы (%) внутрь строки.
//    Для этого нужно динамически добавлять символы % в параметры перед их передачей в запрос.
//    •	SQL запрос использует подстановочные параметры ?.
//	•	Входные параметры $description и $name_tyan оборачиваются в % перед передачей в запрос для выполнения поиска по подстроке.
//    •	prepare() и execute() используются для безопасного выполнения запроса с защитой от SQL-инъекций.
//    •	fetch() возвращает первую найденную строку, соответствующую запросу (благодаря LIMIT 1).
}