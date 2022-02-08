$(document).ready(function () {

    let loginHandler = "../controllers/login.php";

    let user = [];

    function getCookie(cookieName) {
        let cookie = {};

        document.cookie.split(';').forEach(function (el) {
            let [key, value] = el.split('=');
            cookie[key.trim()] = value;
        });

        return cookie[cookieName];
    }

    function decodeBase64(s) {
        let e = {}, i, b = 0, c, x, l = 0, a, r = '', w = String.fromCharCode, L = s.length;
        let A = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789+/";

        for (i = 0; i < 64; i++) {
            e[A.charAt(i)] = i;
        }

        for (x = 0; x < L; x++) {
            c = e[s.charAt(x)];
            b = (b << 6) + c;
            l += 6;
            while (l >= 8) {
                ((a = (b >>> (l -= 8)) & 0xff) || (x < (L - 2))) && (r += w(a));
            }
        }
        return r;
    }

    let cookie = getCookie('site');

    if (typeof cookie !== 'undefined') {
        cookie = PHPUnserialize.unserialize(decodeBase64(cookie));

        $("#loginName").val(cookie['login']);
        $("#loginPasswd").val(cookie['passwd']);
        $("#loginRemember").prop('checked', true);


        console.log('user = ' + JSON.stringify(user));

        console.log('user cookie = ' + JSON.stringify(cookie.userId));
    }

    $("#loginSubmit").click(
        function () {
            sendLoginForm('note', 'loginForm', loginHandler, user);
            return false;
        }
    );

    // $("#map_formSend").click(
    //     function () {
    //         sendAjaxForm('map_note', 'map_contact', formurl);
    //         return false;
    //     }
    // );
});

//let formok = "Send Ok";

let formerr = "Send form error!";

function sendLoginForm(result_form, ajax_form, url, user) {

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

            //console.log("answer = " + JSON.stringify(answer));

            //console.log("user.userId = " + user.userId);


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

