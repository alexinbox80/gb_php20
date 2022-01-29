$(document).ready(function () {
    let listHandler = "../controller/getList.php";
    let listBegin = 10;

    $("#buttonMore").click(
        function () {

            let listCount = parseInt(document.getElementById("listCount").value);

            let todo = {todo: "getList", listBegin: listBegin, listCount: listCount};

            listBegin += listCount;

            getList('note', todo, listHandler);
            return false;
        }
    );
});

function getHtml(answer) {
    return `<li class="gallery__item">
                <div class="gallery__id">
                    ${answer.id}
                </div>
                <div class="gallery__image">
                    <img class="gallery__pic" src="pics/${answer.photo}" alt="">
                </div>
                <div class="gallery__text">
                    <span class="gallery__title">Title: ${answer.title}</span>
                    <span class="gallery__price">Price: $${answer.price}</span>
                </div>
            </li>`;
}

function render(container, target = 'beforeend', value) {
    value.forEach(
        element => container.insertAdjacentHTML(target, getHtml(element))
    );
}

function getList(result_form, todo, url) {

    $.ajax({
        url: url, //url страницы
        type: "POST", //метод отправки
        dataType: "html", //формат данных
        data: todo,  //

        success: function (response) { //Данные отправлены успешно
            let answer = JSON.parse(response);

            if (answer.err) {
                $("#" + result_form).html('<div class="err">' + answer.err + '</div>');
            } else {
                //showList = answer;

                if (answer.length > 0) {
                    //console.log(' -> ' + JSON.stringify(answer));

                    const cartList = document.querySelector('.gallery');

                    if (cartList) {
                        render(cartList, 'beforeend', answer);
                        window.scrollTo(0, document.body.scrollHeight);
                    }
                } else {
                    $("#" + result_form).html('<div class="err">List is Empty!</div>');
                }
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
            $("#" + result_form).html('<div class="err">Send form error!</div>');
        }
    });
}
