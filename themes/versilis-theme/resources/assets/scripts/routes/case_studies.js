export default {
  init() {

    var _elsFormFilters = document.querySelectorAll('.filters select');

    for (var i = 0, l = _elsFormFilters.length; i < l; i++) {
      var element = _elsFormFilters[i];
    
      element.addEventListener('change', function(e) {
        e.preventDefault();
        var updateURI = updateQueryStringParameter();
        window.history.pushState({ path: updateURI }, '', updateURI);
        retrieveEntries();
      }, false);
    }

    /* functions */

    function updateQueryStringParameter() {
      var params = new Array();
      var pageURL = ajaxObject.pageURL;
      //create array with dropdown filters values
      for (var i = 0, l = _elsFormFilters.length; i < l; i++) {
        if (_elsFormFilters[i].value!='') {
          params.push(_elsFormFilters[i].id+'='+_elsFormFilters[i].value);
        }
      }
      if (params.length===0) {
        return pageURL;
      }else {
        //add parameters to URL based on parameters array
        for (var v = 0, w = params.length; v < w; v++) {
          if (v==0) {
            pageURL+='?';
          }else {
            pageURL+='&';
          }
          pageURL+=params[v];
        }
        return pageURL;
      }
    }

    function retrieveEntries() {
      
      var _elResultsWrapper = document.querySelector('.results-wrapper');
      var page = 0;
      if (document.querySelector('.pagination .current')!==null) {
        page = document.querySelector('.pagination .current').textContent;
      }
      var request = new XMLHttpRequest();

      var params = { 
          action : 'filter_case_studies',
          page : page,
          location : document.querySelector('.filters #location').value,
          product : document.querySelector('.filters #product-id').value,
          application : document.querySelector('.filters #application').value,
          pageURL : ajaxObject.pageURL,
      };

      var data = $.param(params);
      request.open('POST', ajaxObject.AjaxURL, true);
      request.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded;');
      request.send(data);

      request.onload = function() {
        if (this.readyState == 4 && this.status == 200) {
          /*var htmlObject = document.createElement('div');
          htmlObject.innerHTML = this.response;
          var elsEntries = htmlObject.querySelectorAll('.case-study');

          for (var i = 0, l = _elsFormFilters.length; i < l; i++) {
            var element = _elsFormFilters[i];
          
            element.addEventListener('change', function(e) {
              e.preventDefault();
              var updateURI = updateQueryStringParameter(ajaxObject.pageURL+'/', this.id, this.value);
              window.history.pushState({ path: updateURI }, '', updateURI);
              retrieveEntries();
            }, false);
          }*/

          _elResultsWrapper.innerHTML=this.response;
        } else {
          // If fail
          console.log('fail');
          console.log(this.response);
        }
      };
      request.onerror = function() {
        console.log('connexion error');
      };

    }
  },
};
