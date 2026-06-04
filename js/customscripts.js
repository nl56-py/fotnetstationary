/*
 * Theme Name: luzuk
*/

/*----------------------------------------------------
/* Responsive Navigation
/*--------------------------------------------------*/
jQuery(document).ready(function($){
    $('.primary-navigation').append('<div id="mobile-menu-overlay" />');

    $('.toggle-mobile-menu').click(function(e) {
        e.preventDefault();
        e.stopPropagation();
        $('body').toggleClass('mobile-menu-active');

        if ( $('body').hasClass('mobile-menu-active') ) {
            if ( $(document).height() > $(window).height() ) {
                var scrollTop = ( $('html').scrollTop() ) ? $('html').scrollTop() : $('body').scrollTop();
                $('html').addClass('noscroll').css( 'top', -scrollTop );
            }
            $('#mobile-menu-overlay').fadeIn();
        } else {
            var scrollTop = parseInt( $('html').css('top') );
            $('html').removeClass('noscroll');
            $('html,body').scrollTop( -scrollTop );
            $('#mobile-menu-overlay').fadeOut();
        }
    });
}).on('click', function(event) {

    var $target = jQuery(event.target);
    if ( ( $target.hasClass("publishable-icon") && $target.parent().hasClass("toggle-caret") ) ||  $target.hasClass("toggle-caret") ) {// allow clicking on menu toggles
        return;
    }
    jQuery('body').removeClass('mobile-menu-active');
    jQuery('html').removeClass('noscroll');
    jQuery('#mobile-menu-overlay').fadeOut();
});

/*----------------------------------------------------
/*  Dropdown menu
/* ------------------------------------------------- */
jQuery(document).ready(function($) {
    
    function mtsDropdownMenu() {
        var wWidth = $(window).width();
        if(wWidth > 865) {
            $('#navigation ul.sub-menu, #navigation ul.children').hide();
            var timer;
            var delay = 100;
            $('#navigation li').hover( 
              function() {
                var $this = $(this);
                timer = setTimeout(function() {
                    $this.children('ul.sub-menu, ul.children').slideDown('fast');
                }, delay);
                
              },
              function() {
                $(this).children('ul.sub-menu, ul.children').hide();
                clearTimeout(timer);
              }
            );
        } else {
            $('#navigation li').unbind('hover');
            $('#navigation li.active > ul.sub-menu, #navigation li.active > ul.children').show();
        }
    }

    mtsDropdownMenu();

    $(window).resize(function() {
        mtsDropdownMenu();
    });
});


/*---------------------------------------------------
/*  Vertical menus toggles
/* -------------------------------------------------*/
jQuery(document).ready(function($) {

    $('.widget_nav_menu, #navigation .menu').addClass('toggle-menu');
    $('.toggle-menu ul.sub-menu, .toggle-menu ul.children').addClass('toggle-submenu');
    $('.toggle-menu ul.sub-menu').parent().addClass('toggle-menu-item-parent');

    $('.toggle-menu .toggle-menu-item-parent').append('<span class="toggle-caret"><i class="publishable-icon icon-plus"></i></span>');

    $('.toggle-caret').click(function(e) {
        e.preventDefault();
        $(this).parent().toggleClass('active').children('.toggle-submenu').slideToggle('fast');
    });
});

/*----------------------------------------------------
/* Back to top smooth scrolling
/*--------------------------------------------------*/
jQuery(document).ready(function($) {
    jQuery('a[href=#top]').click(function(){
        jQuery('html, body').animate({scrollTop:0}, 'slow');
        return false;
    });
});


$('#slider .owl-carousel').owlCarousel({
           slideSpeed : 1500,
            //autoplay: true,
              loop: true,
              margin: 30,
              animateOut: 'lightSpeedOut',
              responsiveClass: true,
              responsive: {
                0: {
                  items: 1,
                  nav: true
                },
                600: {
                  items:1,
                  nav: true
                },
                1000: {
                  items:1,
                  nav: true,
                  navText: ["<i class='fa fa-arrow-left'></i>","<i class='fa fa-arrow-right'></i>"],
                  loop: true,
                  margin: 0
              }
            }
          })


$('#testimonials .owl-carousel').owlCarousel({
          loop:true,
          margin:15,
          dots: true,
          nav:false,
          mouseDrag:true,
          autoplay: true,         
          responsive:{
            0:{
              items:1
            },
            600:{
              items:1
            },
            1000:{
              items:1
            }
          }
        })  


$('#about .owl-carousel').owlCarousel({
          loop:true,
          margin:30,
          dots: true,
          nav: true,
          navText: ["<i class='fa fa-angle-left'></i>","<i class='fa fa-angle-right'></i>"],
          mouseDrag:true,
          autoplay: true,
         
          responsive:{
            0:{
              items:1
            },
            600:{
              items:2
            },
            1000:{
              items:3
            }
          }
        })


