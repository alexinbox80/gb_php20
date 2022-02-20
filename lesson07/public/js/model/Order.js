import dataHandler from "../helpers/dataHandler.js";
import getUuid from "../utils/getUuid.js";

export default class Order {

    static _getFormCity() {
        return document.getElementsByName('shippingCity')[0].value;
    }

    static _getFormState() {
        return document.getElementsByName('shippingState')[0].value;
    }

    static _getFormZip() {
        return document.getElementsByName('shippingZip')[0].value;
    }

    static _getFormPhone() {
        return document.getElementsByName('shippingPhone')[0].value;
    }

    _formMesageRender(elementId, message) {
        const noteForm = document.getElementById(elementId);

        if (noteForm) {
            const target = 'beforeend';

            noteForm.textContent = '';
            noteForm.insertAdjacentHTML(target, message);
        }
    }

    _handleOrderClick() {
        return ((event) => {
            console.log('Shiping Handler');

            const address = {
                'shippingCity': Order._getFormCity(),
                'shippingState': Order._getFormState(),
                'shippingZip': Order._getFormZip(),
                'shippingPhone': Order._getFormPhone(),
                'user_id': getUuid.getCookie('user_id'),
                'amount': 5,
                'price': 25.5
            };

            const order = address;

            dataHandler.setOrder(dataHandler, order).then(item => {
                if (item.status === 'error') {
                    this._formMesageRender('ordernote', item.message);
                }


                if (item.status === 'ok') {
                    this._formMesageRender('ordernote', item.message);
                    //document.location.href = new Routes().getPath(currentPage).url;
                }
            });
        })
    }

    makeOrder() {
        const button = document.getElementById('cart__shipping-proceed');

        if (button) {
            button.addEventListener('click', this._handleOrderClick());
        }
    }
}