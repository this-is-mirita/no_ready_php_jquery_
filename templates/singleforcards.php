<?php
session_start();
require_once __DIR__ . "/../ErrorFiles/error.php";
require_once __DIR__ . "/../Functions/Functions.php";
$pdo = getPdo();
$id_tyan = isset($_GET['id']) ? $_GET['id'] : '';
$single_card = selectAllOnTableWhere($pdo, "posts", "id", $id_tyan);
?>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css"
      integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg=="
      crossorigin="anonymous" referrerpolicy="no-referrer"/>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
      integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

<div class="container py-2">
<!--    карточка с данными -->
    <?php foreach ($single_card as $single_card): ?>
        <div class="row align-items-center mb-4 shadow p-4 rounded bg-light">
            <!-- Левая колонка с изображением -->
            <div class="col-md-4">
                <img src="../<?=$single_card["image"]?>" alt="Image Description" class="img-fluid rounded shadow-sm">
            </div>

            <!-- Правая колонка с информацией -->
            <div class="col-md-8">
                <h2 class="mb-3 text-dark">Name: <?=$single_card["name_tyan"]?></h2>
                <h4 class="text-muted mb-3">Nomer Posta: №<?=$single_card["id"]?></h4>
                <p class="lead mb-4 text-secondary">
                    <?=$single_card["description"]?>
                </p>
                <ul class="list-unstyled">
                    <li><strong>Followers: </strong> <?=$single_card["followers"]?></li>
                    <li><strong>Пункт 2: </strong>Пример дополнительной информации</li>
                    <li><strong>Пункт 3: </strong>Подробности или описание пункта</li>
                </ul>
                <a href="#" class="btn btn-dark mt-4">Подробнее</a>
            </div>
        </div>
    <?php endforeach; ?>
</div>
<div class="container py-1">
    <!-- Форма для комментария -->
    <div class="row align-items-center mb-4 shadow p-4 rounded bg-light">
        <div class="col-md-12">
            <h3 class="mb-4 text-dark">Оставьте комментарий</h3>
            <form action="../controllers/submit_comment.php" method="POST">
                <!-- Поле для имени -->
                <input type="hidden" name="id_tyan" value="<?=htmlspecialchars($id_tyan)?>">
                <div class="form-group mb-3">
                    <label for="name" class="form-label text-dark">Ваше Имя</label>
                    <input type="text" id="name" name="name" class="form-control shadow-sm" value="<?= htmlspecialchars($_SESSION['user']['username']) ?>" required>
                </div>
                <!-- Поле для комментария -->
                <div class="form-group mb-4">
                    <label for="comment" class="form-label text-dark">Комментарий</label>
                    <textarea id="comment" name="comment" rows="4" class="form-control shadow-sm" placeholder="Напишите ваш комментарий" required></textarea>
                </div>
                <!-- Кнопка отправки -->
                <button type="submit" class="btn btn-dark">Отправить</button>
            </form>
        </div>
    </div>

    <!--комментарий -->
    <?php $get_comment = selectAllOnTableWhere($pdo, "comments", "tyan_id", $id_tyan); ?>
    <?php foreach (array_reverse($get_comment) as $single_comment): ?>
        <div class="row align-items-center mb-4 shadow p-4 rounded bg-light">
            <div class="col-md-12">
                <h5 class="text-dark"><?=$single_comment['name']?></h5>
                <p class="text-dark mb-0">
                    comm :  <strong><?=$single_comment['comment']?></strong>
                </p>
                <p class="text-secondary mt-1">
                    date : <strong><?=$single_comment['date']?></strong>
                </p>
            </div>
        </div>
    <?php endforeach; ?>
</div>