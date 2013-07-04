(function ($) { $(function () {

    function removeHoverImages () {
        $('#members_map_images img')
            .each(function (index, Element) {
                if (index !== 0) {
                    $(Element).remove();
                }
            });
    }

    function addHoverImage (src) {
        $('#members_map_images img')
            .last().after('<img src="' + src + '" usemap="#members_map">');
    }

    $('#members_map area').hover(
        function (e) {
            removeHoverImages();
            addHoverImage($(this).data('hover-image-src'));
        },
        function (e) {
            removeHoverImages();
        }
    );

}); })(jQuery);
