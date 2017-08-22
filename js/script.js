(function($) {
  window.anchorAnimate = function() {
    return $("a[href*='#']").on("click", function(event) {
      var hrefValue, pattern;
      pattern = /#.*$/g;
      hrefValue = pattern.exec($(this).attr("href"))[0];
      $("html, body").animate({
        scrollTop: $(hrefValue).offset().top + "px"
      });
      return event.preventDefault();
    });
  };
  return $(document).ready(function() {
    return window.anchorAnimate();
  });
})(jQuery);
