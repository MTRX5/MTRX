var id = 1;

// Добавление новых пассажиров
$("#add").click(function () {
    if (id > 100){
        swal("Ошибка", "Нельзя добавить пассажиров больше 100 шт.", "warning");
    } else {
        // Добавляем новое поле
        $("#list").append("<div class='material-form__container' id='input"+ id +"'>\n" +
            "                <input class='material-form__input' type='text' placeholder=' ' id='name"+ id +"'/>\n" +
            "                <label class='material-form__label' for='name"+ id +"'>ФИО пассажира</label>\n" +
            "                <div class='material-form__focus-animation'></div>\n" +
            "                <p class='material-form__error'></p>\n" +
            "<a href=\"#\" class=\"pure-material-button-contained\" onclick='del("+ id +")' style='float: right; position: absolute; top: 8px; right: 0;'>-</a>" +
            "            </div>");
        id++;
        // Добавляем новое поле
    }

});
// Добавление новых пассажиров

// Функция для удаления определенного пассажира по уникальному ID
function del(id){
    var names = "name" + id;
    swal({
        title: "Удалить пассажира?",
        text: "Имя пассажира: " + $("#" + names).val(),
        icon: "info",
        buttons: true
    }).then((response) => {
        if (response){
            var n = "input" + id;
            $("#" + n).remove();
            id--;
        }
    });
}
// Функция для удаления определенного пассажира по уникальному ID

// Занесение всех данных в БД
$("#register").click(function () {
    var car_number = $("#carNumber").val(); // Номер автомобиля
    var full_name = $("#fullName").val(); // ФИО Водителя
    var car_number_regex = false; // Присваиваем изначальный результат на правильность введения автомобильного номера
    if ($("#checkbox").prop("checked")){ // Если чекбокс был отмечен, то так же вносим и номера трейлеров
        var trailer_number = $("#trailerNumber").val(); // Номер трейлера
        var trailer_number_regex = false; // Присваиваем изначальный результат на правильность введения трейлерного номера
    }

    var name = ""; // Присваиваем пустой результат для дальнейшей работы в цикле
    var i; // Объявляем переменную для дальнейшей работы в цикле
    for (i = 1; i < id; i++){
        var names = "name" + i; // Присваиваем переменной "names" значения "name" + i (где i - меняющаяся цифра в цикле)
        name += $("#" + names).val() + ";"; // Записываем все данные с полей без перезаписывания и в конце добавляем точку с запятой
    }

    var regex_car = new RegExp("[а-яА-Я]\\d{3}[а-яА-Я]{2}\\d{2,3}"); // Проверка на правильность введения автомобильного номера
    var regex_trailer = new RegExp("[а-яА-Я]{2}\\d{4}\\d{2,3}"); // Проверка на правильность введения трейлерного номера
    car_number_regex = regex_car.test(car_number); // Проверяем
    trailer_number_regex = regex_trailer.test(trailer_number); // Проверяем

    if ($("#checkbox").prop("checked")){ // Если чекбокс отмечен
        if (car_number_regex === true && trailer_number_regex === true){
            // Делаем запрос на скрипт "data.php" со следующими параметрами
            // car_number - Номер автомобиля
            // full_name - ФИО Водителя
            // trailer_number - Номер трейлера
            // name - ФИО пассажиров
            $.post(
                "/data.php",
                {
                    car_number: car_number,
                    full_name: full_name,
                    trailer_number: trailer_number,
                    name: name
                },
                onAjaxSuccess
            );

            // Получаем результат со скрипта data.php
            function onAjaxSuccess(data) {
                var response = JSON.parse(data);
                if (response.response === true){
                    // Если сервер ответил true
                    swal("Успех!", "Данные были добавлены в базу данных!", "success");
                } else {
                    // Если сервер ответил false
                    swal("Ошибка!", "Данные не были добавлены в базу данных!", "error");
                }
            }
        } else {
            // Если поля не были заполнены, или они не прошли проверку на правильность
            swal("Ошибка!", "Некоторые поля не были заполнены, либо были заполнены неправильно!", "error");
        }
    } else {
        if (car_number_regex === true){
            // Делаем запрос на скрипт "data.php" со следующими параметрами
            // car_number - Номер автомобиля
            // full_name - ФИО Водителя
            // name - ФИО пассажиров
            $.post(
                "/data.php",
                {
                    car_number: car_number,
                    full_name: full_name,
                    name: name
                },
                onAjaxSuccess1
            );

            // Получаем результат со скрипта data.php
            function onAjaxSuccess1(data) {
                var response = JSON.parse(data);
                if (response.response === true){
                    // Если сервер ответил true
                    swal("Успех!", "Данные были добавлены в базу данных!", "success");
                } else {
                    // Если сервер ответил false
                    swal("Ошибка!", "Данные не были добавлены в базу данных!", "error");
                }
            }
        } else {
            // Если поля не были заполнены, или они не прошли проверку на правильность
            swal("Ошибка!", "Некоторые поля не были заполнены, либо были заполнены неправильно!", "error");
        }
    }
});
// Занесение всех данных в БД