<?php
require_once __DIR__ . '/../Model/dbConfig.php';
// получение всех записей сразу
function selectAllOnTable($pdo, $tableName){
    global $pdo; // Использование переменной
    // Проверим, что имя таблицы безопасно для использования
    $tableName = preg_replace('/[^a-zA-Z0-9_]/', '', $tableName);

    try {
        // Создание запроса с подставленным именем таблицы
        $sql = "SELECT * FROM `$tableName` ";
        $query = $pdo->prepare($sql);
        $query->execute();

        return $query->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        echo $e->getMessage();
    }
}
//получение posts_id из таблицы лайков
function selectIDOnTable($pdo, $tableName){
    global $pdo; // Использование переменной
    // Проверим, что имя таблицы безопасно для использования
    $tableName = preg_replace('/[^a-zA-Z0-9_]/', '', $tableName);

    try {
        // Создание запроса с подставленным именем таблицы
        $sql = "SELECT posts_id FROM `$tableName` ";
        $query = $pdo->prepare($sql);
        $query->execute();

        return $query->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        echo $e->getMessage();
    }
}
//получение  любой записи по условию
function selectAllOnTableWhere($pdo, $tableName, $paramentr, $where){
    try {
        // Создание запроса с подставленным именем таблицы
        $sql = "SELECT * FROM `$tableName` WHERE $paramentr = $where ";
        $query = $pdo->prepare($sql);
        $query->execute();

        return $query->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        echo $e->getMessage();
    }
}
//удаление по айди любой записи из таблице
function deleteAllOnTableWhere($pdo, $tableName, $paramentr, $where){
    try {
        // Создание запроса
        $sql = "DELETE FROM `$tableName` WHERE $paramentr = $where";
        $query = $pdo->prepare($sql);
        $query->execute();
    } catch (PDOException $e) {
        echo $e->getMessage();
    }
}
//получение id пользователя по логину
function getIdUsers($pdo, $login){
    try {
        // Создание запроса с подставленным именем таблицы
        $sql = "SELECT id FROM users WHERE login = ?";
        $query = $pdo->prepare($sql);
        $query->execute([$login]);

        $id_user = $query->fetch(PDO::FETCH_ASSOC);
        // Вернуть только id или null, если пользователь не найден
        return $id_user ? $id_user['id'] : null;
    } catch (PDOException $e) {
        echo $e->getMessage();
        return false;
    }
}
//запись пользователя при регистрации на сайте
function insertRegistrationUser($pdo,$login, $username, $email, $password, $is_admin, $img){
    try {
        // Хешируем пароль перед вставкой
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        // Создание запроса с подставленным именем таблицы
        $sql = "INSERT INTO users (username, login, email, password, is_admin, linkimg) VALUES (?,?,?,?,?,?)";
        $query = $pdo->prepare($sql);
        $query->execute([$username, $login,  $email, $hashedPassword, $is_admin, $img]);
        return true;
    } catch (PDOException $e) {
        echo $e->getMessage();
        return false;
    }
}
// пагинация на маине
function getPagination($pdo, $tableName) {
    // В переменную posts положили все данные из таблицы post
    $posts = selectAllOnTable($pdo, $tableName);

    $limit = 4;
    // Проверяем, есть ли параметр page в $_GET, если нет - присваиваем 1
    $page = isset($_GET['page']) ? intval($_GET['page']) : 1; // Текущая страница
    $offset = ($page - 1) * $limit; // Считаем смещение

    $cardQuantity = count($posts); // Общее количество карточек
    $cardOnPage = array_slice($posts, $offset, $limit, true); // Карточки на текущей странице

    $pagesTotal = ceil($cardQuantity / $limit); // Количество страниц

    // Возвращаем массив с данными карточек и пагинации
    return [
        'cards' => $cardOnPage,
        'currentPage' => $page,
        'pagesTotal' => $pagesTotal
    ];
}

function addlikesOnPost($pdo,$tableName, $user_id, $image, $followers, $description, $name_tyan,$posts_id){

    $tableName = preg_replace('/[^a-zA-Z0-9_]/', '', $tableName);
    try {
        $sql = "INSERT INTO `$tableName` (user_id, image, followers, description, name_tyan, posts_id) VALUES (?,?,?,?,?,?)";
        $query = $pdo->prepare($sql);
        $query->execute([$user_id, $image, $followers, $description, $name_tyan, $posts_id]);
    } catch (PDOException $e) {
        echo $e->getMessage();
    }

}
// вынос в функцию
function likePost($pdo, $card_id, $user_id) {
    // получени из таблицы по айди и условию
    $getcard = selectAllOnTableWhere($pdo, "posts", "id", $card_id);

    if (!empty($getcard)) {
        // Добавляем лайк
        addlikesOnPost($pdo, "likes", $user_id, $getcard[0]["image"], $getcard[0]["followers"], $getcard[0]["description"], $getcard[0]["name_tyan"],$card_id );
    } else {
        throw new Exception("Карта не найдена");
    }
}

function insertcommentOnPost($pdo,$tableName,$name, $comment, $tyan_id, $user_id){
    $tableName = preg_replace('/[^a-zA-Z0-9_]/', '', $tableName);
    try {
        $sql = "INSERT INTO `$tableName` (name, comment, tyan_id, user_id) VALUES (?,?,?,?)";
        $query = $pdo->prepare($sql);
        $query->execute([$name, $comment, $tyan_id, $user_id]);
    } catch (PDOException $e) {
        echo $e->getMessage();
    }
}