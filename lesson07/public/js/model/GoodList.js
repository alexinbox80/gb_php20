import eventEmmiter from '../helpers/eventEmmiter.js';

export default class GoodList {

    constructor() {
        this._goodList = [];
        this._eventEmmiter = eventEmmiter;
    }

    load(callback, goodClass){

        callback().then(data => {

            this._goodList = data.map(item => new  goodClass(item, parseInt(item.quantity)));

            this._eventEmmiter.emit('loaded');

        });
    }

    add(good) {

        this._goodList.push(good);
    }

    remove(id) {
        this._goodList =  this._goodList.filter(good => good.good_id !== id);
        return this._goodList;
    }

    get(id) {
        return this._goodList.find(good => good.good_id == id);
    }

    getAll() {
        return this._goodList;
    }

    getById(id) {
        return this._goodList.find(good => good.good_id === id);
    }

    getSumGoodsList() {

        return  this._goodList.reduce((acc, num) => acc + num.price, 0);
    }
}
