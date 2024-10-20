<?php
session_start();
require_once (__DIR__ . "/../../Functions/Functions.php");
require_once (__DIR__ . "/../../ErrorFiles/error.php");
require_once(__DIR__ . "/../../Model/dbConfig.php");

$pdo = getPDO();
$users = selectAllOnTable($pdo, "users");
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
<div id="searchResults"></div>

<div id="allposts" class="py-3">
    <?php foreach ($users as $user): ?>
        <div class="row text-dark p-3 mb-3 rounded shadow-sm">
            <input hidden="hidden" id="id_user" name="id_user" value="<?=$user["id"]?>">
            <div class="col-md-1">
                <strong>ID:</strong>
                <p><?=$user["id"]?></p>
            </div>
            <div class="col-md-1">
                <strong>Login:</strong>
                <p><?=$user["login"]?></p>
            </div>
            <div class="col-md-1">
                <strong>Username:</strong>
                <p><?=$user["username"]?></p>
            </div>
            <div class="col-md-2">
                <strong>Email:</strong>
                <p><?=$user["email"]?></p>
            </div>
            <div class="col-md-1">
                <strong>Password:</strong>
                <p><?=substr($user["password"], -9)?></p>
            </div>
            <div class="col-md-1">
                <strong>Admin:</strong>
                <p><?=$user["is_admin"]?></p>
            </div>
            <div class="col-md-2">
                <strong>Profile Image:</strong>
                <?php if($user["linkimg"] == null || $user["linkimg"] == null) : ?>
                    <p>net foto user</p>
                <?php else : ?>
                    <!-- Маленькое изображение -->
                    <img src="../img/<?=$user["linkimg"]?>" alt="Profile Image" class="img-fluid rounded" width="70"
                         data-bs-toggle="modal" data-bs-target="#imageModal-<?=$user["id"]?>">

                    <!-- Модальное окно -->
                    <div class="modal fade" id="imageModal-<?=$user["id"]?>" tabindex="-1" aria-labelledby="imageModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="imageModalLabel">Profile Image</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body text-center">
                                    <!-- Большое изображение -->
                                    <img src="../img/<?=$user["linkimg"]?>" alt="Profile Image" class="img-fluid rounded">
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endif; ?>
            </div>
            <?php if($user["id"] === 9 || $user["is_admin"] === 1 ): ?>
                <div class="col-md-2">
                    <div class="d-flex">
                        <p>nyasha na admine</p>
                    </div>
                </div>
            <?php else: ?>
                <div class="col-md-2">
                    <div class="d-flex">
                        <a href="user_controllers/delet-user.php?id=<?=$user["id"]?>" class="btn btn-dark me-2">Удалить</a>
                        <a href="user_controllers/template-for-user.php?id=<?=$user["id"]?>" class="btn btn-dark">Редактировать</a>
                    </div>
                </div>
            <?php endif; ?>
        </div>
    <?php endforeach; ?>
</div>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function () {
        $('#search').on('input', function () { // Событие срабатывает при вводе текста
            let searchvalue = $(this).val(); // Получение текста из инпута
            // Если текст есть, то выполняем запрос
            if (searchvalue) {
                $.ajax({
                    url: '/second/admin/pages-admin/searchuser.php', // URL для отправки запроса
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
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.min.js"></script>
