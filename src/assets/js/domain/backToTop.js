jQuery(document).ready(function() {
    (function($){

        const $backButton = document.getElementById('back-to-top'),
            $html = $("html,body"),
            $window = $(window);

        let scrollBackTrigger = 100;

        function backToTop() {
            $html.animate({ scrollTop: 0 }, 700);
        }

        function scrollDownToContent() {
            $html.animate({ scrollTop: window.innerHeight - 20 }, 700);
        }

        function watchButton() {
            const scrollTop = $window.scrollTop();

            if (scrollTop > scrollBackTrigger) {
                // treba da ide back
                $backButton.removeEventListener('click', scrollDownToContent);
                $backButton.addEventListener('click', backToTop);
                $backButton.classList.remove('down');
            } else {
                // ne treba da ide back
                $backButton.addEventListener('click', scrollDownToContent);
                $backButton.removeEventListener('click', backToTop);
                $backButton.classList.add('down');
            }

            //    $backButton.addEventListener('click', backToTop);
        }

        window.addEventListener('scroll', watchButton);
        watchButton();
    })(jQuery);
});