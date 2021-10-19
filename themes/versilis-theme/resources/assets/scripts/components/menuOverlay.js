/**
 * 
 * Overlay Class
 * Used for main menu
 * Modifiy to reuse on several instances, with other active overlay
 * 
 */
export default class MenuOverlay {

  constructor () {
    this._elsNavToggle = Array.from( document.querySelectorAll('.nav-toggle') );
    this._menuOverlay = document.querySelector('#mobile-menu');
    this.isOverlayActive = false;
    this.closeActions = Array.from( document.querySelectorAll('[data-js="menuClose"]') );

    document.addEventListener('keydown', this.keyboardControl.bind(this));

    for (var i = 0, l = this.closeActions.length; i < l; i++) {
      var elClose = this.closeActions[i];
      elClose.addEventListener('click', this.toggleOverlay.bind(this), false);
    }

    for (var r = 0, s = this._elsNavToggle.length; r < s; r++) {
      var elnavToggle = this._elsNavToggle[r];
      elnavToggle.addEventListener('click', this.toggleOverlay.bind(this));
    }

    
    this._elsMenuLinks = this._menuOverlay.querySelectorAll('.menu-item-has-children');

    this.isActive = null;
    this._elActiveMenuItem = null;

    for (var j = 0, m = this._elsMenuLinks.length; j < m; j++) {     
      this._elsMenuLinks[j].addEventListener( 'click', this.toggleSubMenu.bind(this), false);
      this._elsMenuLinks[j].querySelector('a').addEventListener('click', function(e) {
        event.target.classList.add('no-p-trans');
        e.preventDefault();
          return false;
      })
    }
  }

  toggleOverlay(e) {
    e.preventDefault();
    
    if (this.isOverlayActive) {
      this.close();
    }else{
      this.open(); 
    }
  }

  toggleSubMenu(event) {
    //if (event.target.classList.contains('menu-item-has-children')) {
      event.target.parentNode.classList.toggle('is-open');
      let sectionLinkId = event.target.parentNode.getAttribute('id');
      let _elSubMenuContainer = this._menuOverlay.querySelector('#'+sectionLinkId);
      let _elSubMenu = _elSubMenuContainer.querySelector('.sub-menu');
      var subMenuHeight = null;

      if (_elSubMenu.classList.contains('is-visible')) {
        subMenuHeight = _elSubMenu.scrollHeight; // Get it's height
        _elSubMenu.style.height = subMenuHeight + 'px';

        window.setTimeout(function () {
          _elSubMenu.style.height = '0';
        }, 1);

        window.setTimeout(function () {
          _elSubMenu.classList.remove('is-visible');
        }, 400);
      }else {
        _elSubMenu.style.display = 'block'; // Make it visible
        subMenuHeight = _elSubMenu.scrollHeight; // Get it's height
        _elSubMenu.style.display = ''; //  Hide it again

        _elSubMenu.classList.add('is-visible');
        _elSubMenu.style.height = subMenuHeight + 'px';

        window.setTimeout(function() {
          _elSubMenu.style.height = '';
          console.log('remove height');
        }, 400);
      }
    //} else {
      if (this._elActiveMenuItem !== null && this._elActiveMenuItem.classList.contains('is-hover')) {
          this._elActiveMenuItem.classList.remove('is-open');
      }
    //}
  }

  open() {
    this.isOverlayActive = true;
    this.toggleClass();
  }

  close() {
    if (this.isOverlayActive == true) {
      this.isOverlayActive = false;
      this.toggleClass();
    }
  }

  toggleClass() {
    var _elOverlay = this._menuOverlay;

    if (!_elOverlay.classList.contains('is-active')) {
      for (var v = 0, w = this._elsNavToggle.length; v < w; v++) {
        this._elsNavToggle[v].classList.add('is-active');
      }
      _elOverlay.classList.add('is-active');
      _elOverlay.classList.remove('is-hidden');
      document.documentElement.classList.add('prevent-scroll');
    }else{
      for (var x = 0, y = this._elsNavToggle.length; x < y; x++) {
        this._elsNavToggle[x].classList.remove('is-active');   
      }
      _elOverlay.classList.remove('is-active');  
      _elOverlay.classList.add('is-hidden');
      setTimeout(function(){
        _elOverlay.classList.remove('is-hidden');
        document.documentElement.classList.remove('prevent-scroll');
      }, 200);
    }
  }

    /*function preventScroll() {
      
      document.addEventListener('mousewheel', e => {
        e.stopPropagation();
      });
      this._el.addEventListener('wheel', e => {
          e.stopPropagation();
      });
      
    }*/

  keyboardControl(e) {
    if (this.isOverlayActive && e.keyCode === 27) {
      this.close();
    }
  }
}
