<?php
session_start();
require_once __DIR__ . "/../../Functions/Functions.php";
require_once __DIR__ . "/../../Model/dbConfig.php";
require_once __DIR__ . "/../../ErrorFiles/error.php";
require_once __DIR__ . "/../FunctionsForAdmin/admin_functions.php";
//require_once __DIR__ . "/../../templates/links.php";
$pdo = getPDO();
$posts = selectAllOnTable($pdo, "posts");
?>
<style>
    .search-box {
        position: relative;
        width: 500px;
        transition: width 0.5s ease-in-out;
    }

    .search-box input {
        width: 100%;
        padding: 10px 50px 10px 10px; /* Оставляем больше места для кнопки */
        border: 2px solid #6c757d;
        border-radius: 50px;
        outline: none;
        transition: all 0.3s ease;
    }

    .search-box input:focus {
        width: 650px;
        border-color: #ff4081;
        box-shadow: 0 0 10px rgba(255, 64, 129, 0.5);
    }

    .search-box button {
        position: absolute;
        right: 10px;
        top: 50%;
        transform: translateY(-50%) translateX(0); /* Начальное положение кнопки */
        border: none;
        background: none;
        color: #6c757d;
        font-size: 18px;
        padding: 0;
        width: 30px;
        height: 30px;
        cursor: pointer;
        transition: color 0.3s ease, transform 0.5s ease; /* Добавляем плавную анимацию на transform */
    }

    .search-box input:focus + button {
        color: #ff4081;
        transform: translateY(-50%) translateX(140px); /* Сдвигаем кнопку влево при фокусе */
    }

    .search-box button:hover {
        color: #ff4081;
    }
</style>
<div class="search-box mt-2">
    <input type="text" class="form-control" id="search" name="search" placeholder="Search...">
</div>

<div id="searchResults"></div> <!-- результаты поиска -->

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function () {
        $('#search').on('input', function () { // Событие срабатывает при вводе текста
            let searchvalue = $(this).val(); // Получение текста из инпута
            // Если текст есть, то выполняем запрос
            if (searchvalue) {
                $.ajax({
                    url: '/second/admin/pages-admin/searchposts.php', // URL для отправки запроса
                    type: 'POST', // Метод запроса
                    data: {search: searchvalue}, // Данные, отправляемые на сервер
                    success: function (data) { // Функция, выполняемая при успешном ответе
                        $('#searchResults').html(data); // Вставка полученных данных в div с id 'searchResults'
                        $('#allposts').hide(); // Скрыть все посты
                        //console.log(data); // Выводим ответ в консоль
                    },
                    error: function (jqXHR, textStatus, errorThrown) { // Обработка ошибок
                        $('#searchResults').html('<p>Ошибка загрузки страницы: ' + textStatus + ' ' + errorThrown + '</p>');
                        console.log(jqXHR.responseText); // Логируем ответ сервера
                    }
                });
            } else {
                // Если поле пустое, очищаем результаты
                $('#searchResults').html('');
                $('#allposts').show(4000); // Показываем все посты
            }
        });
    });
</script>
<div id="allposts">
    <?php foreach ($posts as $post): ?>

        <div class="row text-dark p-3 mb-1 rounded shadow-sm">
            <div class="col-md-1">
                <strong>ID:</strong>
                <p><?= $post["id"] ?></p>
            </div>
            <div class="col-md-1">
                <strong>image:</strong>
                <img  alt="Profile Image" class="img-fluid rounded shadow-sm mb-4" width="300" src="../<?= $post["image"] ?>">
            </div>
            <div class="col-md-1">
                <strong>followers:</strong>
                <p><?= $post["followers"] ?></p>
            </div>
            <div class="col-md-5">
                <strong>description:</strong>
                <p><?= $post["description"] ?></p>
            </div>
            <div class="col-md-1">
                <strong>name_tyan:</strong>
                <p><?= $post["name_tyan"] ?></p>
            </div>
            <div class="col-md-1">
                <div class="d-flex">
                    <a href="Posts/delete-post.php?id=<?= $post["id"] ?>" class="btn btn-dark me-2">Удалить</a>
                    <a href="Posts/template-for-post.php?id=<?= $post["id"] ?>" class="btn btn-dark">Редактировать</a>
                </div>
            </div>
        </div>
    <?php endforeach; ?>
</div>
