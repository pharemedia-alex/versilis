/**
 * 
 * scroll Up menu
 * 
 */
export default class MenuScrollUp {

  constructor() {
    this._elMenuContainer = document.querySelector('.main-header');
    this._header = document.querySelector('.header');
    console.log(this._elMenuContainer);
    this._init();
    console.log(window.pageYOffset);
  }

  _init() {
    let elWrapper = document.createElement('div');
    elWrapper.classList.add('menu-scrollup');
    elWrapper.appendChild(this._elMenuContainer);
    this._header.appendChild(elWrapper);
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