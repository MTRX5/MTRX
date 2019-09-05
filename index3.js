// Авторизация
$("#auth").click(function () {
    var login = $("#login").val();
    var password = $("#password").val();
    $.post('/auth.php',
        {
            login: login,
            password: password
        },
        response
    );

    function response(data) {
        response = JSON.parse(data);
        if (response.response === true){
            // Перенаправление
            window.location.replace("/menu");
        } else {
            swal({
                title: "Ошибка!",
                text: "Неправильный логин или пароль!",
                icon: "error",
            });
        }
    }
});

// Регистрация
$("#reg").click(function () {
    var login = $("#login").val();
    var password = $("#password").val();
    $.post('/reg.php',
        {
            login: login,
            password: password
        },
        response
    );

    function response(data) {
        response = JSON.parse(data);
        if (response.response === true){
            // Перенаправление
            window.location.replace("/menu");
        } else {
            swal({
                title: "Ошибка!",
                text: "Данный логин занят",
                icon: "error",
            });
        }
    }
});

$("#addRequest").click(function () {
    window.location.replace("/addrequest");
});

$("#listRequest").click(function () {
    window.location.replace("/table");
});