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
          integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
<div class="container">
    <nav class="mainNav d-flex justify-content-between mt-2" style="width: 100%;">
        <div class="mainNav__logo">
            <a href="" class="mainNav__link text-dark">Logo</a>
        </div>
        <div class="mainNav__links">
            <?php if (!isset($_SESSION['user'])): ?>
                <a class="mainNav__link" href="templates/reg.php">Регистрация</a>
                <a class="mainNav__link" href="templates/auth.php">Авторизация</a>
            <?php else: ?>
                <a href="" class="mainNav__link text-dark">Projects</a>
                <a href="admin/admin-start-page.php" class="mainNav__link text-dark">admin</a>
                <a href="pages/like.php" class="mainNav__link text-dark">likes</a>
                <div class="dropdown">
                    <button class="btn dropdown-toggle mainNav__link" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Добро пожаловать, <?= htmlspecialchars($_SESSION['user']['username']) ?>
                    </button>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="#">Action</a></li>
                        <li><a class="dropdown-item" href="#">Another action</a></li>
                        <li><a class="dropdown-item" href="#">Something else here</a></li>
                    </ul>
                </div>
                <form action="templates/closeSession.php" method="post" style="display: inline;">
                    <button type="submit" class="btn btn-link text-dark mainNav__link">Выход</button>
                </form>
            <?php endif; ?>

        </div>
    </nav>
</div>

