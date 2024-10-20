<style>
    .mirrored-image {
        transform: scaleX(-1); /* Отзеркаливаем изображение по горизонтали */
        display: block; /* Убираем отступы, если они есть */
        margin: 0 auto; /* Центрируем изображение, если это нужно */
    }
    .depressive-content {
        color: #000000; /* Светло-серый текст */
        padding: 60px;
        text-align: center;
    }

    .depressive-content h2 {
        color: #000000; /* Темный заголовок */
        margin-bottom: 30px;
    }

    .depressive-content img {
        max-width: 100%;
        height: auto;
        border: 2px solid #495057;
        border-radius: 8px;
        margin-bottom: 20px;
        opacity: 0.85;
        transition: opacity 0.3s;
    }

    .depressive-content img:hover {
        opacity: 1;
    }

    .depressive-quote {
        font-size: 1.5rem;
        font-style: italic;
        margin-bottom: 40px;
    }

    .depressive-form {
        color: #adb5bd; /* Светло-серый текст */
        padding: 50px;
        text-align: center;
    }
    .depressive-form h2 {
        color: #6c757d; /* Темно-серый заголовок */
        margin-bottom: 30px;
    }
    .form-control, .btn-dark {
        border-color: #495057; /* Темные границы */
        color: #adb5bd; /* Светлый текст */
    }
    .form-control::placeholder {
        color: #6c757d; /* Темные плейсхолдеры */
    }
    .form-control:focus {
        box-shadow: none; /* Отключить тени при фокусе */
        border-color: #868e96; /* Более светлая граница при фокусе */
    }
    .btn-dark:hover {
        background-color: #495057; /* Темнее при наведении */
    }
    .depressive-content {
        color: #adb5bd; /* Светло-серый текст */
        padding: 50px;
        text-align: center;
    }
    .depressive-content h2 {
        color: #6c757d; /* Еще темнее для заголовков */
    }
    .depressive-content p {
        font-size: 1.2rem; /* Чуть больше обычного для выделения */
    }

    footer {
        background-color: #212529; /* Черный фон футера */
        color: #868e96; /* Серый текст футера */
        padding: 20px;
        text-align: center;
    }
</style>
<div class="container">
    <section class="depressive-content">
        <h2>Потерянные мысли</h2>

        <div class="row justify-content-center">
            <div class="col-md-4 mb-4">
                <img  src="https://otzz.ru/wp-content/uploads/2023/10/grustnyi-art-1-1.webp" alt="Depressive Anime Image 2" class="img-fluid mirrored-image">
            </div>
            <div class="col-md-4 mb-4">
                <img src="https://otzz.ru/wp-content/uploads/2023/10/grustnyi-art-1-1.webp" alt="Depressive Anime Image 2" class="img-fluid">
            </div>
        </div>

        <p class="depressive-quote">"Одиночество не лечится, оно становится твоим вечным спутником."</p>
    </section>
    <section class="depressive-form">
        <h2>Заполни, но не жди ответа</h2>
        <form action="#" method="post">
            <div class="mb-3">
                <input type="text" class="form-control" id="name" placeholder="Твое имя">
            </div>
            <div class="mb-3">
                <input type="email" class="form-control" id="email" placeholder="Твой email">
            </div>
            <div class="mb-3">
                <textarea class="form-control" id="message" rows="5" placeholder="Твое сообщение... хотя зачем?"></textarea>
            </div>
            <button type="submit" class="btn btn-dark w-100">Отправить в пустоту</button>
        </form>
    </section>
    <!-- Депрессивный контент -->
    <section class="depressive-content">
        <h2>Тьма вокруг</h2>
        <p>Каждый день как будто сливается в одно. Смысла нет, но ты продолжаешь идти. Тени становятся длиннее, а свет всё тусклее. Холод внутри, пустота снаружи.</p>
        <p>Словно всё вокруг ускользает, и ты лишь наблюдатель в мире без красок.</p>
    </section>