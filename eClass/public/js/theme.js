/**
 *  eClass - Learning Management System 
 *
 * This file contains all theme JS functions
 *
 * @package 
--------------------------------------------------------------
           Contents
--------------------------------------------------------------
* 01 - Protip
* 02 - Owl Caserol 
        - Student-view-slider-one
        - Student-view-slider
        - Testimonial-Slider
        - Patners-slider
        - Student-view-slider-two
        - Testimonial-Slider-one
        - Blog-slider
        - Business-Home-slider-two
        - Tab-Pane-Slider
        - Categories-tab-Slider
* 02 - Facts Count
* 03 - Navigation / Menu
* 04 - Smooth Scroll
* 05 - Filter
* 06 - Mailchimp Form
* 07 - Protip
* 08 - Video Play
* 08 - Preloader
* 09 - Read More
* 09 - Promo Bar

--------------------------------------------------------------*/

(function($) {
  "use strict";

/* ========================= */
  /*===== Protip =====*/
/* ========================= */
  $.protip();

  var $window = $( window )
 

/* ================================= */
  /*===== Owl Caserol =====*/
/* ================================= */
// Student-view-slider-one  
    var owl = $("#student-view-slider-one").owlCarousel({
      loop: true,
      items: 3,
      dots: false,
      nav: true,      
      autoplayTimeout: 10000,
      smartSpeed: 2000,
      autoHeight: false,
      touchDrag: true,
      mouseDrag: true,
      margin: 10,
      autoplay: true,
      slideSpeed: 600,
      navText: ['<i class="fa fa-chevron-left" aria-hidden="true"></i>', '<i class="fa fa-chevron-right" aria-hidden="true"></i>'],
      responsive: {
        0: {
            items: 1,
            nav: false,
            dots: false,
        },
        600: {
            items: 2,
            nav: false,
            dots: false,
        },
        768: {
            items: 3,
            nav: false,
            dots: false,
        },
        1100: {
            items: 3,
            nav: true,
            dots: false,
        }
      }
    });
    
// Student-view-slider  
    $("#student-view-slider").owlCarousel({
      loop: true,
      items: 5,
      dots: false,
      nav: true,      
      autoplayTimeout: 10000,
      smartSpeed: 2000,
      autoHeight: false,
      touchDrag: true,
      mouseDrag: true,
      margin: 10,
      autoplay: true,
      slideSpeed: 600,
      navText: ['<i class="fa fa-chevron-left" aria-hidden="true"></i>', '<i class="fa fa-chevron-right" aria-hidden="true"></i>'],
      responsive: {
        0: {
            items: 1,
            nav: false,
            dots: false,
        },
        400: {
            items: 2,
            nav: false,
            dots: false,
        },
        600: {
            items: 2,
            nav: false,
            dots: false,
        },
        768: {
            items: 3,
            nav: false,
            dots: false,
        },
        1100: {
            items: 4,
            nav: true,
            dots: false,
        }
      }
    });

// Testimonial-Slider  
    $("#testimonial-slider").owlCarousel({
      loop: true,
      items: 3,
      dots: false,
      nav: true,      
      autoplayTimeout: 10000,
      smartSpeed: 2000,
      autoHeight: false,
      touchDrag: true,
      mouseDrag: true,
      margin: 20,
      autoplay: true,
      slideSpeed: 600,
      navText: ['<i class="fa fa-chevron-left" aria-hidden="true"></i>', '<i class="fa fa-chevron-right" aria-hidden="true"></i>'],
      responsive: {
        0: {
            items: 1,
            nav: false,
            dots: false,
        },
        600: {
            items: 1,
            nav: false,
            dots: false,
        },
        768: {
            items: 2,
            nav: false,
            dots: false,
        },
        1100: {
            items: 3,
            nav: true,
            dots: false,
        }
      }
    });

 // Patners-slider  
    $("#patners-slider").owlCarousel({
      loop: true,
      items: 6,
      dots: false,
      nav: true,      
      autoplayTimeout: 10000,
      smartSpeed: 2000,
      autoHeight: false,
      touchDrag: true,
      mouseDrag: true,
      margin: 20,
      autoplay: true,
      slideSpeed: 600,
      navText: ['<i class="flaticon-back" aria-hidden="true"></i>', '<i class="flaticon-next-1" aria-hidden="true"></i>'],
      responsive: {
        0: {
            items: 1,
            nav: false,
            dots: false,
        },
        600: {
            items: 3,
            nav: false,
            dots: false,
        },
        768: {
            items: 6,
            nav: false,
            dots: false,
        },
        1100: {
            items: 6,
            nav: false,
            dots: false,
        }
      }
    });

  // Student-view-slider-two 
    var owl = $("#student-view-slider-two").owlCarousel({
      loop: true,
      items: 3,
      dots: false,
      nav: true,      
      autoplayTimeout: 10000,
      smartSpeed: 2000,
      autoHeight: false,
      touchDrag: true,
      mouseDrag: true,
      margin: 10,
      autoplay: true,
      slideSpeed: 600,
      navText: ['<i class="fa fa-chevron-left" aria-hidden="true"></i>', '<i class="fa fa-chevron-right" aria-hidden="true"></i>'],
      responsive: {
        0: {
            items: 1,
            nav: false,
            dots: false,
        },
        600: {
            items: 2,
            nav: false,
            dots: false,
        },
        768: {
            items: 3,
            nav: false,
            dots: false,
        },
        1100: {
            items: 5,
            nav: true,
            dots: false,
        }
      }
    });

  // Testimonial-Slider-one 
    $("#testimonial-slider-one").owlCarousel({
      loop: true,
      items: 3,
      dots: false,
      nav: true,      
      autoplayTimeout: 10000,
      smartSpeed: 2000,
      autoHeight: false,
      touchDrag: true,
      mouseDrag: true,
      margin: 10,
      autoplay: true,
      slideSpeed: 600,
      navText: ['<i class="fa fa-chevron-left" aria-hidden="true"></i>', '<i class="fa fa-chevron-right" aria-hidden="true"></i>'],
      responsive: {
        0: {
            items: 1,
            nav: false,
            dots: false,
        },
        600: {
            items: 2,
            nav: false,
            dots: false,
        },
        768: {
            items: 3,
            nav: true,
            dots: false,
        },
        1100: {
            items: 5,
            nav: true,
            dots: false,
        }
      }
    });

  // Blog-slider 
    $("#blog-slider").owlCarousel({
      loop: true,
      items: 1,
      dots: true,
      nav: false,      
      autoplayTimeout: 10000,
      smartSpeed: 2000,
      autoHeight: false,
      touchDrag: true,
      mouseDrag: true,
      margin: 20,
      autoplay: true,
      slideSpeed: 600,
      navText: ['<i class="fa fa-chevron-left" aria-hidden="true"></i>', '<i class="fa fa-chevron-right" aria-hidden="true"></i>'],
      responsive: {
        0: {
            items: 1,
            nav: false,
            dots: true,
        },
        600: {
            items: 1,
            nav: false,
            dots: true,
        },
        768: {
            items: 1,
            nav: false,
            dots: true,
        },
        1100: {
            items: 1,
            nav: false,
            dots: true,
        }
      }
    });

  // Business-Home-slider-two  
    $("#business-home-slider-two").owlCarousel({
      loop: true,
      items: 5,
      dots: false,
      nav: true,      
      autoplayTimeout: 10000,
      smartSpeed: 2000,
      autoHeight: false,
      touchDrag: true,
      mouseDrag: true,
      margin: 20,
      autoplay: true,
      slideSpeed: 600,
      navText: ['<i class="fa fa-chevron-left" aria-hidden="true"></i>', '<i class="fa fa-chevron-right" aria-hidden="true"></i>'],
      responsive: {
        0: {
            items: 1,
            nav: false,
            dots: false,
        },
        600: {
            items: 1,
            nav: false,
            dots: false,
        },
        768: {
            items: 1,
            nav: true,
            dots: false,
        },
        1100: {
            items: 1,
            nav: true,
            dots: false,
        }
      }
    });

  // Tab-Pane-Slider
    $("#tab-pane-slider").owlCarousel({
      loop: true,
      items: 4,
      dots: false,
      nav: true,      
      autoplayTimeout: 10000,
      smartSpeed: 2000,
      autoHeight: false,
      touchDrag: true,
      mouseDrag: true,
      margin: 20,
      autoplay: true,
      slideSpeed: 600,
      navText: ['<i class="fa fa-chevron-left" aria-hidden="true"></i>', '<i class="fa fa-chevron-right" aria-hidden="true"></i>'],
      responsive: {
        0: {
            items: 1,
            nav: false,
            dots: false,
        },
        600: {
            items: 1,
            nav: false,
            dots: false,
        },
        768: {
            items: 1,
            nav: true,
            dots: false,
        },
        1100: {
            items: 4,
            nav: true,
            dots: false,
        }
      }
    });

  // Categories-tab-Slider
    $("#categories-tab-slider").owlCarousel({
      loop: true,
      items: 12,
      dots: false,
      nav: true,      
      autoplayTimeout: 10000,
      smartSpeed: 2000,
      autoHeight: false,
      touchDrag: true,
      mouseDrag: true,
      margin: 20,
      autoplay: true,
      slideSpeed: 600,
      navText: ['<i class="fa fa-chevron-left" aria-hidden="true"></i>', '<i class="fa fa-chevron-right" aria-hidden="true"></i>'],
      responsive: {
        0: {
            items: 2,
            nav: false,
            dots: false,
        },
        600: {
            items: 3,
            nav: false,
            dots: false,
        },
        768: {
            items: 5,
            nav: true,
            dots: false,
        },
        1100: {
            items: 6,
            nav: false,
            dots: false,
        }
      }
    });

  // Categories-tab-Slider
    $("#home-background-slider").owlCarousel({
      loop: true,
      items: 12,
      dots: false,
      nav: true,      
      autoplayTimeout: 10000,
      smartSpeed: 2000,
      autoHeight: false,
      touchDrag: true,
      mouseDrag: true,
      margin: 0,
      autoplay: true,
      slideSpeed: 600,
      navText: ['<i class="fa fa-chevron-left" aria-hidden="true"></i>', '<i class="fa fa-chevron-right" aria-hidden="true"></i>'],
      responsive: {
        0: {
            items: 1,
            nav: false,
            dots: false,
        },
        600: {
            items: 1,
            nav: false,
            dots: false,
        },
        768: {
            items: 1,
            nav: false,
            dots: false,
        },
        1100: {
            items: 1,
            nav: false,
            dots: false,
        }
      }
    });

    // zoom-view-slider  
    $("#zoom-view-slider").owlCarousel({
      loop: true,
      items: 5,
      dots: false,
      nav: true,      
      autoplayTimeout: 10000,
      smartSpeed: 2000,
      autoHeight: false,
      touchDrag: true,
      mouseDrag: true,
      margin: 10,
      autoplay: true,
      slideSpeed: 600,
      navText: ['<i class="fa fa-chevron-left" aria-hidden="true"></i>', '<i class="fa fa-chevron-right" aria-hidden="true"></i>'],
      responsive: {
        0: {
            items: 1,
            nav: false,
            dots: false,
        },
        400: {
            items: 2,
            nav: false,
            dots: false,
        },
        600: {
            items: 2,
            nav: false,
            dots: false,
        },
        768: {
            items: 3,
            nav: false,
            dots: false,
        },
        1100: {
            items: 4,
            nav: true,
            dots: false,
        }
      }
    });


    // bundle-view-slider  
    $("#bundle-view-slider").owlCarousel({
      loop: true,
      items: 5,
      dots: false,
      nav: true,      
      autoplayTimeout: 10000,
      smartSpeed: 2000,
      autoHeight: false,
      touchDrag: true,
      mouseDrag: true,
      margin: 10,
      autoplay: true,
      slideSpeed: 600,
      navText: ['<i class="fa fa-chevron-left" aria-hidden="true"></i>', '<i class="fa fa-chevron-right" aria-hidden="true"></i>'],
      responsive: {
        0: {
            items: 1,
            nav: false,
            dots: false,
        },
        400: {
            items: 2,
            nav: false,
            dots: false,
        },
        600: {
            items: 2,
            nav: false,
            dots: false,
        },
        768: {
            items: 3,
            nav: false,
            dots: false,
        },
        1100: {
            items: 4,
            nav: true,
            dots: false,
        }
      }
    });

    // bundle-view-slider  
    $("#bbl-view-slider").owlCarousel({
      loop: true,
      items: 5,
      dots: false,
      nav: true,      
      autoplayTimeout: 10000,
      smartSpeed: 2000,
      autoHeight: false,
      touchDrag: true,
      mouseDrag: true,
      margin: 10,
      autoplay: true,
      slideSpeed: 600,
      navText: ['<i class="fa fa-chevron-left" aria-hidden="true"></i>', '<i class="fa fa-chevron-right" aria-hidden="true"></i>'],
      responsive: {
        0: {
            items: 1,
            nav: false,
            dots: false,
        },
        400: {
            items: 2,
            nav: false,
            dots: false,
        },
        600: {
            items: 2,
            nav: false,
            dots: false,
        },
        768: {
            items: 3,
            nav: false,
            dots: false,
        },
        1100: {
            items: 4,
            nav: true,
            dots: false,
        }
      }
    });

/* ================================= */
    /*===== Facts Count  =====*/
/* ================================= */ 
    if ($('.counter').length) {   
      $('.counter').counterUp({
        delay: 20,
        time: 2000
      });
    }
    
/* ================================= */
    /*===== Navigation / Menu  =====*/
/* ================================= */ 
    $("#cssmenu").menumaker({
      title: "Menu",
      format: "multitoggle"
    });

/* ================================= */
    /*===== Smooth Scroll =====*/
/* ================================= */ 
    smoothScroll.init();


/* ================================= */
    /*===== Filter =====*/
/* ================================= */ 
// Animate Filter for Immigration Slider
    var owlAnimateFilter = function(even) {
      $(this)
      .addClass('__loading')
      .delay(70 * $(this).parent().index())
      .queue(function() {
        $(this).dequeue().removeClass('__loading')
      })
    }
    $('.btn-filter-wrap').on('click', '.btn-filter', function(e) {
      var filter_data = $(this).data('filter');
      /* return if current */
      if($(this).hasClass('btn-active')) return;
      /* active current */
      $(this).addClass('btn-active').siblings().removeClass('btn-active');
      /* Filter */
      owl.owlFilter(filter_data, function(_owl) { 
        $(_owl).find('.item').each(owlAnimateFilter); 
      });
    });

/* ================================= */
    /*===== Mailchimp Form =====*/
/* ================================= */   
    $('#subscribe-form').ajaxChimp({
        url: 'http://blahblah.us1.list-manage.com/subscribe/post?u=5afsdhfuhdsiufdba6f8802&id=4djhfdsh9'
    });

/* ========================= */
  /*===== Protip =====*/
/* ========================= */
    $.protip();
    $("#aBtn").on('click',function(){
      console.log($(window).height());
      $("#popupBox").height($(window).height());
      $(".overlay").height($(window).height())
      $("#popupBox").addClass("show");
      $("body").addClass("hide_sb");
    });
    $(".overlay").on('click',function(){
      $("#popupBox").removeClass("show");
      $("body").removeClass("hide_sb")
    });
    $(".close").on('click',function(){
      $("#popupBox").removeClass("show");
      $("body").removeClass("hide_sb")
    });

/* ================================= */
      /*===== Video Play =====*/
/* ================================= */    
  $('.btn-video-play').on('click',function() {
    $('.video-item .video-preview').append(video_url);
    $(this).hide();
  }); 
    
/* ================================= */
  /*===== Preloader =====*/
/* ================================= */ 
  $window.on('load', function()  { 
    $('.status').fadeOut();
    $('.preloader').fadeOut('slow'); 
  }); 


/* ================================= */
  /*===== Payment Radio Button =====*/
/* ================================= */
  $('#r11').on('click', function(){
  $(this).parent().find('a').trigger('click')
  })
  $('#r12').on('click', function(){
  $(this).parent().find('a').trigger('click')
  })
  $('#r13').on('click', function(){
  $(this).parent().find('a').trigger('click')
  })
  $('#r14').on('click', function(){
  $(this).parent().find('a').trigger('click')
  })
  $('#r15').on('click', function(){
  $(this).parent().find('a').trigger('click')
  })
  $('#r16').on('click', function(){
  $(this).parent().find('a').trigger('click')
  })
  $('#r17').on('click', function(){
  $(this).parent().find('a').trigger('click')
  })
  $('#r18').on('click', function(){
  $(this).parent().find('a').trigger('click')
  })



/* ================================= */
  /*===== Notification Icon =====*/
/* ================================= */
  $(document).ready(function()
  {
  $("#notificationLink").on('click',function()
  {
  $("#notificationContainer").fadeToggle(300);
  $("#notification_count").fadeOut("slow");
  return false;
  });

  //Document Click hiding the popup 
  $(document).on('click',function()
  {
  $("#notificationContainer").hide();
  });
 

  });

  $(document).ready(function()
  {
  $("#notificationLinkk").on('click',function()
  {
  $("#notificationContainerr").fadeToggle(300);
  $("#notification_countt").fadeOut("slow");
  return false;
  });

  //Document Click hiding the popup 
  $(document).on('click',function()
  {
  $("#notificationContainerr").hide();
  });
 

  });

/* ========================= */
  /*===== Tooltip =====*/
/* ========================= */
  $(function () {
    $('[data-toggle="tooltip"]').tooltip()
  })

/* ========================= */
  /*===== Select 2 =====*/
/* ========================= */
$(document).ready(function() 
{  $('.js-example-basic-single').select2();
});


/* ================================ */
  /*===== Navbar name show/hide=====*/
/* ================================ */
 // navbar user name show 
$( ".dropdown" ).on('hover',function() {
    $( "#name" ).addClass('name-shown');
  }, function() {
    $( "#name" ).removeClass('name-shown');
  }
);


/* ================================ */
  /*===== Read More =====*/
/* ================================ */
$('.moreless-button').click(function() {
  $('.moretext').slideToggle();
  if ($('.moreless-button').text() == "Read more") {
    $(this).text("Read less")
  } else {
    $(this).text("Read more")
  }
});


/* ================================ */
    /*===== Promo Bar =====*/
/* ================================ */
$("#promo-tab").hide();
$("#close").on("click", function(){
  $("#promo-outer").slideUp();
  $("#promo-tab").hide();
});
$("#promo-outer").on("click", function(){
  $("#promo-outer").slideUp();
  $("#promo-tab").hide();
});
$("#promo-tab").on("click", function(){
  $(this).slideUp();
  $("#promo-outer").slideDown();
});

/* ================================ */
    /*===== Screen Search =====*/
/* ================================ */
$(function () {
    $('a[href="#find"]').on('click', function(event) {
        event.preventDefault();
        $('#find').addClass('open');
        $('#find > form > input[type="find"]').focus();
    });
    $('#find, #find button.close').on('click keyup', function(event) {
        if (event.target == this || event.target.className == 'close' || event.keyCode == 27) {
            $(this).removeClass('open');
        }
    });
});

/* ================================ */
    /*===== Side Humburger =====*/
/* ================================ */
$(document).ready(function () {
  var trigger = $('.hamburger'),
      overlay = $('.overlay'),
     isClosed = false;
    trigger.click(function () {
      hamburger_cross();
    });
    function hamburger_cross() {
      if (isClosed == true) {
        overlay.hide();
        trigger.removeClass('is-open');
        trigger.addClass('is-closed');
        isClosed = false;
      } else {
        overlay.show();
        trigger.removeClass('is-closed');
        trigger.addClass('is-open');
        isClosed = true;
      }
  }
  $('[data-toggle="offcanvas"]').click(function () {
        $('#wrapper').toggleClass('toggled');
  });
});


})(jQuery);
