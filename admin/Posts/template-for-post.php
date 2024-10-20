<?php
require_once (__DIR__ . "/../../Functions/Functions.php");
require_once (__DIR__ . "/../../ErrorFiles/error.php");
require_once(__DIR__ . "/../../Model/dbConfig.php");
$pdo = getPDO();
$up_id = $_GET["id"];
$posts = selectAllOnTableWhere($pdo, "posts", "id", $up_id);
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
    <?php foreach ($posts as $post): ?>
    <div class="row justify-content-center">
        <!-- Фото -->
        <div class="col-md-4 text-center">
            <?php if($post["image"] == null):?>
                <p>net foto</p>
            <?php else: ?>
                <img src="../../<?=$post["image"]?>" alt="Profile Image" class="img-fluid rounded shadow-sm mb-4" width="500">
            <?php endif;?>
<!--            <div class="form-group">-->
<!--                <label for="profileImage" class="form-label text-dark">Обновить фото профиля</label>-->
<!--                <input type="file" id="profileImage" name="profileImage" class="form-control shadow-sm">-->
<!--            </div>-->
        </div>

        <!-- Данные  -->
        <div class="col-md-6">
            <h3 class="mb-4 text-dark">Обновить данные</h3>
            <form action="update_post.php" method="POST" enctype="multipart/form-data">
                <input hidden="hidden" name="id_post" value="<?=$post["id"]?>">

                <div class="form-group mb-3">
                    <label for="profileImage" class="form-label text-dark">Фото</label>
                    <select id="profileImage" name="profileImage" class="form-control shadow-sm">
                        <option value="0" selected>/</option>
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

                <div class="form-group mb-3">
                    <label for="followers" class="form-label text-dark">followers</label>
                    <input type="text" id="followers" name="followers" class="form-control shadow-sm" value="<?=$post["followers"]?>">
                </div>

                <div class="form-group mb-3">
                    <label for="description" class="form-label text-dark">description</label>
                    <textarea type="text" id="description" name="description" class="form-control shadow-sm" placeholder=""><?=$post["description"]?> </textarea>
                </div>

                <div class="form-group mb-3">
                    <label for="name_tyan" class="form-label text-dark">name_tyan</label>
                    <input type="text" id="name_tyan" name="name_tyan" class="form-control shadow-sm" value="<?=$post["name_tyan"]?>">
                </div>

                <!-- Кнопка обновления -->
                <button type="submit" class="btn btn-dark shadow-sm">Обновить данные</button>
            </form>
        </div>
    </div>
    <?php endforeach; ?>
</div>