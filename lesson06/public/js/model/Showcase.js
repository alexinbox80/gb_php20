import GoodList from './GoodList.js';
import dataHandler from '../helpers/dataHandler.js'
import Good from './Good.js';

export default class Showcase extends GoodList {
    constructor() {
        super();
    }

    load() {
        return super.load(dataHandler.getShowcase.bind(dataHandler), Good);
    }

}