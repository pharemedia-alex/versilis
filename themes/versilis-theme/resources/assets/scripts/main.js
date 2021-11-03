// import external dependencies
import 'jquery';

// Import everything from autoload
import './autoload/**/*'

// import local dependencies
import Router from './util/Router';
import common from './routes/common';
import templateCaseStudies from './routes/case_studies';
import templateContact from './routes/contact';
import templateHomepage from './routes/home';
import singleProduct from './routes/single_product';

/** Populate Router instance with DOM routes */
const routes = new Router({
  // All pages
  common,
  // Contact Us page
  templateContact,
  //case studies
  templateCaseStudies,
  //homepage
  templateHomepage,
  //singleProduct
  singleProduct,
});

// Load Events
jQuery(document).ready(() => routes.loadEvents());

/*
//Find the largest of the divs
function getHighest(heights) {
  return Math.max(...heights);
}
  

jQuery(window).resize(function(){ 
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
  }
});
*/
