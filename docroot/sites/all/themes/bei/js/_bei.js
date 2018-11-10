/* Implement custom javascript here */
(function ($) {
  Drupal.behaviors.beiTheme = {
    attach: function (context, settings) {
      
      var didScroll = false;
      var reached = false;
      var actionBar = $('.l-action-bar');
      var footer = $('.l-footer');
      var target = actionBar.length && footer.length ? actionBar.offset().top - footer.height() : 0;

      $(window).on('scroll', function() {
        didScroll = true;
      });
      
      var scrollListener = self.setInterval(function() {
        if (didScroll) {
          processScroll();
        }
        didScroll = false;
      }, 100);
      
      function processScroll() {
        if (target === 0) {
          reached = true;
        }
        if (!reached) {
          var winTop = $(window).scrollTop();
          $('.l-action-bar').addClass('fixed');
            if (winTop >= target) {
            actionBar.removeClass('fixed');
            reached = true;
          }
        }
          // clear the scroll listener
        if (reached) {
          window.clearInterval(scrollListener);
          $('.block-webform-client-block-181086').show();
          $('.block-webform-client-block-181086').prepend('<div class="alert-close">X</div>');

        }
      }

      $('#abtestbutton').click(function() {
        if (Math.random() > 0.5) {
          window.location.href = "/wizard";
        }
        else {
          window.location.href = "/wizard-b";
        }
      });

      $(function(c) {
      $('.block-webform-client-block-181086').on('click', ".alert-close", function(c){
        $(this).closest($('.popup')).hide(function(c){
          });
        }); 
      });
    }
  };     
}(jQuery));
