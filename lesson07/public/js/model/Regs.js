import dataHandler from "../helpers/dataHandler.js";

export default class Regs {

    static _getFirstName() {
        return document.getElementsByName('firstName')[0].value;
    }

    static _getSecondName() {
        return document.getElementsByName('lastName')[0].value;
    }

    static _getEmail() {
        return document.getElementsByName('email')[0].value;
    }

    static _getGender() {
        const radios = document.getElementsByName('sex');

        let result;

        for (let i = 0, length = radios.length; i < length; i++) {
            if (radios[i].checked) {
                // do whatever you want with the checked radio
                result = radios[i].value;

                // only one radio can be logically checked, don't check the rest
                break;
            }
        }
        return result;
    }

    static _getLogin() {
        return document.getElementsByName('regLogin')[0].value;
    }

    static _getPasswd() {
        return document.getElementsByName('regPasswd')[0].value;
    }

    _handleRegsClick() {
        const formFields = {
            'firstName': Regs._getFirstName(),
            'secondName': Regs._getSecondName(),
            'email': Regs._getEmail(),
            'sex': Regs._getGender(),
            'login': Regs._getLogin(),
            'passwd': Regs._getPasswd()
        };

        dataHandler.regs(dataHandler, formFields).then(item => {
            console.log('answ : ' + JSON.stringify(item));

        });
    }

    registrationForm() {
        const button = document.getElementById('registrationSubmit');

        if (button) {
            button.addEventListener('click', this._handleRegsClick);
        }
    }
}
