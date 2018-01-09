/* ========================================================================
 * DOM-based Routing
 * Based on http://goo.gl/EUTi53 by Paul Irish
 *
 * Only fires on body classes that match. If a body class contains a dash,
 * replace the dash with an underscore when adding it to the object below.
 *
 * .noConflict()
 * The routing is enclosed within an anonymous function so that you can
 * always reference jQuery with $, even when in .noConflict() mode.
 * ======================================================================== */

(function($) {

  // Use this variable to set up the common and page specific functions. If you
  // rename this variable, you will also need to rename the namespace below.
  var Sage = {
    // All pages
    'common': {
      init: function() {
        // JavaScript to be fired on all pages

          $(document).ready(function () {

                // FUNCTIONS
                owl();
                owlContent();
                nav();
                formNav();
                forms();

          });

          {
              var forms = function () {

                  // DATE
                  jQuery( "#user_date" ).datepicker();

                  $('body').find('.form-enable').each(function(){

                      $(this).find('.form-submit').on('click', function(){

                          jQuery('body').find('.form-loader').show();

                          jQuery('.form-holder').addClass('blur-form');

                          var height = $(this).parents('.form-holder').height();
                          var current_form_id = $(this).parents('form').attr('id');
                          var current_form = $(this).parents('form');
                          var current_form_message = $(this).parents('form').attr('data-message');
                          var current_form_request = $(this).parents('form').attr('data-exist');
                          var form_data = jQuery(current_form).serialize();

                          // SET LOADER HEIGHT
                          $('.form-loader').height(height);

                          jQuery('#'+current_form_id+' input').removeClass('is-error');

                          jQuery.ajax({
                              url: ajaxurl,
                              type: "POST",
                              data: {
                                  'action': current_form_id,
                                  'data': form_data,
                                  'type': 'booking'
                              },
                              dataType: "json"
                          }).done(function(data){

                              jQuery('.form-holder').removeClass('blur-form');

                              jQuery('body').find('.form-loader').hide();

                              if(data.status){

                                  jQuery('#'+current_form_id).find('.status-message').show().html(current_form_message);
                                  jQuery('#'+current_form_id+' input').val('');

                              } else {

                                  if(data != 'exist') {

                                      //CLEAR STATUS MESSAGE
                                      jQuery.each(data.fields, function (index, value) {
                                          if (!value) {
                                              jQuery('#'+current_form_id+' #' + index).addClass('is-error');
                                          }
                                      });

                                  } else {

                                      jQuery('#'+current_form_id).find('.status-message').show().html(current_form_request);

                                  }

                              }

                          }).fail(function(event){
                              //console.log(event);
                          });


                      });

                  });

              }
          }

          {
              var formNav = function () {

                $('body').find('[data-form]').on('click', function(){

                    $('body').find('[data-form]').removeClass('active-form-nav');
                    $(this).addClass('active-form-nav');

                    var show = $(this).attr('data-form');

                    $('.form-item').hide();
                    $('#'+show).show();

                });

              }
          }

          {
              var nav = function () {

                  var top_position = jQuery(window).scrollTop();

                  if(top_position > 150){
                      $('.nav-holder').addClass('sticky-nav');
                  } else {
                      $('.nav-holder').removeClass('sticky-nav');
                  }

                 $(window).on('scroll', function(){

                     top_position = jQuery(window).scrollTop();

                     if(top_position > 150){
                        $('.nav-holder').addClass('sticky-nav');
                     } else {
                         $('.nav-holder').removeClass('sticky-nav');
                     }

                 });

                  // NAV SHIFT FUNCTIONALITY
                  $('body').find('.navbar').find('a').on('click', function(e){

                        e.preventDefault();

                        if($('body').hasClass('home')){

                            var href = $(this).attr('href');
                            var offset = $('body').find('[data-href="'+href+'"]').offset();

                            jQuery('html, body').animate({ scrollTop: (offset.top) - 40 }, 'slow');

                        } else {

                            var href = $(this).attr('href');

                            var home_url = $(this).parents('.nav-holder').attr('data-home');

                            window.location.href = home_url + "#" + href;

                        }

                  });

              }
          }

          {
              var owl = function () {

                  $('.enable-owl').on('initialized.owl.carousel', function(e) {
                      var bg = $('.top-slider').find('.active').children('.item').attr('data-bg');
                      var currentItem = e.item.index;
                      changeColor(bg,currentItem);
                  });

                  $('.enable-owl').owlCarousel({
                      loop:true,
                      margin:0,
                      nav:true,
                      animateOut: 'fadeOutDown',
                      animateIn: 'fadeInDown',
                      autoplay:true,
                      autoplayTimeout:10000,
                      autoplayHoverPause:true,
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
                  });

                  $('.enable-owl').on('translate.owl.carousel', function(e) {
                      var bg = $('.top-slider').find('.owl-animated-in').children('.item').attr('data-bg');
                      var currentItem = e.item.index;
                      changeColor(bg,currentItem);
                  });
                  $('.enable-owl').on('translated.owl.carousel', function(e) {
                      var bg = $('.top-slider').find('.active').children('.item').attr('data-bg');
                      var currentItem = e.item.index;
                      changeColor(bg,currentItem);
                  });

              }
          }

          {
              var changeColor = function (color, current) {
                  current = current - 2;
                  $('.top-slider').css({
                      'background-color': color
                  });
                  $('.contact-inner .icon, .footer').css({
                      'background-color': color
                  });
                  $('.form-nav .icon').removeClass(function (index, className) {
                      return (className.match (/(^|\s)icon_\S+/g) || []).join(' ');
                  });
                  $('.form-nav .icon').addClass('icon_'+current);
                  $('.navbar').removeClass(function (index, className) {
                      return (className.match (/(^|\s)nav_hover_\S+/g) || []).join(' ');
                  });
                  $('.navbar').addClass('nav_hover_'+current);
              }
          }

          {
              var owlContent = function () {
                  $('.enable-content-owl').each(function(){
                      var view = $(this).attr('data-view');
                      $(this).owlCarousel({
                          loop:true,
                          margin:25,
                          nav:true,
                          responsive:{
                              0:{
                                  items:1
                              },
                              600:{
                                  items:1
                              },
                              1000:{
                                  items:parseInt(view)
                              }
                          }
                      })
                  });
              }
          }

      },
      finalize: function() {
        // JavaScript to be fired on all pages, after page specific JS is fired
      }
    },
    // Home page
    'home': {
      init: function() {
        // JavaScript to be fired on the home page
      },
      finalize: function() {
        // JavaScript to be fired on the home page, after the init JS
      }
    },
    // About us page, note the change from about-us to about_us.
    'about_us': {
      init: function() {
        // JavaScript to be fired on the about us page
      }
    }
  };

  // The routing fires all common scripts, followed by the page specific scripts.
  // Add additional events for more control over timing e.g. a finalize event
  var UTIL = {
    fire: function(func, funcname, args) {
      var fire;
      var namespace = Sage;
      funcname = (funcname === undefined) ? 'init' : funcname;
      fire = func !== '';
      fire = fire && namespace[func];
      fire = fire && typeof namespace[func][funcname] === 'function';

      if (fire) {
        namespace[func][funcname](args);
      }
    },
    loadEvents: function() {
      // Fire common init JS
      UTIL.fire('common');

      // Fire page-specific init JS, and then finalize JS
      $.each(document.body.className.replace(/-/g, '_').split(/\s+/), function(i, classnm) {
        UTIL.fire(classnm);
        UTIL.fire(classnm, 'finalize');
      });

      // Fire common finalize JS
      UTIL.fire('common', 'finalize');
    }
  };

  // Load Events
  $(document).ready(UTIL.loadEvents);

})(jQuery); // Fully reference jQuery after this point.
