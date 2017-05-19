jQuery(document).ready(function() {
    (function($){

        var $backButton = $(".back-to-top");
        var $html = $("html,body");
        var $window = $(window);

        if ($backButton.length) {
            var scrollTrigger = 100,
                backToTop = function () {
                    var scrollTop = $window.scrollTop();

                    if (scrollTop > scrollTrigger) {
                        $backButton.addClass('show');
                    } else {
                        $backButton.removeClass('show');
                    }
                };

            $window.on('scroll', function () {
                backToTop();
            });
            backToTop();

        }

        $backButton.on('click', function (e) {
            e.preventDefault();
            $html.animate({ scrollTop: 0 }, 700);
        });

    })(jQuery);
});