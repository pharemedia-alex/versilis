/**
 * 
 * scroll
 * help : https://webdesign.tutsplus.com/tutorials/how-to-hide-reveal-a-sticky-header-on-scroll-with-javascript--cms-33756
 * 
 */
export default class ScrollDetect {

  constructor() {
    this.root = document.documentElement;
    this.scrollPos = 0;
    this.threshold = 250; //threshold
    this.scrollUpClassName = 'scrolling-up';
    this.scrollDownClassName = 'scrolling-down';
    
    window.addEventListener('scroll', this._detectScrollDirection.bind(this));
  }

  _detectScrollDirection() {
    let currentScroll = window.pageYOffset;

    if (currentScroll < this.threshold) {
      this.root.classList.remove(this.scrollUpClassName);
      return;
    }

    // detects new state and compares it with the new one
    if (document.body.getBoundingClientRect().top > this.scrollPos) {
      this.root.classList.remove(this.scrollDownClassName);
      this.root.classList.add(this.scrollUpClassName);
    }else {
      this.root.classList.remove(this.scrollUpClassName);
      this.root.classList.add(this.scrollDownClassName);
    }

    /*if (this.scrollPos == 0) {
      this.root.classList.remove(this.scrollUpClassName);
    }*/
    // saves the new position for iteration.
    this.scrollPos = (document.body.getBoundingClientRect()).top;
  }

  //debug helper
  _throwError() {
    throw new Error('Missing parameter');
  }

  /* Classes to help code
  isScrollingUp() {

  }

  isScrollingDown() {
    
  }
  */
}