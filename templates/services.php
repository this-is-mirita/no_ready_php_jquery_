<?php $services = selectAllOnTable($pdo, "services"); ?>

<div class="container mt-5">
    <div class="row justify-content-center">
        <?php foreach ($services as $service): ?>
            <div class="col-md-5 mb-4 d-flex">
                <div class="card border-dark shadow-sm card-hover flex-fill" style="transition: transform 0.2s;">
                    <div class="card-header text-center bg-dark text-white">
                        <h5 class="mb-0"><?=$service['name']?></h5>
                    </div>
                    <div class="card-body d-flex flex-column text-center">
                        <p class="card-text flex-grow-1"><?=$service['description']?></p>
                        <h5 class="card-title text-success"><?=$service['price']?></h5>
                        <h6 class="card-subtitle text-muted"><?=$service['duration']?></h6>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>
<style>
    .cardright{
        margin-right: 1rem;
    }
    .card-hover {
        border: 1px solid #343a40; /* Темная граница */
        border-radius: 0.5rem; /* Закругленные углы */
        transition: transform 0.3s, box-shadow 0.3s; /* Плавный переход для эффекта */
    }

    .card-hover:hover {
        transform: translateY(-5px); /* Подъем карточки при наведении */
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.2); /* Тень при наведении */
    }

    .card-header {
        font-size: 1.25rem; /* Увеличение шрифта заголовка */
        font-weight: bold; /* Жирный шрифт */
    }

    .card-body {
        padding: 1.5rem; /* Увеличенный внутренний отступ */
        display: flex;
        flex-direction: column;
        justify-content: space-between; /* Равномерное распределение контента */
    }

    .card-title {
        font-size: 1.5rem; /* Размер шрифта для цены */
    }

    .card-subtitle {
        font-size: 1rem; /* Размер шрифта для продолжительности */
    }
</style>