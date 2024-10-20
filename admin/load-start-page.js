// Функция для загрузки страницы через AJAX
function loadPage(page) {
    // Отправка AJAX-запроса для загрузки страницы
    $.ajax({
        url: '/second/admin/pages-admin/' + page + '.php', // URL страницы для загрузки
        type: 'GET', // Метод запроса
        success: function (data) {
            $('#main-content').html(data); // Вставляем загруженные данные в основной контент
            //console.log('Страница загружена:', data); // Логируем загруженные данные

            // Запрос на получение статистики
            $.ajax({
                url: 'getStatistics.php', // URL для получения статистики
                type: 'GET', // Метод запроса
                dataType: 'json', // Ожидаемый формат данных
                success: function(res) {
                    //console.log('Данные получены:', res); // Логируем полученные данные
                    // Проверяем, что данные пришли
                    if (res) {
                        // Обновляем текст карточек с полученными данными
                        $('.users .user-text').text('Всего пользователей: ' + res.users);
                        $('.users .posts-text').text('Всего постов: ' + res.posts);
                        $('.users .comments-text').text('Всего комментариев: ' + res.comments);
                        $('.users .services-text').text('Всего сервисов: ' + res.services);
                        $('.users .sliders-text').text('Всего в слайдере: ' + res.sliders);
                        $('.users .animeServices-text').text('Всего аниме сервисов: ' + res.animeServices);
                        $('.users .likes-text').text('Всего лайков: ' + res.likes);
                    } else {
                        console.error('Нет данных для обновления карточек.'); // Логируем, если данных нет
                    }
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    // Обработка ошибки при получении данных
                    console.error('Ошибка при получении данных:', textStatus, errorThrown);
                    console.log('Ответ сервера:', jqXHR.responseText); // Логируем ответ сервера
                },
            });
        },
        error: function (jqXHR, textStatus, errorThrown) {
            // Обработка ошибки при загрузке страницы
            $('#main-content').html('<p>Ошибка загрузки страницы: ' + textStatus + ' ' + errorThrown + '</p>');
            console.log(jqXHR.responseText); // Логируем ответ сервера
        }
    });
}

// Обработчик события для клика на навигационные ссылки
$(document).on('click', '.nav-link', function (e) {
    e.preventDefault(); // Отключаем стандартный переход по ссылке
    let page = $(this).data('page'); // Получаем значение data-page в html data-page="card-static"
    loadPage(page); // Загружаем нужную страницу
});