$('#featured-product-section .owl-carousel').owlCarousel({
          loop:true,
          margin:30,
          dots: true,
          nav:false,
          mouseDrag:true,
          //autoplay: true,
         
          responsive:{
            0:{
              items:1
            },
            600:{
              items:2
            },
            1000:{
              items:4
            }
          }
        }) 

        

$('.gallery-area .owl-carousel').owlCarousel({
      loop:true,
      margin:0,
      dots: true,
      nav:true,
      mouseDrag:true,
      autoplay: true,
      responsive:{
        0:{
          items:1
        },
        600:{
          items:2
        },

        1000:{
          items:4
        
        }
      }
    }) 



  // Gallery image hover
$( ".img-wrapper" ).hover(
  function() {
    $(this).find(".img-overlay").animate({opacity: 1}, 600);
  }, function() {
    $(this).find(".img-overlay").animate({opacity: 0}, 600);
  }
);

// Lightbox
var $overlay = $('<div id="overlay"></div>');
var $image = $("<img>");
var $prevButton = $('<div id="prevButton"><i class="fa fa-chevron-left"></i></div>');
var $nextButton = $('<div id="nextButton"><i class="fa fa-chevron-right"></i></div>');
var $exitButton = $('<div id="exitButton"><i class="fa fa-times"></i></div>');

// Add overlay
$overlay.append($image).prepend($prevButton).append($nextButton).append($exitButton);
$("#gallery").append($overlay);

// Hide overlay on default
$overlay.hide();

// When an image is clicked
$(".img-overlay").click(function(event) {
  // Prevents default behavior
  event.preventDefault();
  // Adds href attribute to variable
  var imageLocation = $(this).prev().attr("href");
  // Add the image src to $image
  $image.attr("src", imageLocation);
  // Fade in the overlay
  $overlay.fadeIn("slow");
});

// When the overlay is clicked
$overlay.click(function() {
  // Fade out the overlay
  $(this).fadeOut("slow");
});

// When next button is clicked
$nextButton.click(function(event) {
  // Hide the current image
  $("#overlay img").hide();
  // Overlay image location
  var $currentImgSrc = $("#overlay img").attr("src");
  // Image with matching location of the overlay image
  var $currentImg = $('#image-gallery img[src="' + $currentImgSrc + '"]');
  // Finds the next image
  var $nextImg = $($currentImg.closest(".image").next().find("img"));
  // All of the images in the gallery
  var $images = $("#image-gallery img");
  // If there is a next image
  if ($nextImg.length > 0) { 
    // Fade in the next image
    $("#overlay img").attr("src", $nextImg.attr("src")).fadeIn(800);
  } else {
    // Otherwise fade in the first image
    $("#overlay img").attr("src", $($images[0]).attr("src")).fadeIn(800);
  }
  // Prevents overlay from being hidden
  event.stopPropagation();
});

// When previous button is clicked
$prevButton.click(function(event) {
  // Hide the current image
  $("#overlay img").hide();
  // Overlay image location
  var $currentImgSrc = $("#overlay img").attr("src");
  // Image with matching location of the overlay image
  var $currentImg = $('#image-gallery img[src="' + $currentImgSrc + '"]');
  // Finds the next image
  var $nextImg = $($currentImg.closest(".image").prev().find("img"));
  // Fade in the next image
  $("#overlay img").attr("src", $nextImg.attr("src")).fadeIn(800);
  // Prevents overlay from being hidden
  event.stopPropagation();
});

// When the exit button is clicked
$exitButton.click(function() {
  // Fade out the overlay
  $("#overlay").fadeOut("slow");
});




//faqs
    var $titleTab = $('.title_tab');
    $('.Accordion_item:eq(0)').find('.title_tab').addClass('active').next().stop().slideDown(300);
    $('.Accordion_item:eq(0)').find('.inner_content').find('p').addClass('show');
    $titleTab.on('click', function(e) {
    e.preventDefault();
        if ( $(this).hasClass('active') ) {
            $(this).removeClass('active');
            $(this).next().stop().slideUp(500);
            $(this).next().find('p').removeClass('show');
        } else {
            $(this).addClass('active');
            $(this).next().stop().slideDown(500);
            $(this).parent().siblings().children('.title_tab').removeClass('active');
            $(this).parent().siblings().children('.inner_content').slideUp(500);
            $(this).parent().siblings().children('.inner_content').find('p').removeClass('show');
            $(this).next().find('p').addClass('show');
        }
    });

//equalHeight
var matchHeight = function () {  
  function init() {
    eventListeners();
    matchHeight();
  }  
  function eventListeners(){
    $(window).on('resize', function() {
      matchHeight();
    });
  }  
  function matchHeight(){
    var groupName = $('[data-match-height]');
    var groupHeights = [];
    
    groupName.css('min-height', 'auto');
    
    groupName.each(function() {
      groupHeights.push($(this).outerHeight());
    });
    
    var maxHeight = Math.max.apply(null, groupHeights);
    groupName.css('min-height', maxHeight);
  };  
  return {
    init: init
  };
  
} ();
$(document).ready(function() {
  matchHeight.init();
});

//equalHeight end
