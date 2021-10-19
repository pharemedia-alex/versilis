//import ClosestPolyfill from './ClosestPolyfill';
//import '@babel/polyfill';
import 'intersection-observer';
/* eslint-disable no-unused-vars */
//import Stickyfill from 'stickyfilljs/dist/stickyfill.es6';
//import objectFitImages from 'object-fit-images';

export default class Polyfills {
    constructor() {
        // Objectfit cover polyfill (for ie11)
        // git: https://github.com/fregante/object-fit-images
        //objectFitImages(document.querySelectorAll('.o-object-fit'));

        // https://github.com/wilddeer/stickyfill
        // Stickyfill.add(document.querySelectorAll('.o-sticky'));

        //new ClosestPolyfill();
    }
}

