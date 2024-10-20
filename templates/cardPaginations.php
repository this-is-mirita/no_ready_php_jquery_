<?php
// Проверяем, есть ли параметр 'page' в URL
$page = isset($_GET['page']) ? (int)$_GET['page'] : 0;

// Получаем результат функции
$paginationData = getPagination($pdo, "posts");

// Доступ к карточкам
$cards = $paginationData['cards'];

// Доступ к текущей странице и общему количеству страниц
$page = $paginationData['currentPage'];
$pagesTotal = $paginationData['pagesTotal'];

//var_dump($cards); // 4 карточки
//var_dump($page); // номер страницы
//var_dump($pagesTotal); // количество страниц

$id_post = selectIDOnTable($pdo, "likes");
//echo "<pre>";
//var_dump($id_post);


?>
<section id="gallery">
    <div class="container">
        <h2>Наши няшки</h2>
        <div class="row">
            <?php foreach ($cards as $card): ?>
                <div class="col-lg-3 mb-4 d-flex">
                    <span class="d-none"><?= $card['id'] ?></span>
                    <div class="card h-100 shadow-sm card-hover flex-fill">
                        <img src="<?= $card['image'] ?>" alt="" class="card-img-top">
                        <div class="card-body d-flex flex-column">
                            <h5 class="card-title text-center"><?= $card['name_tyan'] ?></h5>
                            <p class="card-text flex-grow-1"><?= $card['description'] ?></p>
                            <div class="mt-auto text-center">
                                <p class="card-text text-muted">Followers: <?= $card['followers'] ?></p>
                            </div>
                        </div>
                        <div class="card-footer bg-transparent border-top d-flex justify-content-between align-items-center">
                            <a href="templates/singleforcards.php?id=<?= $card['id'] ?>" class="btn btn-outline-success btn-sm">Read More</a>
                            <!-- если есть в кормизе блять то показать если нет то y-->
                            <?php foreach ($id_post as $key_post): ?>
                                <?php if ($key_post["posts_id"] === $card['id']): ?>
                                    <a class="btn btn-outline-danger btn-sm d-flex justify-content-center align-items-center"
                                       style="width: 85px; height: 35px;"> v likes
                                        <i class="far fa-heart"></i>
                                    </a>
                                <?php endif; ?>
                            <?php endforeach ?>
                            <a type="submit" href="controllers/likesController.php?id=<?= $card['id'] ?>"
                               class="btn btn-outline-danger btn-sm d-flex justify-content-center align-items-center"
                               style="width: 35px; height: 35px;">
                                <i class="far fa-heart"></i>
                            </a>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
            <nav aria-label="Page navigation example" class="d-flex justify-content-center">
                <ul class="pagination">
                    <!-- Кнопка "Назад" -->
                    <li class="page-item <?= ($page <= 1) ? 'disabled' : '' ?>">
                        <a class="page-link" href="?page=<?= max(1, $page - 1) ?>" aria-label="Previous">
                            <span aria-hidden="true">&laquo;</span>
                        </a>
                    </li>

                    <!-- Генерация страниц -->
                    <?php for ($i = 1; $i <= $pagesTotal; $i++): ?>
                        <li class="page-item <?= ($i == $page) ? 'active' : '' ?>">
                            <a class="page-link <?= ($i == $page) ? 'text-white bg-dark position-relative' : '' ?>"
                               href="?page=<?= $i ?>">
                                <?= $i ?>
                                <?php if ($i == $page): ?>
                                    <span class="highlight"></span>
                                <?php endif; ?>
                            </a>
                        </li>
                    <?php endfor; ?>

                    <!-- Кнопка "Вперед" -->
                    <li class="page-item <?= ($page >= $pagesTotal) ? 'disabled' : '' ?>">
                        <a class="page-link" href="?page=<?= min($pagesTotal, $page + 1) ?>" aria-label="Next">
                            <span aria-hidden="true">&raquo;</span>
                        </a>
                    </li>
                </ul>
            </nav>


        </div>
    </div>
</section>

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
