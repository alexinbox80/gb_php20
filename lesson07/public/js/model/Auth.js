import dataHandler from "../helpers/dataHandler.js";
import Routes from "./Routes.js";

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

    _formMesageRender(elementId, message) {
        const noteForm = document.getElementById(elementId);

        if (noteForm) {
            const target = 'beforeend';

            noteForm.textContent = '';
            noteForm.insertAdjacentHTML(target, message);
        }
    }

    _handleLoginClick(currentPage) {
        return ((event) => {
            const formFields = {
                'authLogin': Auth._getFormLogin(),
                'authPasswd': Auth._getFormPasswd(),
                'authRemember-me': Auth._getRemMe(),
                'page': currentPage,
                'act': 'action-login'
            };

            dataHandler.auth(dataHandler, formFields).then(item => {
                if (item.status === 'error') {
                    this._formMesageRender('note', item.info);
                }

                if (item.status === 'ok') {
                    document.location.href = new Routes().getPath(currentPage).url;
                }
            });
        })
    }

    loginForm(page) {
        const button = document.getElementById('loginSubmit');

        if (button) {
            button.addEventListener('click', this._handleLoginClick(page));
        }
    }
}
