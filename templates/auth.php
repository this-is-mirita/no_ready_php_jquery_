<?php require __DIR__ . '/header.php'; ?>
<div class="container mt-5" style="width: 50rem">
    <h2 class="text-center">Вход</h2>
    <form method="post" action="../controllers/authController.php">
        <div class="form-group">
            <label for="login">Логин</label>
            <input type="text" class="form-control" id="login" name="login" placeholder="Введите ваш логин" >
        </div>
        <div class="form-group">
            <label for="password">Пароль</label>
            <input type="password" class="form-control" id="password" name="password" placeholder="Введите пароль" >
        </div>
        <button type="submit" class="btn btn-primary btn-block">Войти</button>
    </form>
</div>
