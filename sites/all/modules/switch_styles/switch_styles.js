(function ($) { $(function () {

    var switch_styles_styles = ['default', 'hi-contrast'];

    function set_style_cookie (style) {
        $.cookie('Drupal.visitor.switch_styles', style, {
            expires: 36500
        });
    }

    $('.block-switch-styles a').click(function (event) {

        // on ne change rien pour les ctr-click etc.
        if ( event.which === 2 || event.metaKey ) { return true; }

        var target_style = $(this).data('target-style');
        set_style_cookie(target_style);

        for (var i = 0; i < switch_styles_styles.length; i++) {
            $('body').removeClass(switch_styles_styles[i]);
        }

        $('body').addClass(target_style);

        event.preventDefault();
        return false;
    });
    
});})(jQuery);
