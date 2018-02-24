(function($) {
  var anchorAnimate, phoneContactModify, servicesListMatchHeight, topMenuPrepare;
  anchorAnimate = function() { // Анимация перехода по якорям
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
  topMenuPrepare = function() { // Подготовка к работе главного меню сайта
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
  phoneContactModify = function() { // Реализация кликабельной ссылки на телефоне для смартфонов
    if (device.mobile()) {
      return $(".contact_phone").each(function() {
        var phoneLink, phoneNum;
        phoneNum = $(this).text(); // Текущее значение номера телефона
        $(this).text("");
        // Создание ссылки для звонка со смартфона
        phoneLink = document.createElement("a");
        phoneLink.setAttribute("href", "tel:" + phoneNum);
        this.appendChild(phoneLink);
        return $(phoneLink).text(phoneNum);
      });
    }
  };
  servicesListMatchHeight = function() { // Контроль высоты блоков списка услуг
    $(".services-list-title").matchHeight();
    return $(".services-list-descr").matchHeight();
  };
  $(document).ready(function() {
    anchorAnimate();
    topMenuPrepare();
    phoneContactModify();
    return servicesListMatchHeight();
  });
  return $(window).on("scroll", function(event) { // Обработка отображения кнопки наверх
    if ($(this).scrollTop() > 150) {
      return $("#to_top_button").fadeIn("600");
    } else {
      return $("#to_top_button").fadeOut("600");
    }
  });
})(jQuery);
