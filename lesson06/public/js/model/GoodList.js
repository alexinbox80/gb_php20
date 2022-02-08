import eventEmmiter from '../helpers/eventEmmiter.js';


export default class GoodList {

    constructor() {
        this._goodList = [];
        this._eventEmmiter = eventEmmiter;
    }

    load(callback, goodClass){

        callback().then(data => {

            this._goodList = data.map(item => new  goodClass(item));

            this._eventEmmiter.emit('loaded');

        });

    }

    // save(callback, goodClass){
    //
    //     console.log('callback ' + callback);
    //     console.log('goodClass ' + JSON.stringify(goodClass));
    //
    //     callback().then(data => {
    //
    //         console.log('data : ' + data);
    //
    //         data.map(item => new  goodClass(item));
    //
    //         this._eventEmmiter.emit('saved');
    //
    //     });
    //
    // }

    add(good) {

        this._goodList.push(good);
    }

    remove(id) {
        this._goodList =  this._goodList.filter(good => good.goodId !== id);
        return this._goodList;
    }

    get(id) {
        return this._goodList.find(good => good.id == id);
    }

    getAll() {
        return this._goodList;
    }

    getById(id) {
        return this._goodList.find(good => good.id === id);
    }

    getSumGoodsList() {

        const sumGoodsList = this.goods.reduce((acc, num) => acc + num.price, 0);

        return sumGoodsList;
    }

}
