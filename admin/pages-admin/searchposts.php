<?php
session_start();
require_once __DIR__ . "/../../Model/dbConfig.php";
require_once __DIR__ . "/../../ErrorFiles/error.php";
require_once __DIR__ . "/../FunctionsForAdmin/admin_functions.php";

$pdo = getPDO();
// получение черезе AJAX data объект и берём из него по ключу search его значение
if (isset($_POST['search'])) {
    $searchValue = filter_input(INPUT_POST, 'search', FILTER_SANITIZE_SPECIAL_CHARS);
    $posts = searchPost($pdo, "posts", "description", "name_tyan", $searchValue, $searchValue);
    if ($posts) {
        foreach ($posts as $post) {
            echo "<div class='row text-dark p-3 mb-1 rounded shadow-sm'>";
            echo "<div class='col-md-1'>";
            echo "<strong>ID:</strong>";
            echo "<p>" . htmlspecialchars($post["id"]) . "</p>";
            echo "</div>";
            echo "<div class='col-md-1'>";
            echo "<strong>image:</strong>";
            echo "<img alt='Profile Image' class='img-fluid rounded shadow-sm mb-4' width='300' src='../" . htmlspecialchars($post["image"]) . "'>";
            echo "</div>";
            echo "<div class='col-md-1'>";
            echo "<strong>followers:</strong>";
            echo "<p>" . htmlspecialchars($post["followers"]) . "</p>";
            echo "</div>";
            echo "<div class='col-md-4'>";
            echo "<strong>description:</strong>";
            echo "<p>" . htmlspecialchars($post["description"]) . "</p>";
            echo "</div>";
            echo "<div class='col-md-1'>";
            echo "<strong>name_tyan:</strong>";
            echo "<p>" . htmlspecialchars($post["name_tyan"]) . "</p>";
            echo "</div>";
            echo "<div class='col-md-1'>";
            echo "<div class='d-flex'>";
            echo "<a href='Posts/delete-post.php?id=" . htmlspecialchars($post["id"]) . "' class='btn btn-dark me-2'>Удалить</a>";
            echo "<a href='Posts/template-for-post.php?id=" . htmlspecialchars($post["id"]) . "' class='btn btn-dark'>Редактировать</a>";
            echo "</div>";
            echo "</div>";
            echo "</div>";
        }
    } else {
        echo "<p>No results found.</p>";
    }
}
