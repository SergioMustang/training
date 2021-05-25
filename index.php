<?php
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
    $myRequest = new deletePerson();
    $myRequest->delete_request($db);
} else {
    echo 'Здесь будет код ошибки';
}
?>
