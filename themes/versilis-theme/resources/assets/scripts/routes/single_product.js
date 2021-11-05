import Accordion from '../components/accordion';
import Swiper from 'swiper';
import PhotoGallery from '../components/photoGallery';

export default {
  init() {
    
  },
  finalize() {
    const vw = Math.max(document.documentElement.clientWidth || 0, window.innerWidth || 0);

    if( document.querySelector('#faq')!==null ) {
      this.toggle = new Accordion('#faq', 'toggle-trigger', true);
    }

    if ( document.querySelector('.project__applications')!==null ) {
      let swiperWrapper = document.querySelector('.project__applications .slider__wrapper');
      this.teamCarrousel = new Swiper(
        swiperWrapper.querySelector('.project__applications .swiper-container'),
        {
            speed: 500,
            // ================== Navigation arrows ==================
            navigation: {
              nextEl: '.project__applications .nav__next',
              prevEl: '.project__applications .nav__prev',
            },
            // breakpointsInverse: true,
            slidesPerView: 1,
            spaceBetween: 18,
            breakpoints: {
              560: {
                slidesPerView: 1.25,
                spaceBetween: 30,
              },
              768: {
                slidesPerView: 2,
                spaceBetween: 30,
              },
              1180: {
                slidesPerView: 3,
                spaceBetween: 30,
              },
            },
            pagination: {
              el: '.project__applications .swiper-pagination',
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

    if ( document.querySelector('.product__photos')!==null ) {

      console.log(vw);

      /*
      window.addEventListener('resize', function(event) {
      
      }, true);
      */
    }

    if ( document.querySelector('.product__photos')!==null ) {
      this.photosGallery = new PhotoGallery('.product__photos__gallery', '#photo-gallery', '.mobile-photos-gallery');  
    }
  },
};
