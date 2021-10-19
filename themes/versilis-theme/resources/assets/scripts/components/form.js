/**
 * 
 * Form
 * To improve with HTML5 validation
 */

export default class Form {
  
  constructor( formSelector, fieldSelector ) {

    if (formSelector==null) {
      throw new Error('Error: You must define the selector for the form wrapper.');
    }

    if (fieldSelector==null) {
      throw new Error('Error: You must define the selector for the fields wrapper.');
    }

    this.form = document.querySelector(formSelector);
    this.fieldSelector = fieldSelector;
      
    this._init();

    console.log('init form');

  }

  _init() {
    let fields = this.form.querySelectorAll(this.fieldSelector);
    fields.forEach(el => {
      let elInput = el.querySelector('input');
      let elLabel = el.querySelector('label');

      elInput.addEventListener('focus', () => {
        this._setLabelActive(elLabel);
      } );
      elInput.addEventListener('blur', () => {
        this._setLabel(elInput, elLabel);
      });
    });
  }
  
  _setLabelActive(label) {
    label.classList.add('floating-label-active');
    label.parentNode.classList.add('current');
  }
  
  _setLabelInactive(label) {
    label.classList.remove('floating-label-active');
    label.parentNode.classList.remove('current');
  }

  _setLabel(input, label) {
    if (input.value && input.value.length) {
      this._setLabelActive(label);
    } else {
      this._setLabelInactive(label);
    }
  }
}
