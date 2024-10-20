<?php
session_start();
require_once __DIR__ . "/../ErrorFiles/error.php";
require_once __DIR__ . "/../Functions/Functions.php";
$pdo = getPdo();
?>
    <!DOCTYPE html>
    <html lang="ru">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Header Example</title>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css"
              integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg=="
              crossorigin="anonymous" referrerpolicy="no-referrer"/>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
              integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH"
              crossorigin="anonymous">
        <link rel="stylesheet" href="../css/style.css">
    </head>
<body>
<?php
$card_like_user = selectAllOnTableWhere($pdo, "likes", "user_id", $_SESSION['user']['id']);
//var_dump($card_like_user);
?>
    <div class="container mt-5">
        <div class="row">
            <?php foreach ($card_like_user as $like): ?>
                <?php if ($like['user_id'] == $_SESSION['user']['id']): ?>
                    <div class="col-lg-3 mb-4 d-flex">
                        <span class="d-none"><?= $like['id'] ?></span>
                        <div class="card h-100 shadow-sm card-hover flex-fill">
                            <img src="../<?= $like['image'] ?>" alt="" class="card-img-top">
                            <div class="card-body d-flex flex-column">
                                <h5 class="card-title text-center"><?= $like['name_tyan'] ?></h5>
                                <p class="card-text flex-grow-1"><?= $like['description'] ?></p>
                                <div class="mt-auto text-center">
                                    <p class="card-text text-muted">Followers: <?= $like['followers'] ?></p>
                                </div>
                            </div>
                            <div class="card-footer bg-transparent border-top d-flex justify-content-between align-items-center">
                                <a href="#" class="btn btn-outline-success btn-sm">Read More</a>
                                <form action="" method="post">
                                    <a type="submit" href="../controllers/deletController.php?id=<?= $like['id'] ?>"
                                       class="btn btn-outline-danger btn-sm d-flex justify-content-center align-items-center"
                                       style="width: 90px; height: 35px;">delet &nbsp
                                        <i class="far fa-heart"></i>
                                    </a>
                                </form>
                            </div>
                        </div>
                    </div>
                <?php endif; ?>
            <?php endforeach; ?>
        </div>
    </div>
    <style>
        .card-hover {
            border: 1px solid #ced4da; /* Светлая граница */
            border-radius: 0.5rem; /* Закругленные углы */
            transition: transform 0.3s, box-shadow 0.3s; /* Плавный переход для эффекта */
        }

        .card-hover:hover {
            transform: translateY(-5px); /* Подъем карточки при наведении */
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1); /* Тень при наведении */
        }

        .card-title {
            font-size: 1.25rem; /* Размер шрифта для заголовка */
            font-weight: bold; /* Жирный шрифт */
            color: #333; /* Цвет заголовка */
        }

        .card-text {
            font-size: 1rem; /* Размер шрифта для описания */
            color: #555; /* Цвет текста */
        }

        .card-footer {
            background-color: #f8f9fa; /* Светлый фон для подвала */
        }

        .btn-outline-success {
            border-color: #28a745; /* Цвет рамки для кнопки "Read More" */
        }

        .btn-outline-danger {
            border-color: #dc3545; /* Цвет рамки для кнопки "heart" */
        }

        .card-footer .btn {
            transition: background-color 0.2s; /* Плавный переход для фона кнопки */
        }

        .pagination {
            justify-content: center; /* Центрируем пагинацию */
        }

        .page-link {
            padding: 10px 15px; /* Увеличиваем внутренние отступы кнопок */
            margin: 0 5px; /* Добавляем отступы между кнопками */
            border-radius: 0.5rem; /* Закругляем углы кнопок */
            transition: background-color 0.3s, transform 0.3s; /* Плавный переход для эффекта */
            color: #343a40; /* Цвет текста по умолчанию */
        }

        .page-link:hover {
            background-color: #343a40; /* Цвет фона при наведении (черный) */
            color: #ffffff; /* Цвет текста при наведении (белый) */
            transform: scale(1.05); /* Увеличиваем размер кнопки при наведении */
        }

        .page-item.disabled .page-link {
            background-color: #f8f9fa; /* Цвет фона для отключенной кнопки */
            color: #6c757d; /* Цвет текста для отключенной кнопки */
            pointer-events: none; /* Отключаем возможность клика */
            opacity: 0.6; /* Уменьшаем непрозрачность для визуального эффекта отключения */
        }

        .page-item.active .page-link {
            background-color: #343a40; /* Цвет фона активной страницы */
            color: #ffffff; /* Цвет текста активной страницы */
            transform: scale(1.05); /* Увеличиваем размер активной кнопки */
        }

        .highlight {
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            border: 2px solid red; /* Красная линия */
            border-radius: 0.5rem; /* Закругляем углы */
            animation: pulse 1.5s infinite; /* Анимация пульсации */
            z-index: -1; /* Помещаем за текстом кнопки */
        }

        @keyframes pulse {
            0% {
                transform: scale(1); /* Начальный размер */
                opacity: 1; /* Полная непрозрачность */
            }
            50% {
                transform: scale(1.1); /* Увеличиваем размер */
                opacity: 0.5; /* Уменьшаем непрозрачность */
            }
            100% {
                transform: scale(1); /* Возвращаемся к исходному размеру */
                opacity: 1; /* Полная непрозрачность */
            }
        }


    </style>
<?php require_once __DIR__ . "/../templates/footer.php"; ?>