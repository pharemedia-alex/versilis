const EventEmitter = require('events');

/**
 * 
 * Transition Class
 * To improve with several overlay layers (different colors) or create another one
 * 
 */
export default class PageTransition extends EventEmitter {

    constructor(_elPageTrans = document.querySelector('.p-trans')) {
      super();
      this.delay = 200; // delay before triggering the page animation on load
      this._elPageTrans = _elPageTrans;
      this.elsnum = parseInt(this._elPageTrans.getAttribute('data-elements'));
      this._elPageTransEnd = this._elPageTrans.querySelector('.p-trans-end'); //element to detect end of transition based on animationend
      this.animationEvent = this.whichAnimationEvent();

      this.init();
    }

    init() {
      // trigger exit animation
      this.hide();

      // using event delegation to bind click on window
      window.addEventListener('click', this.onClick.bind(this));

      // firefox prevent backcache
      window.onunload = function() {};
    }

    onClick(e) {
      var target = e.target;
      var anchor = '';
      
      //get targeted anchor or closest one if anchor wrap several element (e.target gets the clicked element)
      if(target.nodeName.toLowerCase() === 'a') {
        anchor = target;
      }else {
        anchor = target.closest('a');
      }
      
      //get attribute in DOM instead of .href to avoid retrieving https://website.com/# instead of #
      var href = (anchor === null) ? '' : anchor.getAttribute('href');
      
      if (
        anchor !== null &&
        !anchor.classList.contains('no-p-trans') &&
        (href.indexOf('http') >= 0 || href.indexOf('/') >= 0 ) && //internal or external url or use: (/^http/.test(href) || /^\//.test(href))
        !/^#/.test(href) && //not an anchor
        anchor.target !== '_blank' && //not a link to open in a new tab
        (!e.metaKey && !e.ctrlKey) //prevent triggering animation if user navigate with keyboard or hold ctrl key to open link in new tab
      ) {
          
        e.preventDefault(); //prevent propagation

        this.animationEvent && this._elPageTransEnd.addEventListener(this.animationEvent, function() {
          document.documentElement.classList.add('p-trans-in-completed'); //hide page content with page transition
          
          setTimeout(() => {
            if (href) {
              window.location.href = href;
            }
          }, this.delay);
          
        });

        document.documentElement.classList.add('p-trans-in'); //hide page content with page transition

      }
    }

    hide() {
      //var _this = this;
      setTimeout(() => {
        document.documentElement.classList.remove('p-trans-out');
        this.animationEvent && this._elPageTransEnd.addEventListener(this.animationEvent, this.hideCompleted.bind(this));
      }, this.delay);
    }

    hideCompleted() {
      document.documentElement.classList.remove('p-trans-out');
      document.documentElement.classList.add('p-trans-completed'); //hide page content with page transition
      this.animationEvent && this._elPageTransEnd.removeEventListener(this.animationEvent, this.hideCompleted );

      //emit for listener - https://codeburst.io/event-emitters-and-listeners-in-javascript-9cf0c639fd63
      this.emit('transitionCompleted');
    }

    /* From Modernizr */
    whichTransitionEvent(){
      var t,
          el = document.createElement('fakeelement');
    
      var transitions = {
        'transition'      : 'transitionend',
        'OTransition'     : 'oTransitionEnd',
        'MozTransition'   : 'transitionend',
        'WebkitTransition': 'webkitTransitionEnd',
      }
    
      for (t in transitions){
        if (el.style[t] !== undefined){
          return transitions[t];
        }
      }
    }

    whichAnimationEvent(){
      var t,
          el = document.createElement('fakeelement');
    
      var animations = {
        'animation'      : 'animationend',
        'OAnimation'     : 'oAnimationEnd',
        'MozAnimation'   : 'animationend',
        'WebkitAnimation': 'webkitAnimationEnd',
      }
    
      for (t in animations){
        if (el.style[t] !== undefined){
          return animations[t];
        }
      }
    }
}