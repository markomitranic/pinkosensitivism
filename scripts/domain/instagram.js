jQuery(document).ready(function() {
    (function($){
        var posts = [];
        var limit = 20;
        var $container = $('.instagram-grid');

        var $template = $('.post-template');

        getData(populate);
        function getData(callback) {
            $.getJSON( "/instagram.php", function( data ) {
                posts = data.posts;
                callback(0);
            });
        }

        function populate(skip) {
            for (i = 0; i < 20; i++) {
                createPost(posts[i]);
            }
        }
        function createPost(data) {
            var $post = $template.clone();
            $post.find('article').css('background-image', 'url(' + data.image + ')')
            $post.appendTo($container).fadeIn('slow');
        }



    })(jQuery);
});