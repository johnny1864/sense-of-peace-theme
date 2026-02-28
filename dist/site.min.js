/*!
 * Custom Scripts
 */
document.documentElement.className =
  document.documentElement.className.replace(/\bno-js\b/g, "") + "js";

if (window.location.hash) {
  setTimeout(function () {
    window.scrollTo(0, 0);
  }, 2);
}

var LazyLoading;

jQuery(document).ready(function ($) {
  /*-----------------------------------------------------------------------------GLOBAL ON LOAD----*/

  LazyLoading = (function () {
    var instance = new LazyLoad();

    function lazyBGImages() {
      var bgImages = document.querySelectorAll("[data-bg]:not(.lazy)");
      if (bgImages.length) {
        bgImages.forEach(function (bgImage) {
          bgImage.classList.add("lazy");
        });
      }
      instance.update();
    }

    function update() {
      lazyBGImages();
    }

    lazyBGImages();

    return {
      update: update,
    };
  })();

  var SmoothScroll = (function () {
    var $anchorLinks = $('a[href^="#"]').not('a[href="#"]');

    $('a[href="#"]').click(function (e) {
      e.preventDefault();
      return;
    });

    function goTo(target) {
      if (target === "" || !$(target).length) {
        return;
      }
      var scrollPos =
        typeof target === "number" ? target : $(target).offset().top;

      if (window.innerWidth >= 720) {
        scrollPos -= $("header").outerHeight();
      } else {
        scrollPos -= $("header").outerHeight() * 2;
      }

      $("html, body")
        .stop()
        .animate(
          {
            scrollTop: scrollPos - 32,
          },
          1200,
          "swing",
          function () {
            if (typeof target === "string") {
              if (window.location.hash) {
                // window.location.hash = target;
              }
            }
          }
        );
    }

    if (window.location.hash) {
      setTimeout(function () {
        goTo(window.location.hash);
      }, 500);
    }

    if ($anchorLinks.length) {
      $anchorLinks.on("click", function (e) {
        if (!$("#" + this.hash.replace("#", "")).length) {
          return;
        }
        e.preventDefault();
        goTo(this.hash);
      });
    }

    return { to: goTo };
  })();

  //Global function to toggle simple accordions
  var Accordions = (function () {
    var $accordions = $(".accordion");
    if (!$accordions.length) {
      return;
    }

    $accordions.each(function () {
      if ($(this).hasClass("active")) {
        $(this).find(".accordion__content").show();
      }
    });

    $accordions.find(".accordion__trigger").click(function (e) {
      var $this = $(this);
      var $accordion = $this.parent();
      var $content = $accordion.find(".accordion__content");
      var $siblings = $accordion.siblings().length
        ? $accordion.siblings()
        : $accordions.filter('[data-group="' + $accordion.data("group") + '"]');

      if ($accordion.hasClass("active")) {
        $accordion.removeClass("active");
        $content.slideUp("fast");
      } else {
        $accordion.addClass("active");
        $siblings
          .removeClass("active")
          .find(".accordion__content")
          .slideUp("fast");
        $content.slideDown("fast");
      }
    });
  })();

  var Forms = (function () {
    var InputMasks = (function () {
      var $masks = $("[data-mask]");
      if (!$masks.length) {
        return;
      }

      /**
       * Key Codes:
       * 8    - backspace
       * 13   - enter
       * 16   - shift
       * 18   - alt
       * 20   - caps
       * 27   - esc
       * 37   - left arrow
       * 38   - up arrow
       * 39   - right arrow
       * 40   - down arrow
       * 46   - delete
       **/
      var exclude_keys = [8, 13, 16, 18, 20, 27, 37, 38, 39, 40, 46];

      $("[data-mask]").keyup(function (e) {
        console.log(e.keyCode);
        if (exclude_keys.indexOf(e.keyCode) > -1) {
          return;
        }

        switch (this.dataset.mask) {
          case "digits":
            var x = this.value.replace(/\D/g, "");
            this.value = x;
            break;
          case "phone":
            var x = this.value
              .replace(/\D/g, "")
              .match(/(\d{0,3})(\d{0,3})(\d{0,4})/);
            console.log(x);
            this.value = !x[2]
              ? x[1]
              : "(" + x[1] + ") " + x[2] + (x[3] ? "-" + x[3] : "");
            break;
          case "ssn": {
            var x = this.value
              .replace(/\D/g, "")
              .match(/^(\d{0,3})(\d{0,2})(\d{0,4})/);
            this.value = !x[2] ? x[1] : x[1] + "-" + x[2] + "-" + x[3];
          }
        }
      });
    })();

    //Plugin used for form validation
    var parselyOptions = {
      classHandler: function (parsleyField) {
        var $element = parsleyField.$element;
        if ($element.parent().hasClass("select-menu")) {
          return $element.parent();
        }
        return $element;
      },
      errorsContainer: function (parsleyField) {
        var $element = parsleyField.$element;
        var $fieldContainer = $element.closest(".form-field");
        if ($fieldContainer) {
          return $fieldContainer;
        }
      },
    };

    //Global function to set form state classes
    var formStates = (function () {
      $formInputs = $("form :input");
      if (!$formInputs.length) {
        return;
      }

      $formSelectMenus = $(
        ".select-menu select, .ginput_container_select select"
      );

      function setFilled($input) {
        $input.addClass("filled");
      }

      function removeFilled($input) {
        $input.removeClass("filled");
      }

      function setFocused() {
        $(this).addClass("focused");
      }

      function removeFocused() {
        $(this).removeClass("focused");
      }

      function checkInput(e) {
        if (
          this.type == "button" ||
          this.type == "range" ||
          this.type == "submit" ||
          this.type == "radio" ||
          this.type == "checkbox" ||
          this.type == "reset"
        ) {
          return;
        }

        var $this = $(this);
        var $parent = $this.parent();
        var is_selectMenu =
          $parent.hasClass("select-menu") ||
          $parent.hasClass("ginput_container_select");

        var $input = is_selectMenu ? $parent : $this;

        switch (this.type) {
          case "select-one":
          case "select-multiple":
            if (this.value !== "") {
              setFilled($input);
            } else {
              removeFilled($input);
            }
            break;
          default:
            if (this.value !== "") {
              setFilled($input);
            } else {
              removeFilled($input);
            }
            break;
        }
      }

      $formInputs.each(checkInput);
      $formInputs.on("change", checkInput);
      $formInputs.on("focus", setFocused);
      $formInputs.on("blur", removeFocused);
      $formSelectMenus.on("focus", setFocused);
      $formSelectMenus.on("blur", removeFocused);
    })();
    return { options: parselyOptions };
  })();

  //Global function top open / close lightboxes
  var PDMLightbox = (function () {
    //Lightbox reset - This lightbox is empty and present on all pages
    var $lightbox = $(".pdm-lightbox--reset");

    //it's content can be filled from various sources
    //after close, the content is wiped
    var $lightbox_content = $(".pdm-lightbox--reset .pdm-lightbox__content");

    $("body").on(
      "click",
      "[data-lightbox-iframe],[data-lightbox-content],[data-lightbox-target],.lightbox-trigger",
      function (e) {
        e.preventDefault();

        var iframe = $(this).data("lightbox-iframe");

        if (iframe) {
          var youtubePattern =
            /(?:http?s?:\/\/)?(?:www\.)?youtu(be\.com\/|\.be\/)(embed\/(.+)(\?.+)?|watch\?v=(.+)(\&.+)?)/g;
          var vimeoPattern =
            /(?:http?s?:\/\/)?:\/\/(www\.|player\.)?vimeo\.com\/(?:channels\/(?:\w+\/)?|groups\/([^\/]*)\/videos\/|video\/|)(\d+)(?:|\/\?)/g;

          if (youtubePattern.test(iframe)) {
            classes += " youtube-vid";

            replacement =
              '<div class="spacer"><iframe width="560" height="315" frameborder="0" allowfullscreen src="//www.youtube.com/embed/$3?rel=0&autoplay=1&modestbranding=1&iv_load_policy=3" /></div>';

            iframe = iframe.replace(youtubePattern, replacement);
          }

          if (vimeoPattern.test(iframe)) {
            classes += " vimeo-vid";

            replacement =
              '<div class="spacer"><iframe width="560" height="315" frameborder="0" allowfullscreen src="//player.vimeo.com/video/$3?rel=0&autoplay=1&modestbranding=1&iv_load_policy=3" /></div>';

            iframe = iframe.replace(vimeoPattern, replacement);
          }

          $lightbox_content.html(
            '<div class="video-embed">' + iframe + "</div>"
          );
        } else {
          if ($(this).data("lightbox-content")) {
            var content = $(this).data("lightbox-content");
          } else if ($(this).data("lightbox-target")) {
            var target = $(this).data("lightbox-target");
            var content = $("#" + target).html();
          } else {
            var content = $(this).next(".lightbox-content").html();
          }
          $lightbox_content.html(content);
        }

        var classes = $(this).data("lightbox-classes");
        $lightbox.addClass("active").addClass(classes);
      }
    );

    function closeModal($lightbox) {
      $lightbox.removeClass("active");
      $("body").removeClass("noScroll");
      //wait before removing classes till lightbox closses
      if ($lightbox.hasClass("pdm-lightbox--reset")) {
        setTimeout(function () {
          $lightbox.find(".pdm-lightbox__content").empty();
          $lightbox.attr("class", "pdm-lightbox pdm-lightbox--reset");
        }, 750);
      }
    }

    function openModal($lightbox) {
      $lightbox.addClass("active");
      $("body").addClass("noScroll");
    }

    function updateModal($lightbox, $content) {
      $lightbox.find(".pdm-lightbox__content").html($content);
    }

    $(".pdm-lightbox").on("click", function (e) {
      if (e.target == this) {
        closeModal($(this));
      }
    });

    $(".pdm-lightbox__close").click(function (e) {
      e.stopPropagation();
      closeModal($(this).closest(".pdm-lightbox"));
    });
    return {
      close: closeModal,
      open: openModal,
      update: updateModal,
    };
  })();

  //******************************************************Everything under this is optional, feel free to delete

  var Header = (function () {
    var $body = $("body");

    if ($body.hasClass("child-theme")) {
      return;
    }

    var $header = $("header.gheader");
    var $nav = $header.find("nav.global");
    var $adminBar = $("#wpadminbar");

    var header_height = $header.innerHeight();
    if ($adminBar.length) {
      header_height += $adminBar.innerHeight();
    }
    if (window.innerWidth < 960) {
      $nav.css({ marginTop: header_height });
    }

    var BurgerMenu = (function () {
      var $burgerMenu = $header.find(".menu-burger");
      var $text = $burgerMenu.find(".menu-burger__text");

      function activate() {
        $burgerMenu.addClass("active").attr("title", "Close");
        $text.text("Close");
        $nav.addClass("active");
        $body.addClass("no-scroll");

        var styles = { position: "fixed" };
        if ($adminBar.length) {
          styles.top = $adminBar.innerHeight();
        }

        $header.css(styles);
        $body.css({ marginTop: $header.innerHeight() });
      }

      function reset() {
        $burgerMenu.removeClass("active").attr("title", "Menu");
        $text.text("Menu");
        $nav.removeClass("active").find(".active").removeClass("active");
        $body.removeClass("no-scroll");

        var styles = { position: "sticky" };
        if ($adminBar.length) {
          styles.top = $adminBar.innerHeight();
        }

        $header.css(styles);
        $body.css({ marginTop: 0 });
      }

      $burgerMenu.click(function () {
        var $this = $(this);

        if ($this.hasClass("active")) {
          reset();
        } else {
          activate();
        }
      });

      return {
        close: reset,
        open: activate,
      };
    })();

    var DropdownMenus = (function () {
      var $menus = $(".menu");
      var $dropmenus = $menus.find(".menu-item__dropdown");
      var $mobileArrow = $dropmenus.find(".mobile-arrow");

      function toggleDropdown(e) {
        e.preventDefault();

        var $this = $(this);
        var $menuItem = $this.parent();

        if ($menuItem.hasClass("active")) {
          $menuItem.removeClass("active");
        } else {
          $menuItem.addClass("active");
        }
      }

      $mobileArrow.click(toggleDropdown);
    })();

    var StickyHeader = (function () {
      if (!$header.hasClass("sticky")) {
        return;
      }

      if (window.scrollY) {
        $header.addClass("sticky--scrolled");
      }

      $(window).on("scroll", function () {
        if (window.scrollY) {
          $header.addClass("sticky--scrolled");
        } else if (window.scrollY === 0) {
          $header.removeClass("sticky--scrolled");
        }

        if ($adminBar.length) {
          $header.css({ top: $adminBar.innerHeight() });
        }
      });
    })();

    window.addEventListener("resize", function () {
      $header.css({ position: "sticky" });
      BurgerMenu.close();

      var styles = { marginTop: window.innerWidth < 960 ? header_height : 0 };

      $nav.css(styles);
    });
  })();

  var StickToHeader = (function () {
    function init() {
      var $el = $(".js-header-sticky");
      if (!$el.length) {
        return false;
      }

      $el.each(function () {
        var $this = $(this);
        var header_height = $(".gheader").innerHeight();
        var $this_pos = $this.offset().top;

        $(document).on("scroll", function () {
          header_height =
            $(".gheader").innerHeight() == header_height
              ? header_height
              : $(".gheader").innerHeight();

          $this.toggleClass(
            "is-stuck",
            window.scrollY + header_height >= $this_pos
          );
          $this.css("top", header_height).attr("data-header-sticky", $this_pos);
        });
      });
    }

    init();

    return {
      refresh: init,
    };
  })();

  var LogoSlider = (function () {
    var logos = $("logos-slider");
    new Swiper(".logos-slider.swiper", {
      slidesPerView: 1,
      spaceBetween: 32,
      loop: true,
      pagination: true,
      navigation: {
        nextEl: ".logos-slider__wrapper .swiper-button-next",
        prevEl: ".logos-slider__wrapper .swiper-button-prev",
      },
      pagination: {
        el: ".logos-slider__wrapper .swiper-pagination",
        clickable: false,
      },
      breakpoints: {
        640: {
          slidesPerView: 3,
        },
        1024: {
          slidesPerView: 5,
        },
      },
    });
  })();

  var UspsSlider = (function () {
    let uspSwiper;

    function initUspSwiper() {
      if (window.innerWidth <= 767 && !uspSwiper) {
        uspSwiper = new Swiper(".hero__usps--wrapper", {
          slidesPerView: 1,
          spaceBetween: 16,
          loop: true,
          navigation: {
            nextEl: ".hero__usps--wrapper .swiper-button-next",
            prevEl: ".hero__usps--wrapper .swiper-button-prev",
          },
          pagination: {
            el: ".hero__usps--wrapper .swiper-pagination",
            clickable: false,
          }
        });
      } else if (window.innerWidth > 767 && uspSwiper) {
        uspSwiper.destroy(true, true);
        uspSwiper = undefined;
      }
    }

    initUspSwiper();
    window.addEventListener("resize", initUspSwiper);
  })();

  var LoadMore = (function () {
    var $loadmore = $("#loadmore");

    if ($("body").hasClass("child-theme")) {
      return;
    }

    if (!$loadmore.length) {
      return;
    }

    var $loadmore_text = $loadmore.text();

    $loadmore.click(function () {
      var $this = $(this);
      var $postlist = $this.siblings(".blog-posts");
      var query = WP.query;
      var page = WP.current_page;
      var max = WP.max_page;

      var data = {
        action: "load_more_posts",
        query: query,
        page: page,
      };

      $.ajax({
        url: ajaxURL,
        type: "post",
        data: data,
        beforeSend: function () {
          $loadmore.attr("disabled", true).text("Loading Posts");
        },
        error: function (res) {
          res = JSON.parse(res);
          console.log(res);
        },
        success: function (posts) {
          if (posts) {
            page = WP.current_page++;
            $loadmore.attr("disabled", false).text($loadmore_text);
            $postlist.append(posts);
            LazyLoading.update();

            if (WP.current_page >= max) {
              $loadmore.remove();
            }
          } else {
            $loadmore.remove();
          }
        },
      });
    });
  })();

  AOS.init();
});
