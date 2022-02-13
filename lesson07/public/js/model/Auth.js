import dataHandler from "../helpers/dataHandler.js";

export default class Auth {

    static _getFormLogin() {
        return document.getElementsByName('authLogin')[0].value;
    }

    static _getFormPasswd() {
        return document.getElementsByName('authPasswd')[0].value;
    }

    static _getRemMe() {
        const formRemember = document.getElementById('loginRemember');

        let formChecked = 0;

        if (formRemember.checked) {
            formChecked = 1;
        }

        return formChecked;
    }

    _handleClick() {
        const formFields = {
            'authLogin' : Auth._getFormLogin(),
            'authPasswd' : Auth._getFormPasswd(),
            'authRemember-me' : Auth._getRemMe(),
            'act' : 'action-login'
        };

        dataHandler.auth(dataHandler, formFields);
    }

    loginForm() {
        const button = document.getElementById('loginSubmit');

        if (button) {
            button.addEventListener('click', this._handleClick);
        }
    }
}
