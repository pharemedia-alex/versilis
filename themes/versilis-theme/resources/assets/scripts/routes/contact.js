import Form from '../components/form';

export default {
  init() {
    
    this.form = new Form('.contact-form__element','[data-label="floating"]');

    /*
    let _elFileUpload = document.querySelector('.wpcf7-form .file-upload-field');
    _elFileUpload.addEventListener('change', function() {
      let _elFilename = document.querySelector('.wpcf7-form .file-upload-name');
      let _elUploadBtn = document.querySelector('.wpcf7-form .file-upload-button');
      let filename = this.value.replace(/.*(\/|\\)/, '');

      _elFilename.textContent = this.value.replace(/.*(\/|\\)/, '');
      if(filename!='') {
        _elFilename.classList.add('active');
      }else {
        _elFilename.classList.remove('active');
      }
      
      _elUploadBtn.textContent = _elUploadBtn.getAttribute('data-change-text'); 
    });
    */

    /*
    document.addEventListener( 'wpcf7mailsent', function( ) {
      let thankyouURL = document.querySelector('.wpcf7-form .thank-you-URL').value;
      console.log(thankyouURL);
      if (thankyouURL!==null) {
        window.location.href = thankyouURL;
      }
    }, false );
    */
  },
};
