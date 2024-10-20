<?php
require_once (__DIR__ . "/../../Functions/Functions.php");
require_once (__DIR__ . "/../../ErrorFiles/error.php");
require_once(__DIR__ . "/../../Model/dbConfig.php");
$pdo = getPDO();
$delet_id = $_GET["id"];

deleteAllOnTableWhere($pdo, "posts", "id", $delet_id);
header("Location: Posts.php");