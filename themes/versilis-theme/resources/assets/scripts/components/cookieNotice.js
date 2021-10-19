/**
 * 
 * Cookie Notice
 * 
 */

export default class CookieNotice {
  
  constructor() {
    this.cookieNotice = document.querySelector('.cookie-notice');
    this.cookie = this.getCookie('cookie-notice');

    this.cookieNotice.querySelector('.close-btn').addEventListener('click', this.hide.bind(this));

    this.init();

    //window.addEventListener('scroll', this.closeOnScroll.bind(this));
  }

  init() {
    if (!this.cookie) {
      this.show();
    }
  }

  closeOnScroll() {
    if(this.cookieNotice.classList.contains('active')) {
      setTimeout(() => {
        this.hide();
      }, 2000);
      if (!this.cookie) {
        this.setCookie('cookie-notice', 'true', 30);
      }
    }
  }

  hide() {
    // Hide an element
    // Give the element a height to change from
    this.cookieNotice.style.height = this.cookieNotice.scrollHeight + 'px';
    this.setCookie('cookie-notice', 'true', 30);

    // Set the height back to 0
    setTimeout(function () {
      document.querySelector('.cookie-notice').style.height = '0';
      document.querySelector('.cookie-notice').style.padding = '0';
    }, 1);

    // When the transition is complete, hide it
    setTimeout(function () {
      document.querySelector('.cookie-notice').classList.remove('active');
    }, 350);
  }

  show() {
    this.cookieNotice.classList.add('active');
  }

  setCookie(cname, cvalue, exdays) {
    var d = new Date();
    if (exdays!=null) {
        d.setTime(d.getTime() + (exdays*24*60*60*1000));
        var expires = 'expires='+d.toUTCString();
        document.cookie = cname + '=' + cvalue + '; ' + expires +';path=/';
    }else {
        document.cookie = cname + '=' + cvalue + ';path=/';
        
    }
  }
  
  getCookie(cname) {
    var name = cname + '=';
    var ca = document.cookie.split(';');
    for(var i=0; i<ca.length; i++) {
      var c = ca[i];
      while (c.charAt(0)==' ') c = c.substring(1);
      if (c.indexOf(name) == 0) return c.substring(name.length,c.length);
    }
    return '';
  }
}
