<?php
require_once (__DIR__ . "/../../Functions/Functions.php");
require_once (__DIR__ . "/../../ErrorFiles/error.php");
require_once(__DIR__ . "/../../Model/dbConfig.php");
require_once(__DIR__ . "/../FunctionsForAdmin/admin_functions.php");
$pdo = getPDO();

$up_id = $_POST["id_post"];

$profileImage = $_POST["profileImage"];
$imageFileName = 'img/' . $profileImage . '.jpg';  // Преобразуем число в название файла

$followers = trim(filter_var($_POST["followers"], FILTER_SANITIZE_SPECIAL_CHARS));
$description = trim(filter_var($_POST["description"], FILTER_SANITIZE_SPECIAL_CHARS));
$name_tyan = trim(filter_var($_POST["name_tyan"], FILTER_SANITIZE_SPECIAL_CHARS));



updetePost($pdo, $imageFileName, $followers, $description, $name_tyan, "id", $up_id);
header("Location: Posts.php");