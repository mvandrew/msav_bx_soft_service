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


  phoneContactModify = () -> # Реализация кликабельной ссылки на телефоне для смартфонов
    if device.mobile()
      $(".contact_phone").each ->
        phoneNum = $(@).text() # Текущее значение номера телефона
        $(@).text ""

        # Создание ссылки для звонка со смартфона
        phoneLink = document.createElement "a"
        phoneLink.setAttribute "href", "tel:" + phoneNum
        @.appendChild phoneLink
        $(phoneLink).text phoneNum


  servicesListMatchHeight = () -> # Контроль высоты блоков списка услуг
    $(".services-list-title").matchHeight()
    $(".services-list-descr").matchHeight()


  $(document).ready ->
    anchorAnimate()
    topMenuPrepare()
    phoneContactModify()
    servicesListMatchHeight()

) jQuery