<?php
function getPdo(){
    static $pdo = null;
    $host = "localhost";
    $user = "root";
    $pass = "mirita";
    $database = "mini-dataBase";

    if($pdo == null){
        try {
            $pdo = new PDO("mysql:host=$host;dbname=$database", $user, $pass);
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            die('Ошибка подключения к базе данных: ' . $e->getMessage());
        }
    }
    return $pdo;
}
