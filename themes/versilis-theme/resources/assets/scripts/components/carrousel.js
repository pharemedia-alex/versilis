import Swiper from 'swiper';
/**
 * 
 * Carrousel
 * 
 */
export default class Carrousel {
  
  constructor( ContainerSelector) {

    if (ContainerSelector==null) {
      throw new Error('Error: You must define the selector for the carrousel wrapper.');
    }

    this._elSwiper = new Swiper(
      document.querySelector(ContainerSelector),
      {
          slidesPerView: 'auto',
          preloadImages: false,
          effect: 'flip',
          speed: 400,
          lazy: true,
          pagination: {
            el: '.nav-info',
            type: 'fraction',
          },
          navigation: {
            nextEl: '.button-next',
            prevEl: '.button-prev',
          },
          renderFraction: function (currentClass, totalClass) {
            return '<span class="' + currentClass + '"></span>' +
                   ' of ' +
                   '<span class="' + totalClass + '"></span>';
          },
      }
    );

    //this.init();

    //window.addEventListener('resize', this._onResize.bind(this));

  }

  /*
  init() {
    for (let i = 0, l = this._elsLinks.length; i < l; i++) {
        this._elsLinks[i].addEventListener('mouseenter', this.onNavEnter.bind(this));
        this._elsLinks[i].addEventListener('mouseleave', this.onNavLeave.bind(this));
    }
  }

  onNavEnter(e) {
    if (this._swiper) {
      var linkIndex = this.linkArray.indexOf(e.currentTarget);
      this.changeSwiperIndex(linkIndex);
    }
  }

  changeSwiperIndex(i) {
    if (this._swiper) {
      this._swiper.slideTo(i);
    }
  }

  onChange(e) {
    var current = e.target;
    if (current!=null) {
      var index = current.options['selectedIndex']-1;
      if (index >= 0) {
        this.changeSwiperIndex(index);
      }else {
        this.changeSwiperIndex(0);
      }
    }
  }

  onNavLeave() {
    if (this._swiper) {
      this._swiper.slideTo(0);
    }
  }

  _onResize() {
    var _elForm = document.querySelector('form[data-js="nav"]'),
        _elDropdown = _elForm.querySelector('select');
    
    _elDropdown.selectedIndex=0;
    var drodownStyles = window.getComputedStyle(_elForm.parentNode); //get styles of form container

    if(drodownStyles.display=='none') {
      this.onNavLeave();
      _elForm.querySelector('.archive__info').innerHTML='';
    }
  }
  */
  
}