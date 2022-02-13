import GoodList from './GoodList.js';
import dataHandler from '../helpers/dataHandler.js'
import Good from './Good.js';

export default class Catalog extends GoodList {
    constructor() {
        super();
    }

    load() {
        return super.load(dataHandler.getShowcase.bind(dataHandler), Good);
    }

    request(list) {

        dataHandler.getCatalog(dataHandler, list);
    }

}
