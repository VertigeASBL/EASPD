/**
 *
 */
(function ($) {

  Drupal.behaviors.switch_styles = {
    attach: function (context, setings) {

      $('.style-switcher', context).click(function() {
        this.blur();

        var title = $(this).attr('data-rel');
        var enableOverlay = Drupal.settings.switch_styles.enableOverlay;

        if(enableOverlay){
          var overlay = Drupal.switch_styles.buildOverlay();

          overlay.fadeIn('slow', function() {
            Drupal.switch_styles.switchStyle(title);
            overlay.fadeOut('slow', Drupal.switch_styles.killOverlay);
          });
        }
        else {
          Drupal.switch_styles.switchStyle(title);
        }
        return false;
      });

      /**
       * Style Switcher class
       */
      Drupal.switch_styles = {
        /**
         * Main workhorse of the class.  Given the title of a stylesheet, do the switch
         */
        switchStyle: function(title) {
          $('link[@data-rel*=style][@rel*=alt][title]').each(function(i) {
            this.disabled = 'TRUE';
            this.disabled = !($(this).attr('title') == title);
          });

          $.cookie('switch_styles', title, {
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
          var d = $.cookie('switch_styles') || Drupal.settings.switch_styles.defaultStyle;
          Drupal.switch_styles.switchStyle(d);
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
