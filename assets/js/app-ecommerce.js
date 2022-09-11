/*=========================================================================================
    File Name: app-ecommerce.js
    Description: Ecommerce pages js
    ----------------------------------------------------------------------------------------
    Item Name: Vuexy  - Vuejs, HTML & Laravel Admin Dashboard Template
    Author: PIXINVENT
    Author URL: http://www.themeforest.net/user/pixinvent
==========================================================================================*/

'use strict';

$(function () {
  // RTL Support
  var direction = 'ltr',
    isRTL = false;
  if ($('html').data('textdirection') == 'rtl') {
    direction = 'rtl';
  }

  if (direction === 'rtl') {
    isRTL = true;
  }
  var sidebarShop = $('.sidebar-shop'),
    btnCart = $('.btn-cart'),
    overlay = $('.body-content-overlay'),
    sidebarToggler = $('.shop-sidebar-toggler'),
    gridViewBtn = $('.grid-view-btn'),
    listViewBtn = $('.list-view-btn'),
    priceSlider = document.getElementById('price-slider'),
    ecommerceProducts = $('#ecommerce-products'),
    sortingDropdown = $('.dropdown-sort .dropdown-item'),
    sortingText = $('.dropdown-toggle .active-sorting'),
    wishlist = $('.btn-wishlist'),
    checkout = 'app-ecommerce-checkout.html';
    var productsSwiper = $('.swiper-responsive-breakpoints'),
    productOption = $('.product-color-options li');
  if ($('body').attr('data-framework') === 'laravel') {
    var url = $('body').attr('data-asset-path');
    checkout = url + 'app/ecommerce/checkout';
  }

  // On sorting dropdown change
  if (sortingDropdown.length) {
    sortingDropdown.on('click', function () {
      var $this = $(this);
      var selectedLang = $this.text();
      sortingText.text(selectedLang);
    });
  }

  // Show sidebar
  if (sidebarToggler.length) {
    sidebarToggler.on('click', function () {
      sidebarShop.toggleClass('show');
      overlay.toggleClass('show');
      $('body').addClass('modal-open');
    });
  }

  // Overlay Click
  if (overlay.length) {
    overlay.on('click', function (e) {
      sidebarShop.removeClass('show');
      overlay.removeClass('show');
      $('body').removeClass('modal-open');
    });
  }

  // Init Price slider
  if (typeof priceSlider !== undefined && priceSlider !== null && 1 == 2) {
    noUiSlider.create(priceSlider, {
      start: [1500, 3500],
      direction: direction,
      connect: true,
      tooltips: [true, true],
      format: wNumb({
        decimals: 0,
        prefix: '€'
      }),
      range: {
        min: 51,
        max: 5000
      }
    });
  }

  // Grid View
  if (gridViewBtn.length) {
    gridViewBtn.on('click', function () {
      $('#ecommerce-products').removeClass('list-view').addClass('grid-view');
      listViewBtn.removeClass('active');
      gridViewBtn.addClass('active');
    });
  }

  // List View
  if (listViewBtn.length) {
    listViewBtn.on('click', function () {
      $('#ecommerce-products').removeClass('grid-view').addClass('list-view');
      gridViewBtn.removeClass('active');
      listViewBtn.addClass('active');
    });
  }
  if ($(".mySwiper").length)
    new Swiper(".mySwiper", {
      spaceBetween: 30,
      navigation: {
      nextEl: ".swiper-button-next",
      prevEl: ".swiper-button-prev",
      },
      pagination: {
      el: ".swiper-pagination",
      clickable: true,
      }
  });
  if (productsSwiper.length) {
    new Swiper('.swiper-responsive-breakpoints', {
        slidesPerView: 5,
        spaceBetween: 55,
        // init: false,
        navigation: {
            nextEl: '.swiper-button-next',
            prevEl: '.swiper-button-prev'
        },
        breakpoints: {
            1600: {
                slidesPerView: 4,
                spaceBetween: 55
            },
            1300: {
                slidesPerView: 3,
                spaceBetween: 55
            },
            768: {
                slidesPerView: 2,
                spaceBetween: 55
            },
            320: {
                slidesPerView: 1,
                spaceBetween: 55
            }
        }
    });
  }
  // On cart & view cart btn click to cart
  if (btnCart.length && 1 == 2) {
    btnCart.on('click', function (e) {
      var $this = $(this),
        addToCart = $this.find('.add-to-cart');
      if (addToCart.length > 0) {
        e.preventDefault();
      }
      addToCart.text('View In Cart').removeClass('add-to-cart').addClass('view-in-cart');
      $this.attr('href', checkout);
      toastr['success']('', $this.data("msg"), {
        closeButton: true,
        tapToDismiss: false,
        rtl: isRTL
      });
    });
  }

  // For Wishlist Icon

});

// on window resize hide sidebar
$(window).on('resize', function () {
  if ($(window).outerWidth() >= 991) {
    $('.sidebar-shop').removeClass('show');
    $('.body-content-overlay').removeClass('show');
  }
});
