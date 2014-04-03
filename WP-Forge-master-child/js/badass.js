jQuery( document ).ready(function( $ ) {

  var is_touch_device = 'ontouchstart' in document.documentElement;

  $('.no-go').on('click', function(e){
    e.preventDefault();
  })

  $('.top-bar .toggle-topbar a').on('click', function(){

    if ($('#wrapper').hasClass('expanded-menu')) {
      $('#wrapper').toggleClass('expanded-menu');
      setTimeout(function(){            
        $('.top-bar-container').toggleClass('expanded-menu');
      }, 1000);
    } else {

      $('#wrapper').toggleClass('expanded-menu');
      $('.top-bar-container').toggleClass('expanded-menu');
    }
     
  })

  /* Trigger event volunteer form */
  /*-----------------*/

  $('button.volunteer-form-trigger').on('click', function(){
    $('div.volunteer-form').slideToggle('slow');
  })

  /* Animate logo on scroll */
  /*-----------------*/

  $( window ).scroll(function() {

    var height = $(window).scrollTop();

    if ((height  > 80) && (!$('.top-bar-container .top-bar .top-bar-section ul li.top-cta').hasClass('after-scroll'))) {
      $('.top-bar-container .top-bar .top-bar-section ul li.top-cta').toggleClass('after-scroll');
    } else if ((height <= 79 ) && $('.top-bar-container .top-bar .top-bar-section ul li.top-cta').hasClass('after-scroll'))  {
      $('.top-bar-container .top-bar .top-bar-section ul li.top-cta').toggleClass('after-scroll');
    }

  });

  /* Show background image */
  /*-----------------*/
  
  // Attach button to DOM
  $('<button class="ba-btn show-bg-image has-paint-it-blue">Show background image</button>').insertBefore('#wrapper');

  $('button.show-bg-image').on('click', function(){
    
    $(this).toggleClass('showing-background');

    if ($(this).hasClass('showing-background')){
      $(this).html('Show content');
    } else {
      $(this).html('Show background image');
    }

    $('#wrapper').toggleClass('showing-background');

    $('#myatu_bgm_overlay').toggleClass('showing-background');

    $('#myatu_bgm_img_group').toggleClass('showing-background');

  })

  /* Paint it blue */
  /*-----------------*/
  
  // Attach button to DOM
  $('<button class="ba-btn paint-it-blue">Paint it blue</button>').insertBefore('#wrapper');

  $('button.paint-it-blue').on('click', function(){
    
    $('body').toggleClass('paint-it-blue');

  }) 

  // if on the front page

  if ($('.front-page')[0]) {

    // add front page class to wrapper

    $('#wrapper').addClass('front-page');

    if (!is_touch_device) {

      /* Auto pop-up newsletter dialogue */
      /*-----------------*/

      function getModalExpireDateCookie(name) {
        var ca = document.cookie.split(';');

        for (var i=0; i < ca.length; i++) {
          var c = ca[i].trim();
          if (c.indexOf(name)==0) {
            return c.substring(name.length+1,c.length);
          }
        }
        return null;
      }

      var modalExpireDate= getModalExpireDateCookie("NEWSLETTERMODALEXPIRE");

      var rightNow = new Date();

      rightNow = rightNow.getTime();

      rightNow = Number(rightNow);    


      if (modalExpireDate !== null) {
        modalExpireDate = Number(modalExpireDate);
      }

      if ( modalExpireDate == null || modalExpireDate < rightNow) {
        
        setTimeout(function(){            

          // Trigger clicking of the newsletter link
          $('.eModal-1').trigger('click');

          // Set NEWSLETTERMODALEXPIRE cookie
          var expireDate = rightNow + 36000000;
          document.cookie="NEWSLETTERMODALEXPIRE="+expireDate;

        }, 2500);

      }
    }

  }


  /* Implement countdown */
  /*-----------------*/

  if ($('.countdown')[0]) {
   
    // get end date
    var endDate;

    if ($('.countdown-end-date').val() !== '') {
      endDate = $('.countdown-end-date').val();
    } else {
      endDate = "Jan 1, 2020, 11:59 pm";
    }

    $('.countdown.event-countdown').countdown({
      date: endDate,
      render: function(data) {
        $(this.el).html("<div>" + this.leadingZeros(data.days, 3) + " <span>days</span></div><div>" + this.leadingZeros(data.hours, 2) + " <span>hrs</span></div><div>" + this.leadingZeros(data.min, 2) + " <span>min</span></div><div>" + this.leadingZeros(data.sec, 2) + " <span>sec</span></div>");
      }
    });

  }

  /* Draw map when user clicks on a tab that has a google map inside of it */
  /*-----------------*/

  $('.tabs a.load-map').on('click', function() {
    
    // If this tab does not have a map already inside of it

    if (!$('.google-map iframe')[0]) {
      
      // Find gmap iframe code and load it

      var gmapCode = $('.gmap-code-for-js').val();

      if (!gmapCode == '') {
        $('.google-map').append(gmapCode);
      }

    }

  });

  /* FAQ module */
  /*-----------------*/

  if ($('.faq-module')[0]) {
   
    // Bind question click to behaviors

    $('.faq-question').on('click', function(e){

      e.preventDefault();
      
      $(this).toggleClass('selected');
      $(this).parent().find('.faq-answer').slideToggle();
      
    })

  }

  /* Obstacle module */
  /*-----------------*/

  if ($('.obstacle-module')[0]) {

    var module = $('.obstacle-module');
    var selections = $(module).find('.obstacle-selection');
    var contentContainer = $(module).find('.obstacle-details-container');
    var loadingFeedback = $(module).find('.loading-feedback-container');

    function loadObstacleContent(permalink, loadingFeedback, contentContainer, module) {
      return $.ajax({
        type: 'GET',
        url: permalink,
        success: function(response) {
          
          $(contentContainer).append(response);

          // invoke foundation on the newly loaded module
          $(module).foundation('orbit', {
            bullets: false,
            slide_number: false,
            swipe: false,
            timer: false
          })
                
        }

      }).done(function(){
        setTimeout(function(){
          $(loadingFeedback).addClass('hide');
          $(contentContainer).find('.obstacle-content').removeClass('hide');
        }, 2000);
      });
    }

    // Bind selection click to behaviors

    $(selections).click(function(e){

      // scroll to top 
      $('html, body').animate({
        scrollTop: $(module).offset().top - 96 
      });

      e.preventDefault();

      // Hide existing 

      $(module).find('.obstacle-content').remove();

      // Show loading feedback

      $(loadingFeedback).removeClass('hide');

      $(contentContainer).removeClass('hide');
      
      // Store permalink

      var permalink = $(this).find('.permalink').html();

      loadObstacleContent(permalink, loadingFeedback, contentContainer, module);

      $.when(loadObstacleContent()).done(function(data){
        setTimeout(
          function(){
            // $(contentContainer).css('height', $(contentContainer).height());
        }, 3000);
      });

    })

  }

  // When near bottom of page

  var doNotOpenFooterModal = false;

  var footerTimer;
  $(window).scroll(function () {
    clearTimeout(footerTimer);
    footerTimer = setTimeout(function() {
      if (($(window).scrollTop() >= $(document).height() - $(window).height() - 10) && !$('.footer-modal').hasClass('active') && (doNotOpenFooterModal !== true)) {
        $('footer').addClass('active-footer-modal');
        $('.footer-modal').addClass('active');
      } 
    }, 50);
  });

  $('.close-footer-modal').on('click', function(){
    $('.footer-modal').removeClass('active');
    $('footer').removeClass('active-footer-modal');
    doNotOpenFooterModal = true;
  })

})