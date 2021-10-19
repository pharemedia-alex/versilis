/**
 * 
 * mainMenu
 * 
 */
export default class deviceDetection {

  constructor() {

    document.addEventListener('DOMContentLoaded', this.initDetect())

  }

  initDetect(){
    window.addEventListener('resize', this.detectDevice());
  }
  
  detectDevice () {

    !!navigator.maxTouchPoints ? document.documentElement.classList.add('is-touch-device') : 'computer'; // eslint-disable-line
    //!navigator.maxTouchPoints ? 'desktop' : !window.screen.orientation.angle ? document.documentElement.classList.add('is-portrait-oriented') : document.documentElement.classList.add('is-landscape-oriented')
    
  }  
}