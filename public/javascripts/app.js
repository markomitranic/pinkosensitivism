// SCRIPT: ga.js
(function (i, s, o, g, r, a, m) {
  i["GoogleAnalyticsObject"] = r;
  (i[r] =
    i[r] ||
    function () {
      (i[r].q = i[r].q || []).push(arguments);
    }),
    (i[r].l = 1 * new Date());
  (a = s.createElement(o)), (m = s.getElementsByTagName(o)[0]);
  a.async = 1;
  a.src = g;
  m.parentNode.insertBefore(a, m);
})(
  window,
  document,
  "script",
  "https://www.google-analytics.com/analytics.js",
  "ga"
);

ga("create", "UA-99590711-1", "auto");
ga("send", "pageview");

// SCRIPT: backToTop.js
jQuery(document).ready(function () {
  (function ($) {
    const $backButton = document.getElementById("back-to-top"),
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
        $backButton.removeEventListener("click", scrollDownToContent);
        $backButton.addEventListener("click", backToTop);
        $backButton.classList.remove("down");
      } else {
        // ne treba da ide back
        $backButton.addEventListener("click", scrollDownToContent);
        $backButton.removeEventListener("click", backToTop);
        $backButton.classList.add("down");
      }
      //    $backButton.addEventListener('click', backToTop);
    }

    window.addEventListener("scroll", watchButton);
    watchButton();
  })(jQuery);
});

// SCRIPT: instagram.js
jQuery(document).ready(function () {
  (function ($) {
    $(".lazy").lazy();
  })(jQuery);
});
