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
    if ($query->num_rows == 1){
        header("Location: menu.php");
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Авторизация | Регистрация</title>

    <link rel="stylesheet" href="style.css">

</head>

<body>

<form class="material-form" method="post" action="#">

    <!--[ Логин ]-->
    <div class="material-form__container">
        <input class="material-form__input" type="text" placeholder=" " id="login" maxlength="25"/>
        <label class="material-form__label" for="login">Логин</label>
        <div class="material-form__focus-animation"></div>
        <p class="material-form__error"></p>
    </div>
    <!--[ Логин ]-->

    <!--[ Пароль ]-->
    <div class="material-form__container">
        <input class="material-form__input" type="password" placeholder=" " id="password" maxlength="25"/>
        <label class="material-form__label" for="password">Пароль</label>
        <div class="material-form__focus-animation"></div>
        <p class="material-form__error"></p>
    </div>
    <!--[ Пароль ]-->

    <!--[ Авторизация ]-->
    <div class="material-form__container" style="text-align: center;">
        <a href="#" class="pure-material-button-contained" id="auth">Авторизация</a>
    </div>
    <!--[ Авторизация ]-->

    <!--[ Регистрация ]-->
    <div class="material-form__container" style="text-align: center;">
        <a href="#" class="pure-material-button-contained" id="reg">Регистрация</a>
    </div>
    <!--[ Регистрация ]-->
</form>

<!--[ НЕОБХОДИМЫЕ СКРИПТЫ ДЛЯ ПРАВИЛЬНОЙ РАБОТЫ ]-->
<script src="jquery.min.js"></script>
<script src="sweetalert.min.js"></script>
<script src="index3.js"></script>
<!--[ НЕОБХОДИМЫЕ СКРИПТЫ ДЛЯ ПРАВИЛЬНОЙ РАБОТЫ ]-->

</body>

</html>
