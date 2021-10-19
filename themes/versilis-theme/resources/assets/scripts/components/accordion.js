/**
 * 
 * Toggle Class
 * 
 */
export default class Accordion {
  
  constructor( _elGroupId = null, _elTriggerName = 'toggle-trigger', multiple = false ) {
    if (_elGroupId==null || _elTriggerName==null) {
      throw new Error('Error: You must define the id for the toggle group and attribute for toggle trigger.');
    }

    this._elGroupId = _elGroupId;
    this._elTriggerName = _elTriggerName;
    this.multiple = multiple;
    this.active = null;
    this.duration = 400;

    this._elToggleGroup = document.querySelector(_elGroupId);
    
    this._elsToggleTrigger = this._elToggleGroup.querySelectorAll('[data-toggle='+_elTriggerName+']');

    for (var i = 0, l = this._elsToggleTrigger.length; i < l; i++) {
      var element = this._elsToggleTrigger[i];
      element.addEventListener('click', (e) => {
        e.preventDefault();
        this.slideToggle(e.currentTarget, this.duration);
      }, false);
    }
  }

  /*
  closeActive() {
    if (this.active != null) {
      this.active.classList.remove('is-active');
      var _elActiveLink = this._elToggleGroup.querySelector('[data-target="#'+this.active.id+'"]');
      _elActiveLink.setAttribute('aria-expanded', 'false');
    }
  }
  */

  slideUp(target, duration) {
    if ( target.dataset.animation != 'animating' ) {
      target.dataset.animation = 'animating';
      target.style.transitionDuration = duration + 'ms';
      target.style.height = target.offsetHeight + 'px';
      target.style.pointerEvents = 'none';

      window.setTimeout( () => {
        target.style.height = 0;
      }, 40);

      window.setTimeout( () => {
        target.dataset.animation = '';
        target.style.display = 'none';
        target.style.removeProperty('height');
        target.style.pointerEvents = 'cursor';
      }, duration);
    }
  }
  
  slideDown(target, duration) {
    if ( target.dataset.animation != 'animating' ) {
      target.dataset.animation = 'animating';
      target.style.removeProperty('display');
      let display = window.getComputedStyle(target).display;

      if (display === 'none') {
        display = 'block';
      }
      target.style.display = display;

      let height = target.offsetHeight;
      target.style.height = 0;
      target.style.pointerEvents = 'none';
      //part of styles are in sass files for simplification

      target.style.boxSizing = 'border-box';
      target.style.transitionDuration = duration + 'ms';

      window.setTimeout( () => {
        target.style.height = height + 'px';
      }, 40);
      window.setTimeout( () => {
        target.dataset.animation = '';
        target.style.pointerEvents = 'cursor';
        target.style.removeProperty('height');
        target.style.removeProperty('transition-duration');
      }, duration);
    }   
  }
  
  slideToggle(element, duration){
    
    var target = this._elToggleGroup.querySelector(element.dataset.target);
    if (window.getComputedStyle(target).display === 'none') {
      element.setAttribute('aria-expanded', 'true');
      element.classList.add('is-active');
      if (this.multiple===false) {
        if (this.active!==null) {
          console.log(this.active);
          this.slideToggle(this.active, this.duration);
        }
        this.active = element;
      }
      return this.slideDown(target, duration);
    } else {
      element.setAttribute('aria-expanded', 'false');
      element.classList.remove('is-active');
      if (this.multiple===false) {
        this.active = null;
      }
      return this.slideUp(target, duration);
    }
  }
  
}