<?php
include_once('config.php');
$mysqli = new mysqli(HOST , USER , PASS , DB , PORT);
if ($mysqli->connect_errno) { // Проверка на ошибку подключения
    exit();
}

$access_token = $_COOKIE['access_token'];

if (!empty($access_token)){
    $sql = "SELECT * FROM `user` WHERE `access_token` = '$access_token'";
    $query = $mysqli->query($sql);
    if ($query->num_rows == 0){
        header("Location: index.php");
    }
} else {
    header("Location: index.php");
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Меню</title>

    <link rel="stylesheet" href="style.css">

</head>

<body>

<form class="material-form" method="post" action="#">

    <!--[ Подать заявку ]-->
    <div class="material-form__container" style="text-align: center;">
        <a href="#" class="pure-material-button-contained" id="addRequest">Подать заявку</a>
    </div>
    <!--[ Подать заявку ]-->

    <?php
    $response = $query->fetch_object();
    if ($response->status == 1 or $response->status == 2){
        echo "<!--[ Посмотреть заявки ]-->
    <div class=\"material-form__container\" style=\"text-align: center;\">
        <a href=\"#\" class=\"pure-material-button-contained\" id=\"listRequest\">Список заявок</a>
    </div>
    <!--[ Посмотреть заявки ]-->";
    }
    ?>

</form>

<!--[ НЕОБХОДИМЫЕ СКРИПТЫ ДЛЯ ПРАВИЛЬНОЙ РАБОТЫ ]-->
<script src="jquery.min.js"></script>
<script src="sweetalert.min.js"></script>
<script src="index3.js"></script>
<!--[ НЕОБХОДИМЫЕ СКРИПТЫ ДЛЯ ПРАВИЛЬНОЙ РАБОТЫ ]-->

</body>

</html>
