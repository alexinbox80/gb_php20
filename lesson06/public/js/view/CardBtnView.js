export default class CardBtnView {
    constructor(goodCount) {
        this._data = goodCount;
      //  this._addHandlerCb = null;
    }

    getHtml() {
        let countContent;

        if (parseInt(this._data) === 0) {
            countContent = `<span class=""></span>`;
        } else {
            countContent = `<span class="header__cart-count">${this._data}</span>`;
        }

        return countContent;
    }

    render($container, target = 'afterbegin') {

        $container.insertAdjacentHTML(target, this.getHtml());
/*
        if (this._addHandler) {

            const addBtn = $container.querySelector(`#card-${this._data.id}`);

            addBtn.addEventListener('click', this._addHandler.bind(this));
        }*/
    }

 /*   _addHandler() {
        this._addHandlerCb(this._data.id);
    }

    setAddHandler(callback) {

        this._addHandlerCb = callback;

    }
*/
}
