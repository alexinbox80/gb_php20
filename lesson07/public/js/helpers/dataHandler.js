export default {
    _url: 'index.php',
    getShowcase(errorCallBack) {
        return fetch(`${this._url}?page=index&action=goods&lbgn=0&lcnt=6&asAjax=true`)
            .then((response) => {
                if (response.ok) {
                    //return response.data;

                    return response.json();
                } else {
                    return errorCallBack(response.status);
                }
            })
            .then((data) => data)
            .catch((error) => {
                return errorCallBack(error);
            })
    },

    getCatalog(errorCallBack) {
        return fetch(`${this._url}?page=index&action=goods&asAjax=true`, {
            method: 'POST',
            //mode: "cors",
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({todo: 'getGoods'})
        })
            .then((response) => {
                if (response.ok) {
                    //return response.data;
                    return response.json();
                } else {
                    return errorCallBack(response.status);
                }
            })
            .then((data) => data)
            .catch((error) => {
                return errorCallBack(error);
            })
    },
    getCart(errorCallBack) {
        //return fetch(`${this._url}getCart.json`)
        return fetch(`${this._url}?page=index&action=cart&asAjax=true`, {
            method: 'POST',
            //mode: "cors",
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({todo: 'getCart'})
        })
            .then((response) => {
                if (response.ok) {
                    return response.json();
                } else {
                    return errorCallBack(response.status);
                }
            })
            .then((data) => data)
            .catch((error) => {
                return errorCallBack(error);
            })
    },

    addToCart(errorCallBack, data) {
        return fetch(`${this._url}?page=index&action=changeCart&asAjax=true`, {
            method: 'POST',
            body: JSON.stringify({todo: 'addToCart', cart: data})
        })
            .then((response) => {
                if (response.ok) {
                    return true;
                } else {
                    return errorCallBack(response.status);
                }
            })
            .catch((error) => {
                return errorCallBack(error);
            })
    },
    delFromCart(errorCallBack, data) {
        return fetch(`${this._url}?page=index&action=changeCart&asAjax=true`, {
            method: 'POST',
            body: JSON.stringify({todo: 'delFromCart', cart: data})
        })
            .then((response) => {
                if (response.ok) {
                    return true;
                } else {
                    return errorCallBack(response.status);
                }
            })
            .catch((error) => {
                return errorCallBack(error);
            })
    },
    deleteFromCart(errorCallBack, id) {
        return fetch(`${this._url}deleteFromCart`, {
            method: 'DELETE',
            body: {id: id}
        })
            .then((response) => {
                if (response.ok) {
                    return true;
                } else {
                    return errorCallBack(response.status);
                }
            })
            .catch((error) => {
                return errorCallBack(error);
            })
    }
}
