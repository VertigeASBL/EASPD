/**
 *
 */
(function ($) {

  Drupal.behaviors.styleswitcher = {
    attach: function (context, setings) {

      $('.style-switcher', context).click(function() {
        this.blur();

        var title = $(this).attr('data-rel');
        var enableOverlay = Drupal.settings.styleSwitcher.enableOverlay;

        if(enableOverlay){
          var overlay = Drupal.styleSwitcher.buildOverlay();

          overlay.fadeIn('slow', function() {
            Drupal.styleSwitcher.switchStyle(title);
            overlay.fadeOut('slow', Drupal.styleSwitcher.killOverlay);
          });
        }
        else {
          Drupal.styleSwitcher.switchStyle(title);
        }
        return false;
      });

      /**
       * Style Switcher class
       */
      Drupal.styleSwitcher = {
        /**
         * Main workhorse of the class.  Given the title of a stylesheet, do the switch
         */
        switchStyle: function(title) {
          $('link[@data-rel*=style][@rel*=alt][title]').each(function(i) {
            this.disabled = 'TRUE';
            this.disabled = !($(this).attr('title') == title);
          });

          $.cookie('styleSwitcher', title, {
            path: Drupal.settings.basePath,
            // The cookie should "never" expire.
            expires: 36500
          }
          );

        },

        /**
         * Set the style to either the last selected by the user or the default. This
         * function can safely be called outside of a ready() event, so long as it 
         * takes place after the declaration of the alternate stylesheets and the
         * declaration of the Drupal.settings object.
         */
        defaultStyle: function() {
          var d = $.cookie('styleSwitcher') || Drupal.settings.styleSwitcher.defaultStyle;
          Drupal.styleSwitcher.switchStyle(d);
        },

        /**
         * Build the overlay for transitions
         */
        buildOverlay: function() {
          var overlay = $('<div>')
            .attr('id', 'style-switcher-overlay')
            .appendTo($('body'))
            .hide()
            .css(
              {
                height:     '100%',
                width:      '100%',
                background: '#000000',
                position:   'absolute',
                top:        $(window).scrollTop(),
                left:       $(window).scrollLeft(),
                zIndex:     9999
              }
            );
          return overlay;
        },

        /**
         * Remove the overlay
         */
        killOverlay: function() {
          $('#style-switcher-overlay').remove();
        }


        }
      }

  };

}(jQuery));
