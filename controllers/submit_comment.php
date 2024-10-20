<?php
session_start();
require_once __DIR__ . "/../ErrorFiles/error.php";
require_once __DIR__  . '/../Functions/Functions.php';

$pdo = getPdo();
$id = $_POST['id_tyan'];
$name = trim(filter_var($_POST["name"], FILTER_SANITIZE_STRING));
$comment = trim(filter_var($_POST["comment"], FILTER_SANITIZE_SPECIAL_CHARS));
insertcommentOnPost($pdo,"comments",$name, $comment, $id, $_SESSION['user']['id']);
header("Location: ../templates/singleforcards.php?id=$id");
exit();