export default class Good {
    constructor({good_id, title, description, image, price, size, color, discount}) {
        //this._id = id;
        this._good_id = good_id;
        this._title = title;
        this._description = description;
        this._image = image;
        this._price = price;
        this._size = size;
        this._color = color;
        this._discount = discount;
    }

    //get id() { return this._id; }

    get good_id() { return this._good_id; }

    get title() { return this._title; }

    get description() { return this._description; }

    get image() { return this._image; }

    get price() { return this._price; }

    get size() { return this._size; }

    get color() { return this._color; }

    get discount() { return this._discount; }

}
