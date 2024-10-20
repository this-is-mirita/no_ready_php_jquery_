<?php
require_once (__DIR__ . "/../../Functions/Functions.php");
require_once (__DIR__ . "/../../ErrorFiles/error.php");
require_once(__DIR__ . "/../../Model/dbConfig.php");
$pdo = getPDO();
$up_id = $_GET["id"];
$users = selectAllOnTableWhere($pdo, "users", "id", $up_id);
?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Админка</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<div class="container py-5">
    <?php foreach ($users as $user): ?>
    <div class="row justify-content-center">
        <!-- Фото пользователя -->
        <div class="col-md-4 text-center">
            <?php if($user["linkimg"] == null):?>
                <p>net foto</p>
            <?php else: ?>
                <img src="../../img/<?=$user["linkimg"]?>" alt="Profile Image" class="img-fluid rounded shadow-sm mb-4" width="500">
            <?php endif;?>
            <div class="form-group">
                <label for="profileImage" class="form-label text-dark">Обновить фото профиля</label>
                <input type="file" id="profileImage" name="profileImage" class="form-control shadow-sm">
            </div>
        </div>

        <!-- Данные пользователя -->
        <div class="col-md-6">
            <h3 class="mb-4 text-dark">Обновить данные пользователя</h3>
            <form  id="updateForm" enctype="multipart/form-data">
                <input hidden="hidden" id="id_user" name="id_user" value="<?=$user["id"]?>">
                <div class="form-group mb-3">
                    <label for="login" class="form-label text-dark">login</label>
                    <input type="text" id="login" name="login" class="form-control shadow-sm" value="<?=$user["login"]?>">
                </div>

                <div class="form-group mb-3">
                    <label for="username" class="form-label text-dark">Имя пользователя</label>
                    <input type="text" id="username" name="username" class="form-control shadow-sm" value="<?=$user["username"]?>">
                </div>

                <div class="form-group mb-3">
                    <label for="email" class="form-label text-dark">Email</label>
                    <input type="text" id="email" name="email" class="form-control shadow-sm" value="<?=$user["email"]?>">
                </div>

                <div class="form-group mb-3">
                    <label for="password" class="form-label text-dark">Пароль</label>
                    <input type="text" id="password" name="password" class="form-control shadow-sm" placeholder="<?=$user["password"]?>">
                </div>

                <div class="form-group mb-3">
                    <label for="is_admin" class="form-label text-dark">Админ</label>
                    <select id="is_admin" name="is_admin" class="form-control shadow-sm">
                        <option value="0" selected>Нет</option>
                        <option value="1">Да</option>
                    </select>
                </div>
                <div class="form-group mb-3">
                    <label for="profileImage" class="form-label text-dark">Фото</label>
                    <select id="profileImage" name="profileImage" class="form-control shadow-sm">
                        <option value="0" selected></option>
                        <option value="1">1.jpg</option>
                        <option value="2">2.jpg</option>
                        <option value="3">3.jpg</option>
                        <option value="4">4.jpg</option>
                        <option value="5">5.jpg</option>
                        <option value="6">6.jpg</option>
                        <option value="7">7.jpg</option>
                        <option value="8">8.jpg</option>
                        <option value="9">9.jpg</option>
                        <option value="10">10.jpg</option>
                        <option value="11">11.jpg</option>
                        <option value="12">12.jpg</option>
                        <option value="13">13.jpg</option>
                        <option value="14">14.jpg</option>
                        <option value="15">15.jpg</option>
                    </select>
                </div>

                <!-- Кнопка обновления -->
                <button type="submit" class="btn btn-dark shadow-sm">Обновить данные</button>
            </form>
        </div>
    </div>
    <?php endforeach; ?>
</div>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function (){
        $('#updateForm').on('submit', function (e){
            e.preventDefault();  // Предотвращаем стандартное поведение формы

            let id_user = $('#id_user').val();
            let login = $('#login').val();
            let username = $('#username').val();
            let email = $('#email').val();
            let password = $('#password').val();
            let is_admin = $('#is_admin').val();

            let profileImage = $("select#profileImage").val();
            $.ajax({
                url: 'update_user.php',  // Убедитесь, что путь верный
                type: 'POST',  // Добавляем двоеточие
                data: {
                    id_user: id_user,
                    login: login,
                    username: username,
                    email: email,
                    password: password,
                    is_admin: is_admin,
                    profileImage: profileImage
                },
                success: function (response){
                    let res = JSON.parse(response);
                    if(res.status === 'success'){
                        window.location.href = '../admin-start-page.php';  // Перенаправляем при успехе
                    } else {
                        console.log('Ошибка в ответе сервера');
                    }
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    console.error("Ошибка AJAX-запроса: ", textStatus, errorThrown);
                }
            });
        });
    });
</script>
