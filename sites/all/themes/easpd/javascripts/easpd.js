(function ($) { $(function () {

    $(document).foundation('orbit', {timer_speed: 0});

    // on vire ll link ajouté en cas d'absence de js
    $('head link').last().remove();

    // comportement des boutons hi-contrast
    $('.block-styleswitcher .first').hide();
    $('.block-styleswitcher li a').click(function () {
        $('.block-styleswitcher li').toggle();
    });

    $('#edit-submit').removeClass('button')

}); })(jQuery);
