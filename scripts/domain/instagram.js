jQuery(document).ready(function() {
    (function($){

        const $grid = $('#instagram-grid');
        const $template = $grid.find('li').clone();

        getCache(init);

        function init(data) {
            $grid.empty();

            data.posts.forEach((post, key) => {
                generatePostElement(post);
            });
        }

        function generatePostElement(post) {
            const $el = $template.clone();
            const $article = $el.find('article');
            $article.attr('data-src', post.image);
            $grid.append($el);

            $article.lazy();
        }

        function getCache(callback) {
            const url = '/API/get.php';
            $.ajax({
                url: url,
                success: callback
            });
        }


    })(jQuery);
});