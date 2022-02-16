import eventEmmiter from './helpers/eventEmmiter.js';
import Cart from './model/Cart.js';
import Showcase from './model/Showcase.js';
import Catalog from './model/Catalog.js';

import PurchasedGood from './model/PurchasedGood.js';
import CardView from './view/CardView.js';
import CardBtnView from "./view/CardBtnView.js";

import CartView from "./view/CartView.js";

import Routes from './model/Routes.js';
import Auth from './model/Auth.js';
import Regs from './model/Regs.js';

export default {
    _eventEmmiter: eventEmmiter,
    _showcaseModel: new Showcase,
    _catalogModel: new Catalog,
    _cartModel: new Cart,
    _authModel: new Auth,
    _regsModel: new Regs,

    init() {
        this._routes();

        this._eventEmmiter.addListener('added', this._renderCart.bind(this));
        this._eventEmmiter.addListener('removed', this._renderCart.bind(this));


        //this._eventEmmiter.addListener('loaded', this._renderCart.bind(this));
        //this._eventEmmiter.addListener('loaded', this._renderShowcase.bind(this));
        //this._eventEmmiter.addListener('loaded', this._renderPageCart.bind(this));

        //this._cartModel.load();
        //this._showcaseModel.load();
////

        //this._loginBtnHandler();

    },
    _getCookie(cookieName) {
        let cookie = {};
        document.cookie.split(';').forEach(function (el) {
            let [key, value] = el.split('=');
            cookie[key.trim()] = value;
        });
        return cookie[cookieName];
    },
    _addToCart(id) {

        let saveCart = [];

        const good = new PurchasedGood(this._showcaseModel.get(id));

        this._cartModel.add(good);

        saveCart = this._cartModel._goodList.map(good => {
            return {
                user_id: this._getCookie('user_id'),
                good_id: good.good_id,
                quantity: good.quantity,
                timeCreate: Date.now()
            }
        });

        this._cartModel.save(saveCart);
    },

    _getCatalog() {

        //let saveCart = [];

        //const good = new PurchasedGood(this._showcaseModel.get(id));

        //this._cartModel.add(good);

        // saveCart = this._cartModel._goodList.map(good => {
        //     return {
        //         user_id: 'c08b32be-1677-443c-bf00-877291354c93',
        //         good_id: good.good_id,
        //         quantity: good.quantity,
        //         timeCreate: Date.now()
        //     }
        // });

        const list = {
            begin: 0,
            offset: 20
        };

        this._catalogModel.load(list);
    },


    _removeFromCart(id) {

        console.log('remove : ' + id);

        //this._cartModel.remove(id);

        this._cartModel.decrease(id);

        console.log('_removeFromCart : ' + JSON.stringify(this._eventEmmiter));

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
    },

    _renderCatalog() {
        //console.log('renderCatalog');
        const product = document.querySelector('.products__box');

        if (product) {
            product.textContent = '';

            console.log('renderCatalog' + this._catalogModel.getAll());

            this._catalogModel.getAll().forEach(
                good => {
                    const card = new CardView(good);
                    card.render(product, 'beforeend');
                    card.setAddHandler(this._getCatalog().bind(this));
                }
            );
        }
    },

    _routes() {

        let pathname = window.location.pathname + window.location.search.split('&')[0];
        const node = new Routes().getNode(pathname);

        //console.log('pathname = ' + pathname);

        //console.log('node url : ' + node.url + ' node name : ' + node.page);

        switch (node.page) {
            case 'index':
                console.log("root page : " + pathname + ' node : ' + node.page);

                this._loginBtnHandler(node.page);

                this._eventEmmiter.addListener('loaded', this._renderShowcase.bind(this));
                this._eventEmmiter.addListener('loaded', this._renderCart.bind(this));

                this._showcaseModel.load();
                this._cartModel.load();
                break;
            case 'cart':
                console.log("about page : " + pathname + ' node : ' + node.page);
                this._loginBtnHandler(node.page);
                this._eventEmmiter.addListener('loaded', this._renderPageCart.bind(this));
                this._eventEmmiter.addListener('loaded', this._renderCart.bind(this));
                this._cartModel.load();
                break;
            case 'product':
                console.log("home page : " + pathname + ' node : ' + node.page);
                this._loginBtnHandler(node.page);
                this._eventEmmiter.addListener('loaded', this._renderShowcase.bind(this));
                this._eventEmmiter.addListener('loaded', this._renderCart.bind(this));

                this._showcaseModel.load();
                //this._catalogModel.request({ begin: 0, offset: 3 });
                this._cartModel.load();
                break;
            case 'catalog':
                console.log("home page : " + pathname + ' node : ' + node.page);
                this._loginBtnHandler(node.page);
                //this._eventEmmiter.addListener('loaded', this._renderShowcase.bind(this));

                //this._eventEmmiter.addListener('loaded', this._renderCatalog.bind(this));
                this._eventEmmiter.addListener('loaded', this._renderCart.bind(this));

                //this._showcaseModel.load();

                this._catalogModel.request({begin: 0, offset: 20});
                this._cartModel.load();
                break;
            case 'reg':
                console.log("home page : " + pathname + ' node : ' + node.page);
                this._loginBtnHandler(node.page);
                this._eventEmmiter.addListener('loaded', this._renderCart.bind(this));
                this._cartModel.load();
                this._regsModel.registrationForm();
                break;
            case 'admin':
                console.log("home page : " + pathname + ' node : ' + node.page);
                this._loginBtnHandler(node.page);
                this._eventEmmiter.addListener('loaded', this._renderCart.bind(this));
                this._cartModel.load();
                break;
            default:
                console.log("Unknown path : " + pathname);
        }
    },

    _loginBtnHandler(page) {
        this._authModel.loginForm(page);
    }
}
