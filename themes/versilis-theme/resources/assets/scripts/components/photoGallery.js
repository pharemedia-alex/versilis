import Swiper from 'swiper';
import Macy from 'macy';

/**
 * 
 * PhotoGallery
 * 
 */

export default class PhotoGallery {
  
  constructor(_elContainer = null, _elOverlay = null, _elMobileContainer = null) {

    if (_elContainer==null) {
      throw new Error('Error: You must define the class or id for the gallery container');
    }

    if (_elOverlay==null) {
      throw new Error('Error: You must define the class or id for the gallery overlay');
    }

    if (_elMobileContainer==null) {
      throw new Error('Error: You must define the class or id for the gallery for mobile');
    }

    this.windowWidth = Math.max(document.documentElement.clientWidth || 0, window.innerWidth || 0);
    this.macyGrid = null;
    this.galleryWrapper = document.querySelector(_elContainer);
    this.elsPhotos = this.galleryWrapper.querySelectorAll('.gallery-item a');
    this.galleryOverlay = document.querySelector(_elOverlay);
    this.close_btn = this.galleryOverlay.querySelector('.close-btn');
    this.SwiperGallery = this.galleryOverlay.querySelector('.photo-gallery-slider__wrapper');
    this.mobileSwiperGallery = document.querySelector(_elMobileContainer);
    this.document = document.querySelector('html');
    this.photoGrid = document.querySelector('.product__photos__gallery');

    this.close_btn.addEventListener('click', this.toggle.bind(this), false);

    for (var i = 0, l = this.elsPhotos.length; i < l; i++) {
      this.elPhoto = this.elsPhotos[i];
      this.elPhoto.addEventListener('click', this.toggle.bind(this), false);
    }

    this.initPhotoGallery();
    
    window.addEventListener('resize', this.debounce(this.initPhotoGallery.bind(this)));
  }

  initPhotoGallery() {
    this.windowWidth = Math.max(document.documentElement.clientWidth || 0, window.innerWidth || 0);

    if ( this.windowWidth>=768 ) {
      if ( this.macyGrid===null ) {
        //init photo gallery
        let elsImageWrappers = document.querySelectorAll('.gallery-item_img');

        for (var i = 0, l = elsImageWrappers.length; i < l; i++) {
          var elImage = elsImageWrappers[i];
          var elImageTag = elsImageWrappers[i].querySelector('img');
          if (elImageTag===null) {
            var elImageSRC = elImage.getAttribute('data-src');
            var img = document.createElement('img');
            img.src = elImageSRC;
            elsImageWrappers[i].appendChild(img);
          }
        }

        /* eslint-disable no-unused-vars */
        this.macyGrid = Macy({
          container: '.product__photos__gallery',
          trueOrder: false,
          waitForImages: false,
          margin: 24,
          columns: 3,
          breakAt: {
              1200: 3,
              768: 2,
          },
        });
      }
    }else {
      if ( this.macyGrid!==null ) {
        this.macyGrid.remove();
        this.macyGrid = null;
      }
    }

    if ( this.windowWidth<768 ) {
      this.MobileproductPhotosGallery = new Swiper(
        this.mobileSwiperGallery.querySelector('.swiper-container'),
        {
            speed: 500,
            // ================== Navigation arrows ==================
            navigation: {
              nextEl: '.mobile-photos-gallery-nav__next',
              prevEl: '.mobile-photos-gallery-nav__prev',
            },
            // breakpointsInverse: true,
            slidesPerView: 1,
            spaceBetween: 18,
            pagination: {
              el: '.mobile-photos-gallery__swiper-pagination',
              clickable: true,
            },
            autoResize: true,
            // Disable preloading of all images
            preloadImages: false,
            // Enable lazy loading
            lazy: true,
            // loop: true,
        }
      );
    }
  }

  toggle(e) {
    e.preventDefault();

    var imageNum = e.target.getAttribute('data-img-num');

    if (this.galleryOverlay.classList.contains('is-hidden')) {
      this.galleryOverlay.classList.add('is-visible');
      setTimeout(() => {  
        this.galleryOverlay.classList.add('is-active');
        this.galleryOverlay.classList.remove('is-hidden');
        this.openGallery(imageNum);
      }, 200);
    }else {
      console.log('here');
      this.galleryOverlay.classList.remove('is-active');
      setTimeout(() => {  
        this.closeGallery();
        this.galleryOverlay.classList.remove('is-visible');
        this.galleryOverlay.classList.add('is-hidden');
      }, 400);
    }
    
    return false;
  }

  openGallery(slidenum=0) {
    this.document.style.overflow = 'hidden';
    this.productPhotosGallery = new Swiper(
      this.SwiperGallery.querySelector('.swiper-container'),
      {
          speed: 500,
          // ================== Navigation arrows ==================
          navigation: {
            nextEl: '.photo-gallery-nav__next',
            prevEl: '.photo-gallery-nav__prev',
          },
          // breakpointsInverse: true,
          slidesPerView: 1,
          spaceBetween: 18,
          pagination: {
            el: '.photo-gallery__swiper-pagination',
            clickable: true,
          },
          autoResize: true,
          // Disable preloading of all images
          preloadImages: false,
          // Enable lazy loading
          lazy: true,
          // loop: true,
      }
    );

    if (slidenum>0) {
      this.productPhotosGallery.slideTo( slidenum, 0, false );
    }
  }

  closeGallery() {
    this.productPhotosGallery.destroy();
    this.document.style.overflow = 'visible';
  }

  debounce(func){
    var timer;
    return function(event){
      if(timer) clearTimeout(timer);
      timer = setTimeout(func,200,event);
    };
  }
}
