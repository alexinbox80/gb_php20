$(document).ready(function () {

    let registrationHandler = "../controllers/registration.php";

    let user = [];

    $('.login__menu').hide();

    $("#registrationSubmit").click(
        function () {
            sendRegistrationForm('regnote', 'registrationForm', registrationHandler, user);
            return false;
        }
    );

});

let formerr = "Send form error!";

function sendRegistrationForm(result_form, ajax_form, url, user) {

    $.ajax({
        url: url, //url страницы
        type: "POST", //метод отправки
        dataType: "html", //формат данных
        data: $("#" + ajax_form).serialize(),  // Сеарилизуем объект

        success: function (response) { //Данные отправлены успешно

            let answer = JSON.parse(response);

            if (answer.hasOwnProperty('userId')) {
                 user.userId = answer.userId;
            }

            if (answer['loginSuccess']) {
                location.href = answer['urlPath'];
            }

            if (!answer['loginSuccess']) {
                $("#" + result_form).html('<div class="err">' + answer['errorMessage'] + '</div>');
            }

            $(function () {
                 setTimeout(function () {
                     $(".ok").fadeOut(1500);
                 }, 1500);
                 setTimeout(function () {
                     $(".err").fadeOut(1500);
                 }, 1500);
            });

        },

        error: function (response) { // Данные не отправлены
            $("#" + result_form).html('<div class="err">' + formerr + '</div>');
        }
    });
}

