import nodes from '../helpers/Nodes.js';
export default class Routes {

    constructor() {
        this._nodes = nodes();
    }

    getNodes() {
        return this._nodes;
    }

    getNode(pathname) {
        return this._nodes.filter(item => item.url === pathname)[0];
    }

}
