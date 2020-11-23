/*
 * Welcome to your app's main JavaScript file!
 *
 * We recommend including the built version of this JavaScript file
 * (and its CSS file) in your base layout (base.html.twig).
 */

// any CSS you import will output into a single css file (app.scss in this case)
import './styles/app.scss';
import "bootstrap/js/src/index";
import "jquery/dist/jquery";
require('@fortawesome/fontawesome-free/css/all.min.css');
require('@fortawesome/fontawesome-free/js/all.js');

// Collapse Navbar
var navbarCollapse = function() {
    if ($("#mainNav").offset().top > 100) {
        $("#mainNav").addClass("navbar-scrolled bg-dark navbar-dark");
    } else {
        $("#mainNav").removeClass("navbar-scrolled bg-dark navbar-dark bg-light");
    }
};
// Collapse now if page is not at top
navbarCollapse();
// Collapse the navbar when page is scrolled
$(window).scroll(navbarCollapse);
 $(document).ready(function(){   
         $("#submitButton").on("click", function(event){ 
         	console.log($('form').serializeArray()); 
            $.ajax({  
               url:  '/contact/formSent',  
               type: 'POST',
               data: $('form').serializeArray(),      
               
               success: function(data) {  
             		console.log(data);
               },  
               error : function(xhr, textStatus, errorThrown) {  
                  console.log('Ajax request failed.');  
               }  
            });  
         });  
      });  