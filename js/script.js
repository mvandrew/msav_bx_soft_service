(function($) {
  var anchorAnimate, topMenuPrepare;
  anchorAnimate = function() {
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
  topMenuPrepare = function() {
    return $(".toggle_button").on("click", function(event) {
      var topMenu;
      $(this).toggleClass("active");
      topMenu = $("ul.top_menu");
      if ((topMenu != null) && topMenu.is(":visible") === true) {
        return topMenu.slideUp();
      } else {
        return topMenu.slideDown();
      }
    });
  };
  return $(document).ready(function() {
    anchorAnimate();
    return topMenuPrepare();
  });
})(jQuery);
