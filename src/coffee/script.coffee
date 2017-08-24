(($) ->

  anchorAnimate = () -> # Анимация перехода по якорям
    $("a[href*='#']").on "click", (event) ->
      pattern = /#.*$/g
      hrefValue = pattern.exec($(@).attr("href"))[0]
      $("html, body").animate { scrollTop: $(hrefValue).offset().top + "px" }
      event.preventDefault()


  topMenuPrepare = () -> # Подготовка к работе главного меню сайта
    $(".toggle_button").on "click", (event) ->
      $(this).toggleClass "active"
      topMenu = $("ul.top_menu")
      if topMenu? and topMenu.is(":visible") is true
        topMenu.slideUp()
      else
        topMenu.slideDown()


  $(document).ready ->
    anchorAnimate()
    topMenuPrepare()

) jQuery