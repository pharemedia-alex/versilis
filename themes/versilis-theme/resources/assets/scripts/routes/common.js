import PageTransition from '../components/pageTransition.js';
import ScrollDetect from '../components/scrollDetect.js';
import Traverse from '../components/traverse.js';
import Accordion from '../components/accordion.js';
import MenuOverlay from '../components/menuOverlay.js';
import mainMenu from '../components/mainMenu';
import CookieNotice from '../components/cookieNotice.js';
import deviceDetection from '../components/device_detect.js';
import Swiper from 'swiper';

export default {
  init() {

    //trigger page transition
    this.pageTrans = new PageTransition();
    this.pageTrans.on('transitionCompleted', () => {
      this.afterInit();
    });

    if( document.querySelector('.cookie-notice')!==null ) {
      this.cookieNotice = new CookieNotice;
    }

    /* fix safari back button issue */
    /**
     * If browser back button was used, flush cache
     * This ensures that user will always see an accurate, up-to-date view based on their state
     * https://stackoverflow.com/questions/8788802/prevent-safari-loading-from-cache-when-back-button-is-clicked
     */
    (function () {
      window.onpageshow = function(event) {
        if (event.persisted) {
          window.location.reload();
        }
      };
    })();
  },
  afterInit() {

    this.deviceDetection = new deviceDetection();

    this.scrollDetection = new ScrollDetect();

    this.mobileMenu = new MenuOverlay();

    this.traverse = new Traverse(
      [
        {
          selector: '.-t-animate > *',
          //add delay
          effect: 'slide-up',
          once: true,
          delay: 0.3,
          config: {
              rootMargin: '0px -150px 0px 0px',
              threshold: 0,
          },
          callback: false,
          debug: false, //false
        },
      ]
    );

    this.mainMenu = new mainMenu('.header-init');
    this.mainMenuScrollup = new mainMenu('.header-scrollup');

    if( document.querySelector('#cf-faq-accordion')!==null ) {
      this.toggle = new Accordion('#cf-faq-accordion', 'toggle-trigger', true);
    }

    if( document.querySelector('.case-studies-list')!==null ) {
      let swiperWrapper = document.querySelector('.case-studies-slider__wrapper');
      this.teamCarrousel = new Swiper(
        swiperWrapper.querySelector('.swiper-container'),
        {
            speed: 500,
            // ================== Navigation arrows ==================
            navigation: {
              nextEl: '.case-studies-list-nav__next',
              prevEl: '.case-studies-list-nav__prev',
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
              1024: {
                slidesPerView: 2.5,
                spaceBetween: 30,
              },
            },
            pagination: {
              el: '.case-studies__swiper-pagination',
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

    /*
    //Find the largest of the divs
    function getHighest(heights) {
      return Math.max(...heights);
    }

    if (document.querySelector('.match-height').length != 0) {
      //Grab divs with the class name 'match-height'
      var getDivs = document.getElementsByClassName('match-height');
    
      //Find out how my divs there are with the class 'match-height' 
      var arrayLength = getDivs.length;
      var heights = [];
    
      //Create a loop that iterates through the getDivs variable and pushes the heights of the divs into an empty array
      for (var i = 0; i < arrayLength; i++) {
          heights.push(getDivs[i].offsetHeight);
      }
    
      //Set a variable equal to the tallest div
      var tallest = getHighest(heights);
    
      //Iterate through getDivs and set all their height style equal to the tallest variable
      for (var j = 0; j < getDivs.length; j++) {
          getDivs[j].style.height = tallest + 'px';
      }
    }*/

  },
  finalize() {
    // JavaScript to be fired on all pages, after page specific JS is fired
  },
};
