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
    <title>Регистрация авто</title>

    <link rel="stylesheet" href="style.css">

</head>

<body>

<form class="material-form" method="post" action="#">

    <!--[ Номер автомобиля ]-->
    <div class="material-form__container">
        <input class="material-form__input" type="text" placeholder=" " id="carNumber"
               pattern="[а-яА-Я]\d{3}[а-яА-Я]{2}\d{2,3}" maxlength="9"/>
        <label class="material-form__label" for="carNumber">Номер автомобиля</label>
        <div class="material-form__focus-animation"></div>
        <p class="material-form__error">Формат: А111АА222</p>
    </div>
    <!--[ Номер автомобиля ]-->

    <!--[ Фамилия Имя Отчество Водителя ]-->
    <div class="material-form__container">
        <input class="material-form__input" type="text" placeholder=" " id="fullName"/>
        <label class="material-form__label" for="fullName">ФИО Водителя</label>
        <div class="material-form__focus-animation"></div>
        <p class="material-form__error"></p>
    </div>
    <!--[ Фамилия Имя Отчество Водителя ]-->

    <!--[ Чекбокс ]-->
    <div class="material-form__container">
        <div class="material-checkbox">
            <input type="checkbox" name="checkbox" id="checkbox">
            <label for="checkbox" class="lab">Есть прицеп?</label>
            <div class="spoiler">

                <div class="material-form__container" style="margin: 0">
                    <input class="material-form__input" type="text" placeholder=" " id="trailerNumber"
                           pattern="[а-яА-Я]{2}\d{4}\d{2,3}" maxlength="9"/>
                    <label class="material-form__label" for="trailerNumber">Номер прицепа</label>
                    <div class="material-form__focus-animation"></div>
                    <p class="material-form__error">Формат: АА1111222</p>
                </div>

            </div>
        </div>
    </div>
    <!--[ Чекбокс ]-->

    <!--[ Чекбокс пассажиров ]-->
    <div class="material-form__container">
        <input type="checkbox" name="spoiler2" id="spoiler2">
        <label for="spoiler2" class="lab">Есть пассажиры?</label>
        <div class="spoiler" id="list">
            <!--[ Кнопка добавить пассажиров ]-->
            <div class="material-form__container" style="text-align: center;">
                <a href="#" class="pure-material-button-contained" id="add">+</a>
            </div>
            <!--[ Кнопка добавить пассажиров ]-->
        </div>
    </div>
    <!--[ Чекбокс пассажиров ]-->

    <!--[ Кнопка регистрации авто ]-->
    <div class="material-form__container" style="text-align: center;">
        <a href="#" class="pure-material-button-contained" id="register">Зарегистрировать авто</a>
    </div>
    <!--[ Кнопка регистрации авто ]-->
</form>

<!--[ НЕОБХОДИМЫЕ СКРИПТЫ ДЛЯ ПРАВИЛЬНОЙ РАБОТЫ ]-->
<script src="jquery.min.js"></script>
<script src="sweetalert.min.js"></script>
<script src="index.js"></script>
<!--[ НЕОБХОДИМЫЕ СКРИПТЫ ДЛЯ ПРАВИЛЬНОЙ РАБОТЫ ]-->

</body>

</html>
