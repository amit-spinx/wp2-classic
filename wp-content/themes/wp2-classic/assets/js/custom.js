var $ = jQuery.noConflict();
$(document).on("ready", function () {
  /* AOS JS */
  AOS.init({
    duration: 500,
    once: true,
    animatedClassName: 'animated',
  });
  setTimeout(() => {
    AOS.refresh();
  }, 500);

  /*** Header fixed ***/
  headerStick();
  $(window).on("scroll", function () {
    headerStick();
  });
  headerResize();
  moveBackground();
  handleResponsiveMenu();

  /**Megamenu image swap script*****/
  var $swapWrap = $('#swap-image-wrap');
  if (!$swapWrap.length) return;
  var $swapImg = $swapWrap.find('img');
  $(document).on('mouseenter', '.mega-menu-link[swap-img]', function () {
    var img = $(this).attr('swap-img');
    if (img) {
      $swapImg.attr('src', img);
    }
  });

  setTimeout(() => {
    $('#mega-menu-main-menu > li.mega-menu-item-has-children, #mega-menu-main-menu > li.mega-menu-item.mega-menu-item-has-children').on('mouseenter', function () {
      $('body').addClass('mega-menu-open');
    })
      .on('mouseleave', function () {
        $('body').removeClass('mega-menu-open');
      });
  }, 500);

  $('a.search-icon').on('click', function() {
    $('.menu-wrapper').addClass('search-open');
    if ($(window).width() < 991.98) {
      $('.navbar-brand img').addClass('d-none');
    }
  });
  $('a.close-search').on('click', function() {
    $('.menu-wrapper').removeClass('search-open');
    $('.header-search input').val('');
    if ($(window).width() < 991.98) {
      $('.navbar-brand img').removeClass('d-none');
    }
  });
});

/** Menu script **/
function headerStick() {
  // var scrollPixel = $(window).scrollTop();
  // if (scrollPixel < 300) {
  //   $("header").removeClass("header-fix");
  // } else {
  //   $("header").addClass("header-fix");
  // }
  const header = document.querySelector("header");
  const toggleClass = "is-sticky";

  window.addEventListener("scroll", () => {
    const currentScroll = window.pageYOffset;
    if (currentScroll > 70) {
      header.classList.add(toggleClass);
    } else {
      header.classList.remove(toggleClass);
    }
  });
}
function headerResize() {
  var screenWidth = $(window).width();
  if (screenWidth < 991.98) {
    $(".navbar-toggler").off("click");
    $(".navbar-toggler").on("click", function () {
      $("header").toggleClass("menu-open");
    });

    $(".mega-indicator").on("click", function (e) {
      e.preventDefault();
      $(this).parents('.mega-menu-item').addClass('submenu-open');
    });

    $(".custom-back-link").on("click", function (e) {
      e.preventDefault();
      $(this).closest('.mega-menu-item').removeClass('submenu-open');
    });
    $('#mega-menu-main-menu > .mega-menu-item-has-children .mega-menu-link').each(function () {

      var $submenu = $(this).next('ul.mega-sub-menu');

      if ($submenu.length && !$submenu.find('> .custom-back-link').length) {
        $submenu.prepend(
          '<li class="custom-back-link"><a href="#">Back</a></li>'
        );
      }

    });


  }
}

var $searchIcon = $('a.search-icon');
var $originalParent = $searchIcon.parent();
var $originalNext = $searchIcon.next();

//$('ul#mega-menu-main-menu li.btn-css').before('<li class="mega-menu-item search-icon"><a href="javacript:;"></a></li>');
function handleResponsiveMenu() {
  if ($(window).width() > 991) {
    if (!$searchIcon.parent().hasClass('mega-menu-item')) {
      $searchIcon
        .wrap('<li class="mega-menu-item search-li"></li>')
        .parent()
        .insertBefore('li.btn-css');
    }
  } else {
    if ($searchIcon.parent().hasClass('mega-menu-item')) {
      var $liWrapper = $searchIcon.parent();
      // Move back to original position
      if ($originalNext.length) {
        $searchIcon.insertBefore($originalNext);
      } else {
        $originalParent.append($searchIcon);
      }
      // Remove wrapper
      $liWrapper.remove();
    }
  }
}

$(window).on("load resize", function () {
  headerResize();
  handleResponsiveMenu();
});

document.querySelectorAll('.accordion-button').forEach(button => {
  button.addEventListener('touchstart', function () {
    this.click();
  });
});

/**404 page image move script****/
var lFollowX = 0,
  lFollowY = 0,
  x = 0,
  y = 0,
  friction = 1 / 30;

function moveBackground() {
  x += (lFollowX - x) * friction;
  y += (lFollowY - y) * friction;

  translate = "translate(" + x + "px, " + y + "px) scale(1.1)";

  $(".notfound").css({
    "-webit-transform": translate,
    "-moz-transform": translate,
    transform: translate
  });

  window.requestAnimationFrame(moveBackground);
}

$(window).on("mousemove click", function (e) {
  var lMouseX = Math.max(
    -100,
    Math.min(100, $(window).width() / 2 - e.clientX)
  );
  var lMouseY = Math.max(
    -100,
    Math.min(100, $(window).height() / 2 - e.clientY)
  );
  lFollowX = (20 * lMouseX) / 100; // 100 : 12 = lMouxeX : lFollow
  lFollowY = (10 * lMouseY) / 100;
});


if ($('body').hasClass('single-products')) {

    $('#mega-menu-item-25').addClass('mega-current-menu-item mega-current_page_item');

}
if ($('body').hasClass('single-post')) {

    $('#mega-menu-item-21').addClass('mega-current-menu-item mega-current_page_item');

}
if ($('body').hasClass('single-capabilities')) {

    $('#mega-menu-item-24').addClass('mega-current-menu-item mega-current_page_item');

}
function setNavBlurWidth() {
  setTimeout(function () {
    var width = $('.offcanvas').outerWidth();
    $('.nav-blur').css('width', width + 'px');
  }, 1000);
}

// Run on page load
setNavBlurWidth();

// Run on window resize
$(window).on('resize', function () {
  setNavBlurWidth();
});