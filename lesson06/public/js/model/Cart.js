import GoodList from './GoodList.js';
import dataHandler from '../helpers/dataHandler.js'
import PurchasedGood from './PurchasedGood.js';

export default class Cart extends GoodList {
    constructor() {
        super();
    }

    load() {
        super.load(dataHandler.getCart.bind(dataHandler), PurchasedGood);
    }

    save(cart) {
        //let saveGood = {userId: 'this user Id', goodId: good.goodId, quantity: good.quantity, timeCreate: Date.now()};

        //console.log('save cart item arr count : ' + cart.length + ' save cart : ' + JSON.stringify(cart));

        //console.log('save good : ' + JSON.stringify(saveGood));
        //console.log('dataHandler : ' + dataHandler.addToCart(dataHandler, cart));
        //super.save(dataHandler.addToCart.bind(dataHandler, cart), cart);
        dataHandler.addToCart(dataHandler, cart);

    }


    add(good) {

        const findGood = this._goodList.find(item => item.goodId === good.goodId);

        if (findGood) {

            findGood.add();

        } else {

            super.add(good);

        }
        //console.log('goodCount : ' + this.getCount() + ' goodList : ' + JSON.stringify(this._goodList));

        this._eventEmmiter.emit('added', good.goodId);

        // добавить в базу вместо this._save()???
    }

    decrease(id) {
        console.log('decrease : ' + id);
        const findGood = this._goodList.filter(item => item.goodId === id);

        if(findGood.quantity > 1) {
            findGood.remove();
        } else {
            super.remove(id);
        }
        this._eventEmmiter.emit('removed', id);

        // удалить из базы

    }

    getCount() {
        return this._goodList.reduce((acc, good) => acc + good.quantity, 0);
    }
}