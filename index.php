<?php
// необходимые HTTP-заголовки
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

// подключение базы данных и файл, содержащий объекты
include_once 'api/getConnection.php';
include_once 'api/getMethod.php';
include_once 'api/getPerson.php';
include_once 'api/postPerson.php';
include_once 'api/patchPerson.php';
include_once 'api/deletePerson.php';


// получаем соединение с базой данных
$database = new Database();
$db = $database->getConnection();
// получаем метод запроса
$Method = new Method();
$Method = $Method->getMethod();
//выбираем действие
if ($Method == 'GET') {
    $myRequest = new getPerson();
    $myRequest->get_request($db);
} elseif ($Method == 'POST') {
    $myRequest = new postPerson();
    $myRequest->post_request($db);
} elseif ($Method == 'PATCH') {
    $myRequest = new patchPerson();
    $myRequest->patch_request($db);
} elseif ($Method == 'DELETE') {
    echo $Method;
}
else {
    echo 'Здесь будет код ошибки';
}

// инициализируем объект
//$product = new Product($db);

// чтение товаров будет здесь
?>
