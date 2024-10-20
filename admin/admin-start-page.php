<?php
session_start();
require_once(__DIR__ . "/../Model/dbConfig.php");
require_once(__DIR__ . "/../ErrorFiles/error.php");
?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <style>
        .back-arrow{
            display: none;
        }
        body {
            color: #000000;
        }
        .sidebar {
            min-height: 100vh;
            position: fixed;
            width: 250px;
            transition: width 0.3s;
        }

        .sidebar .nav-link {
            color: #000000;
            position: relative;
            text-decoration: none;
            padding-bottom: 5px;
        }

        .sidebar .nav-link::after {
            content: '';
            display: block;
            height: 2px;
            background-color: #c900ff;
            width: 100%;
            position: absolute;
            left: 0;
            bottom: 0;
            transform: scaleX(0);
            transition: transform 0.5s;
        }

        .sidebar .nav-link:hover::after {
            transform: scaleX(1);
        }

        .content {
            margin-left: 250px;
            padding: 20px;
        }

        .card {
            background-color: #c900ff;
            transition: transform 0.3s, box-shadow 0.3s;
        }
        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.5);
        }

        .card-title, .card-text {
            color: #ffffff;
        }
    </style>
</head>
<body>
<!-- Сайдбар -->
<div class="sidebar p-3">
    <h4 class="text-center text-dark">Админка</h4>
    <nav class="nav flex-column">
        <a class="nav-link" href="card-static.php" data-page="card-static">Статистика</a>
        <a class="nav-link" href="posts.php" data-page="posts">Посты</a>
        <a class="nav-link" href="users.php" data-page="users">пользователи</a>
    </nav>
</div>

<!-- Основной контент -->
<div class="content" id="main-content"></div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="load-start-page.js"></script>

<?php require_once __DIR__ . "/../templates/footer.php"; ?>
