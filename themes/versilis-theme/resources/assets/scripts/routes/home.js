import Swiper from 'swiper';

export default {
  init() {
    if( document.querySelector('.innovation')!==null ) {
      let swiperWrapper = document.querySelector('.innovation-list-slider__wrapper');
      this.teamCarrousel = new Swiper(
        swiperWrapper.querySelector('.swiper-container'),
        {
            speed: 500,
            // ================== Navigation arrows ==================
            navigation: {
              nextEl: '.innovation-list-nav__next',
              prevEl: '.innovation-list-nav__prev',
            },
            // breakpointsInverse: true,
            slidesPerView: 1,
            spaceBetween: 18,
            breakpoints: {
              576: {
                slidesPerView: 1.5,
                spaceBetween: 20,
              },
              1024: {
                slidesPerView: 1.1,
                spaceBetween: 60,
              },
            },
            pagination: {
              el: '.innovation-list__swiper-pagination',
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
  },
};
