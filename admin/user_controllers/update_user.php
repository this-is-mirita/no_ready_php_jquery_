<?php
require_once (__DIR__ . "/../../Functions/Functions.php");
require_once (__DIR__ . "/../../ErrorFiles/error.php");
require_once(__DIR__ . "/../../Model/dbConfig.php");
require_once(__DIR__ . "/../FunctionsForAdmin/admin_functions.php");
$pdo = getPDO();

$up_id = $_POST["id_user"];
$login = trim(filter_var($_POST["login"], FILTER_SANITIZE_SPECIAL_CHARS));
$username = trim(filter_var($_POST["username"], FILTER_SANITIZE_SPECIAL_CHARS));
$email = trim(filter_var($_POST["email"], FILTER_SANITIZE_SPECIAL_CHARS));
$password = trim(filter_var($_POST["password"], FILTER_SANITIZE_SPECIAL_CHARS));
$is_admin = trim(filter_var($_POST["is_admin"], FILTER_SANITIZE_SPECIAL_CHARS));

$profileImage = $_POST["profileImage"];
$imageFileName = $profileImage . '.jpg';  // Преобразуем число в название файла

$password = password_hash($password, PASSWORD_DEFAULT);

updeteUser($pdo,$login,$username,$email,$password, $is_admin,$imageFileName, "id", $up_id);
echo json_encode(["status" => "success"]);


