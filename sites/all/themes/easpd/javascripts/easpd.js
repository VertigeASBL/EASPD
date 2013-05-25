(function ($) { $(function () {

    $(document).foundation('orbit', {timer_speed: 0});

    // comportement des boutons hi-contrast
    $('.block-styleswitcher .first').hide();
    $('.block-styleswitcher li a').click(function () {
        $('.block-styleswitcher li').toggle();
    });

    // TODO faire ça dans hook_preprocess plutôt
    $('#edit-submit').removeClass('button');

    // Changement de la taille du texte
    function change_text_size (change) {
        var body = $('body'),
        current_size = body.css('font-size'),
        new_size;

        current_size = parseInt(current_size.replace('px', ''), 10);
        new_size = current_size + change;

        body.css('font-size', new_size + "px");

        $.cookie('Drupal.visitor.text_size', new_size, { expires: 36500 });
    }

    function reset_text_size () {

        $('body').css('font-size', '100%');
        default_size = parseInt(
            $('body').css('font-size').replace('px', '')
        );
        $.cookie('Drupal.visitor.text_size', default_size, { expires: 36500 });
    }

    function set_init_size () {
        var text_size = $.cookie('Drupal.visitor.text_size');

        if ( text_size !== undefined) {
            $('body').css('font-size', text_size + "px")
        }
    };

    set_init_size();

    /* attach handlers */
    $('#text_resize_increase').click(function () {
        change_text_size(2);
    });
    $('#text_resize_decrease').click(function () {
        change_text_size(-2);
    });
    $('#text_resize_reset').click(function () {
        reset_text_size();
    });

}); })(jQuery);
