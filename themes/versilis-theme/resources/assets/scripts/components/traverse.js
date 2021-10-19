/**
*  - Traverse -
*  Based on Sal.js
*  Sal - Scroll Animation Library - Created by Mirek Ciastek. Released under the MIT License.
*  Performance focused, lightweight scroll animation library
*  Detect element in viewport with IntersectionObserver
*
* params : debug (add border on intersection observer - current listener)
*
* create scss file with traverse-debug
*
* tutorial and explanation of rootMargin with examples: https://www.hweaver.com/intersection-observer-single-page-navigation/
* custom use of intersection observer: https://css-tricks.com/a-few-functional-uses-for-intersection-observer-to-know-when-an-element-is-in-view/
* check: https://github.com/camwiegert/in-view
*/

const traverse_default_options = {
  default: {
      selector: '[data-traverse]',
      //add delay
      effect: 'slide-up',
      once: true,
      delay: 0.4,
      config: {
          rootMargin: '0px 0px -200px 0px',
          threshold: 0,
      },
      callback: false,
      debug: false,
  },
};

export default class Traverse {

  constructor (options = traverse_default_options) {
    
    this.options = options.concat(traverse_default_options); //options defined and default
    this._intersectingAttribute = 'data-traverse'; //private

    console.log('init Traverse');
    this.observeIntersection();
  }

  observeIntersection()
  {
    let options = this.options;
    
    for (let key in options) {
      let listener = options[key];
      let intersection_options = listener.config;
      let debug_mode = listener.debug;

      let intersectionObserver = new IntersectionObserver(
        (entries, observer) => {
          entries.forEach(entry => {
          //debug
          if(debug_mode) {
            this._debugAddLayout(entry, intersection_options);
          }
        });
        this._onIntersect(entries, observer, listener);

      }, intersection_options);
      
      //assign intersectionObserver to selectors
      let selected_nodes = document.querySelectorAll(listener.selector);
      Array.from(selected_nodes).forEach(
        element => {
          intersectionObserver.observe(element)
          if ( !element.hasAttribute(this._intersectingAttribute) ){
            element.setAttribute(this._intersectingAttribute, '');
          }
        }
      )
    }
  
  }

  _onIntersect(entries, observer = IntersectionObserver, listener = listener)
  {
    let delay = 0;

    for (let key in entries) {
      let entry = entries[key];
      let el = entry.target;
      let isIntersecting = entry.isIntersecting;
      let intersectOnce = listener.once;
      let debug_mode = listener.debug;
      let callback = listener.callback;

      if (isIntersecting === true){
        //add delay based on top of element
        if (listener.delay) {
          let elBoundingRect = el.getBoundingClientRect();
          delay = Math.abs(elBoundingRect.left * listener.delay + elBoundingRect.top * listener.delay);
          //add transition delay instead of setTimeout to delay all elements
          el.style.transitionDelay = delay/1000 + 's';
        }

        this._entering(el);
        if (callback) {
          //root.classList.add('traverse-callback');
        }
        if(debug_mode) {
          console.log('Element => '+el.classList+' is entering in view');
        }
      }

      else if (isIntersecting === false && !intersectOnce) {
        this._leaving(el);

        if (callback) {
          //root.classList.remove('traverse-callback');
          /*if (el.hasAttribute('data-callback')) {
            let callbackData = el.getAttribute('data-callback');
            if (callbackData!==null) {
              root.classList.remove(callbackData);
            }
          }*/
        }

        if(debug_mode) {
          console.log('Element => '+el.classList+' is leaving view');
        }
      }

      if (isIntersecting && intersectOnce) {
          observer.unobserve(el);
      }
    }
  }

  _entering(element) {

    if ( element.hasAttribute(this._intersectingAttribute) ){
      if( element.getAttribute(this._intersectingAttribute).indexOf('-in-viewport') > -1 ) {
        return;
      }else {
        element.setAttribute(this._intersectingAttribute, '-in-viewport' );
      }
    }
  }

  _leaving(element) {
    if ( element.hasAttribute(this._intersectingAttribute) ){
      if( element.getAttribute(this._intersectingAttribute).indexOf('-in-viewport') > -1 ) {
        element.setAttribute(this._intersectingAttribute, '' );
      }
    }
  }

  _debugAddLayout(entry, options) {
    let elTraverseDebug = '';
    if(document.body.contains(document.querySelector('.traverse-debug'))) {
      elTraverseDebug = document.querySelector('.traverse-debug');
    }else{
      elTraverseDebug = document.createElement('div');
      elTraverseDebug.classList.add('traverse-debug');
      document.body.appendChild(elTraverseDebug);
    }

    let viewportSize = options.rootMargin.split(' ');
    elTraverseDebug.style.top = parseInt(viewportSize[0]) * -1+'px';
    elTraverseDebug.style.right = parseInt(viewportSize[1]) * -1+'px';
    elTraverseDebug.style.bottom = parseInt(viewportSize[2]) * -1+'px';
    elTraverseDebug.style.left = parseInt(viewportSize[3]) * -1+'px';

    entry.target.style.border = '2px solid #333';
  }
    

}
