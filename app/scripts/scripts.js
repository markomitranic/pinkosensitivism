'use strict';

jQuery(document).ready(function () {
    (function ($) {

        var $grid = $('#instagram-grid');
        var $template = $grid.find('li').clone();

        getCache(init);

        function init(data) {
            $grid.empty();

            data.posts.forEach(function (post, key) {
                generatePostElement(post);
            });
        }

        function generatePostElement(post) {
            var $el = $template.clone();
            var $article = $el.find('article');
            $article.attr('data-src', post.image);
            $grid.append($el);

            $article.lazy();
        }

        function getCache(callback) {
            var url = '/API/get.php';
            $.ajax({
                url: url,
                success: callback
            });
        }
    })(jQuery);
});
"use strict";

jQuery(document).ready(function () {
    (function ($) {

        var $backButton = $(".back-to-top");
        var $html = $("html,body");
        var $window = $(window);

        if ($backButton.length) {
            var scrollTrigger = 100,
                backToTop = function backToTop() {
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