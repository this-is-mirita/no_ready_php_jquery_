<?php
session_start();
require_once __DIR__ . "/../../Model/dbConfig.php";
require_once __DIR__ . "/../../ErrorFiles/error.php";
require_once __DIR__ . "/../FunctionsForAdmin/admin_functions.php";

$pdo = getPDO();
// получение черезе AJAX data объект и берём из него по ключу search его значение
if (isset($_POST['search'])) {
    $searchValue = filter_input(INPUT_POST, 'search', FILTER_SANITIZE_SPECIAL_CHARS);
    $users = searchPost($pdo, "users", "login", "username", $searchValue, $searchValue);

    if ($users) {
        foreach ($users as $user) {
            echo "<div class='row text-dark p-3 mb-3 rounded shadow-sm'>";
            echo "<input type='hidden' id='id_user' name='id_user' value='" . htmlspecialchars($user["id"]) . "'>";

            echo "<div class='col-md-1'>";
            echo "<strong>ID:</strong>";
            echo "<p>" . htmlspecialchars($user["id"]) . "</p>";
            echo "</div>";

            echo "<div class='col-md-1'>";
            echo "<strong>Login:</strong>";
            echo "<p>" . htmlspecialchars($user["login"]) . "</p>";
            echo "</div>";

            echo "<div class='col-md-1'>";
            echo "<strong>Username:</strong>";
            echo "<p>" . htmlspecialchars($user["username"]) . "</p>";
            echo "</div>";

            echo "<div class='col-md-2'>";
            echo "<strong>Email:</strong>";
            echo "<p>" . htmlspecialchars($user["email"]) . "</p>";
            echo "</div>";

            echo "<div class='col-md-1'>";
            echo "<strong>Password:</strong>";
            echo "<p>" . htmlspecialchars(substr($user["password"], -9)) . "</p>";
            echo "</div>";

            echo "<div class='col-md-1'>";
            echo "<strong>Admin:</strong>";
            echo "<p>" . htmlspecialchars($user["is_admin"]) . "</p>";
            echo "</div>";

            echo "<div class='col-md-2'>";
            echo "<strong>Profile Image:</strong>";
            if ($user["linkimg"] == null) {
                echo "<p>net foto user</p>";
            } else {
                echo "<img src='../img/" . htmlspecialchars($user["linkimg"]) . "' alt='Profile Image' class='img-fluid rounded' width='70' data-bs-toggle='modal' data-bs-target='#imageModal-" . htmlspecialchars($user["id"]) . "'>";

                // Модальное окно
                echo "<div class='modal fade' id='imageModal-" . htmlspecialchars($user["id"]) . "' tabindex='-1' aria-labelledby='imageModalLabel' aria-hidden='true'>";
                echo "<div class='modal-dialog modal-dialog-centered'>";
                echo "<div class='modal-content'>";
                echo "<div class='modal-header'>";
                echo "<h5 class='modal-title' id='imageModalLabel'>Profile Image</h5>";
                echo "<button type='button' class='btn-close' data-bs-dismiss='modal' aria-label='Close'></button>";
                echo "</div>";
                echo "<div class='modal-body text-center'>";
                echo "<img src='../img/" . htmlspecialchars($user["linkimg"]) . "' alt='Profile Image' class='img-fluid rounded'>";
                echo "</div>";
                echo "</div>";
                echo "</div>";
                echo "</div>";
            }
            echo "</div>";

            if ($user["id"] === 9 || $user["is_admin"] === 1) {
                echo "<div class='col-md-2'>";
                echo "<div class='d-flex'>";
                echo "<p>nyasha na admine</p>";
                echo "</div>";
                echo "</div>";
            } else {
                echo "<div class='col-md-2'>";
                echo "<div class='d-flex'>";
                echo "<a href='user_controllers/delet-user.php?id=" . htmlspecialchars($user["id"]) . "' class='btn btn-dark me-2'>Удалить</a>";
                echo "<a href='user_controllers/template-for-user.php?id=" . htmlspecialchars($user["id"]) . "' class='btn btn-dark'>Редактировать</a>";
                echo "</div>";
                echo "</div>";
            }

            echo "</div>";
        }
    } else {
        echo "<p>No results found.</p>";
    }
}
