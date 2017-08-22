(($) ->

  window.anchorAnimate = () -> # Анимация перехода по якорям
    $("a[href*='#']").on "click", (event) ->
      pattern = /#.*$/g
      hrefValue = pattern.exec($(@).attr("href"))[0]
      $("html, body").animate { scrollTop: $(hrefValue).offset().top + "px" }
      event.preventDefault()

  $(document).ready ->
    window.anchorAnimate()

) jQuery