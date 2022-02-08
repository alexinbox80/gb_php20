export default {
    _url: '/lesson08/task/api/v1/',

    // getCatalog(errorCallBack) {
    //     return fetch(`${this._url}catalogData.json`)
    //         .then((response) => {
    //             if (response.ok) {
    //                 //return response.data;
    //
    //                 return response.json();
    //             } else {
    //                 return errorCallBack(response.status);
    //             }
    //         })
    //         .then((data) => data)
    //         .catch((error) => {
    //             return errorCallBack(error);
    //         })
    // },

    getCatalog(errorCallBack) {
        return fetch(`${this._url}jsonServer.php`, {
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
        return fetch(`${this._url}jsonServer.php`, {
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
        //console.log('data : ' + JSON.stringify(data));
        return fetch(`${this._url}jsonServer.php`, {
            method: 'POST',
            //body: data
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
