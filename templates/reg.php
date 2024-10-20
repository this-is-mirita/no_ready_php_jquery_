<?php require __DIR__ . '/header.php'; ?>
    <div class="container mt-5" style="width: 50rem">
        <h2 class="text-center">Регистрация</h2>
        <form action="../controllers/regController.php" method="post">
            <div class="form-group">
                <label for="username">Имя пользователя</label>
                <input type="text" class="form-control" id="username" name="username" placeholder="Введите ваше имя пользователя">
            </div>
            <div class="form-group">
                <label for="login">Логин</label>
                <input type="text" class="form-control" id="login" name="login" placeholder="Введите ваш логин">
            </div>
            <div class="form-group">
                <label for="email">Электронная почта</label>
                <input type="text" class="form-control" id="email" name="email" placeholder="Введите вашу электронную почту">
            </div>
            <div class="form-group">
                <label for="password">Пароль</label>
                <input type="password" class="form-control" id="password" name="password" placeholder="Введите пароль">
            </div>
            <div class="form-group">
                <label for="is_admin">Является администратором?</label>
                <select class="form-control" id="is_admin" name="is_admin">
                    <option value="0">Нет</option>
                    <option value="1">Да</option>
                </select>
            </div>
            <div class="form-group">
                <label for="linkimg">Ссылка на изображение</label>
                <input type="text" class="form-control" id="linkimg" name="linkimg" placeholder="Введите ссылку на изображение">
            </div>
            <button type="submit" class="btn btn-primary btn-block mt-2">Зарегистрироваться</button>
        </form>
    </div>
<?php
