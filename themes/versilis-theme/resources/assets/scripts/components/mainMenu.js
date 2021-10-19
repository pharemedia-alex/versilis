/**
 * 
 * mainMenu
 * 
 */
export default class mainMenu {

  constructor(_elMenuContainer = null) {

    if (_elMenuContainer==null) {
      throw new Error('Error: You must define the class or id for main menu');
    }

    this._elHeader = document.querySelector('.header');
    this._elMenuContainer = document.querySelector(_elMenuContainer);
    this._elnav = this._elMenuContainer.querySelector('.nav-primary');

    this._elsMenuLinks = this._elnav.querySelectorAll('.menu-item');
    this._elSubMenuWrapper = this._elMenuContainer.querySelector('.sub-menu-container');

    this.isActive = null;
    this._elActiveMenuItem = null;

    for (var i = 0, l = this._elsMenuLinks.length; i < l; i++) {     
      this._elsMenuLinks[i].addEventListener( 'mouseenter', this._hoverMenu.bind(this), false);
      this._elsMenuLinks[i].addEventListener( 'click', function( e ){
        if ( this.classList.contains('has_child') && document.documentElement.classList.contains('is-touch-device') ) {
          e.preventDefault();
          return false;
        }
      }, false);
    }

    this._elMain = document.querySelector('.main');

    this._elMain.addEventListener('mouseenter', this._closeSubMenu.bind(this), false);
    window.addEventListener('scroll', this._closeSubMenu.bind(this), false);
    
  }
  
  _hoverMenu(event) {
    this._closeActive();
    if (event.target.classList.contains('has_child')) {
      event.target.classList.add('is-hover');
      //get submenu class based on link parent ID
      let subMenuID = event.target.getAttribute('data-dropdown');
      let _elSubMenu = this._elSubMenuWrapper.querySelector('.'+subMenuID);
      if ( _elSubMenu !== null && !_elSubMenu.classList.contains('is-active')) {
        _elSubMenu.classList.add('is-active');
        this._elSubMenuWrapper.classList.add('is-active');
        this._elHeader.classList.add('inverted');
      }
      this.isActive = _elSubMenu;
      this._elActiveMenuItem = event.target;
    } else {
      if (this._elActiveMenuItem !== null && this._elActiveMenuItem.classList.contains('is-hover')) {
          this._elActiveMenuItem.classList.remove('is-hover');
      }
      this._elSubMenuWrapper.classList.remove('is-active');
      if (this._elHeader.classList.contains('inverted')) {
          this._elHeader.classList.remove('inverted');
      }
    }
  }

    _closeActive() {
      if (this.isActive != null) {
        this._elActiveMenuItem.classList.remove('is-hover');
        this.isActive.classList.remove('is-active');
      }
    }

    _closeSubMenu() {
      this._elSubMenuWrapper.classList.remove('is-active');
      if (this._elHeader.classList.contains('inverted')) {
        this._elHeader.classList.remove('inverted');
      }
      if (this.isActive != null) {
        this._elActiveMenuItem.classList.remove('is-hover');
        this.isActive.classList.remove('is-active');
      }
    }
}