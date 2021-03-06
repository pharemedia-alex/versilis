import Swiper from 'swiper';

export default {
  init() {
    if( document.querySelector('.innovation')!==null ) {
      let swiperWrapper = document.querySelector('.innovation .slider__wrapper');
      this.teamCarrousel = new Swiper(
        swiperWrapper.querySelector('.swiper-container'),
        {
            speed: 500,
            // ================== Navigation arrows ==================
            navigation: {
              nextEl: '.innovation .nav__next',
              prevEl: '.innovation .nav__prev',
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
              el: '.innovation .swiper-pagination',
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
    
    if( document.querySelector('.products')!==null ) {
      let swiperWrapper = document.querySelector('.products .slider__wrapper');
      this.teamCarrousel = new Swiper(
        swiperWrapper.querySelector('.products .swiper-container'),
        {
            speed: 500,
            // ================== Navigation arrows ==================
            navigation: {
              nextEl: '.products .nav__next',
              prevEl: '.products nav__prev',
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
                slidesPerView: 3,
                spaceBetween: 60,
              },
            },
            pagination: {
              el: '.products swiper-pagination',
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
