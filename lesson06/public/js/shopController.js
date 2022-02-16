import eventEmmiter from './helpers/eventEmmiter.js';
import Cart from './model/Cart.js';
import Showcase from './model/Showcase.js';

import PurchasedGood from './model/PurchasedGood.js';
import CardView from './view/CardView.js';
import CardBtnView from "./view/CardBtnView.js";

import CartView from "./view/CartView.js";

export default {
    _eventEmmiter: eventEmmiter,
    _showcaseModel: new Showcase,
    _cartModel: new Cart,

    init() {

        this._eventEmmiter.addListener('added', this._renderCart.bind(this));
        this._eventEmmiter.addListener('removed', this._renderCart.bind(this));


        this._eventEmmiter.addListener('loaded', this._renderCart.bind(this));
        this._eventEmmiter.addListener('loaded', this._renderShowcase.bind(this));
        this._eventEmmiter.addListener('loaded', this._renderPageCart.bind(this));

        this._cartModel.load();
        this._showcaseModel.load();

    },

    _addToCart(id) {

        let saveCart = [];

        const good = new PurchasedGood(this._showcaseModel.get(id));
        //const good = new PurchasedGood(this._showcaseModel.get(id), this._showcaseModel.getById(id).quantity);

        this._cartModel.add(good);

        //console.log('cartCount : ' + this._cartModel.getCount());

        // this._cartModel._goodList.forEach(
        //     good => {
        //         console.log(good);
        //         saveCart.push({
        //             userId: '81245312-a273-0c97-04e8-f99b5b199795',
        //             good_id: good.good_id,
        //             quantity: good.quantity,
        //             timeCreate: Date.now()
        //         });
        //     }
        // );

        // saveCart = this._cartModel._goodList.map(function(item) {
        //     return ({
        //         userId: '81245312-a273-0c97-04e8-f99b5b199795',
        //         good_id: item.good_id,
        //         quantity: item.quantity,
        //         timeCreate: Date.now()
        //     });
        // });

        saveCart = this._cartModel._goodList.map(good => {
            return {
                user_id: '81245000-a273-0c97-04e8-f99b5b199795',
                good_id: good.good_id,
                quantity: good.quantity,
                timeCreate: Date.now()
            }
        });

        this._cartModel.save(saveCart);
    },

    _removeFromCart(id) {

        console.log('remove : ' + id);

        //this._cartModel.remove(id);

        this._cartModel.decrease(id);

        console.log('_removeFromCart : ' +  JSON.stringify(this._eventEmmiter));

     //save state in BD????


        //remove item cart from cart page
        this._renderPageCart();
        //this._renderCart();
    },

    _renderCart() {
        const header = document.querySelector('#header__cart');

        const oldBtn = document.querySelector('.header__cart-count');

        if (oldBtn) {

            oldBtn.remove();

        }

        if (header) {
            new CardBtnView(this._cartModel.getCount()).render(header, 'afterbegin');
        }

    },

    _renderPageCart() {
        const cartList = document.querySelector('.cart__cards');

        if (cartList) {

            cartList.textContent = '';

            this._cartModel._goodList.forEach(
                good => {
                    //console.log(good);
                    const cart = new CartView(good);
                    cart.render(cartList, 'afterbegin');
                    cart.setAddHandler(this._removeFromCart.bind(this, good.good_id));
                }
            );
        }

        const totalPriceSpan = document.querySelector('.cart__account-tprice');
        if (totalPriceSpan) {

            totalPriceSpan.textContent = '';
            const totalSum = this._cartModel.getSumGoodsList();
            totalPriceSpan.insertAdjacentHTML('beforeend', '$' + totalSum);

        }
    },

    _renderShowcase() {
        const product = document.querySelector('.products__box');

        if (product) {
            product.textContent = '';

            this._showcaseModel.getAll().forEach(
                good => {
                        const card = new CardView(good);
                        card.render(product, 'beforeend');
                        card.setAddHandler(this._addToCart.bind(this));
                    }
            );
        }
    }
}
