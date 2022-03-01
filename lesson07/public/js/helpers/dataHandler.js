export default {
    _url: 'index.php',
    getShowcase(errorCallBack, data) {
        return fetch(`${this._url}?path=Ajax&action=router&lbgn=0&lcnt=6&asAjax=true`, {
        //return fetch(`${this._url}?path=index&action=goods&lbgn=` + data.begin + `&lcnt=` + data.offset + `&asAjax=true`, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({todo: 'getCatalog'})
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
    getCatalog(errorCallBack, data) {
        return fetch(`${this._url}?path=ajax&action=router&lbgn=` + data.begin + `&lcnt=` + data.offset + `&asAjax=true`, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({todo: 'getCatalog'})
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
    getCart(errorCallBack) {
        return fetch(`${this._url}?path=Ajax&action=router&asAjax=true`, {
            method: 'POST',
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
        return fetch(`${this._url}?path=Ajax&action=router&asAjax=true`, {
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
        return fetch(`${this._url}?path=Ajax&action=router&asAjax=true`, {
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
    // deleteFromCart(errorCallBack, id) {
    //     return fetch(`${this._url}deleteFromCart`, {
    //         method: 'DELETE',
    //         body: {id: id}
    //     })
    //         .then((response) => {
    //             if (response.ok) {
    //                 return true;
    //             } else {
    //                 return errorCallBack(response.status);
    //             }
    //         })
    //         .catch((error) => {
    //             return errorCallBack(error);
    //         })
    // },
    auth(errorCallBack, data) {
        return fetch(`${this._url}?path=Ajax&action=router&asAjax=true`, {
            method: 'POST',
            body: JSON.stringify({todo: 'auth', form: data})
        })
            .then((response) => {
                if (response.ok) {
                    return response.json();
                } else {
                    return errorCallBack(response.status);
                }
            })
            .catch((error) => {
                return errorCallBack(error);
            })
    },
    regs(errorCallBack, data) {
        return fetch(`${this._url}?path=Ajax&action=router&asAjax=true`, {
            method: 'POST',
            body: JSON.stringify({todo: 'regs', form: data})
        })
            .then((response) => {
                if (response.ok) {
                    return response.json();
                } else {
                    return errorCallBack(response.status);
                }
            })
            .catch((error) => {
                return errorCallBack(error);
            })
    },
    setOrder(errorCallBack, data) {
        return fetch(`${this._url}?path=Ajax&action=router&asAjax=true`, {
            method: 'POST',
            body: JSON.stringify({todo: 'setOrder', form: data})
        })
            .then((response) => {
                if (response.ok) {
                    return response.json();
                } else {
                    return errorCallBack(response.status);
                }
            })
            .catch((error) => {
                return errorCallBack(error);
            })
    }
}
