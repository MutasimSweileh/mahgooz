/*=========================================================================================
    File Name: app-email.js
    Description: Email Page js
    ----------------------------------------------------------------------------------------
    Item Name: Vuexy  - Vuejs, HTML & Laravel Admin Dashboard Template
    Author: PIXINVENT
    Author URL: http://www.themeforest.net/user/pixinvent
==========================================================================================*/

'use strict';

$(function () {
  // Register Quill Fonts
  var Font = Quill.import('formats/font');
  Font.whitelist = ['sofia', 'slabo', 'roboto', 'inconsolata', 'ubuntu'];
  Quill.register(Font, true);

  var compose = $('.compose-email'),
    composeMailModal = $('#compose-mail'),
    menuToggle = $('.menu-toggle'),
    sidebarToggle = $('.sidebar-toggle'),
    sidebarLeft = $('.sidebar-left'),
    sidebarMenuList = $('.sidebar-menu-list'),
    emailAppList = $('.email-app-list'),
    emailUserListInput = $('.email-user-list .form-check'),
    emailScrollArea = $('.email-scroll-area'),
    listGroupMsg = $('.list-group-messages'),
    userActions = $('.user-action'),
    mailDelete = $('.mail-delete'),
    mailUnread = $('.mail-unread'),
    composeModal = $('.modal'),
    modalDialog = $('.modal-dialog'),
    editorEl = $('#message-editor .editor'),
    overlay = $('.body-content-overlay'),
    composeMaximize = $('.compose-maximize'),
    isRtl = $('html').attr('data-textdirection') === 'rtl';

  var assetPath = '../../../app-assets/';

  if ($('body').attr('data-framework') === 'laravel') {
    assetPath = $('body').attr('data-asset-path');
  }



  // if it is not touch device
  if (!$.app.menu.is_touch_device()) {
    // Email left Sidebar
    if ($(sidebarMenuList).length > 0) {
      var sidebar_menu_list = new PerfectScrollbar(sidebarMenuList[0]);
    }

    // User list scroll
    if ($($('.email-user-list')).length > 0) {
      var users_list = new PerfectScrollbar($('.email-user-list')[0]);
    }

    // Email detail section
    if ($(emailScrollArea).length > 0) {
      // var users_list = new PerfectScrollbar(emailScrollArea[0]);
    }
  }
  // if it is a touch device
  else {
    $(sidebarMenuList).css('overflow', 'scroll');
    $($('.email-user-list')).css('overflow', 'scroll');
    $(emailScrollArea).css('overflow', 'scroll');
  }

  $(document).keyup(function (e) {
    if (e.key === 'Escape') {
      if (composeMailModal.find('.modal-dialog').hasClass('modal-fullscreen')) {
        composeMaximize.click();
      }
    }
  });




  // compose email
  if (compose.length) {
    compose.on('click', function () {
      // showing rightSideBar
      overlay.removeClass('show');
      // hiding left sidebar
      sidebarLeft.removeClass('show');
    });
  }

  // Main menu toggle should hide app menu
  if (menuToggle.length) {
    menuToggle.on('click', function (e) {
      sidebarLeft.removeClass('show');
      overlay.removeClass('show');
    });
  }

  // Email sidebar toggle
  if (sidebarToggle.length) {
    sidebarToggle.on('click', function (e) {
      e.stopPropagation();
      sidebarLeft.toggleClass('show');
      overlay.addClass('show');
    });
  }

  if (composeMaximize)
    composeMaximize.on('click', function () {
      composeModal.toggleClass('modal-sticky');
      modalDialog.toggleClass('modal-fullscreen');
      if (modalDialog.hasClass('modal-fullscreen')) {
        $(this).html(feather.icons['minimize-2'].toSvg());
      } else {
        $(this).html(feather.icons['maximize-2'].toSvg());
      }
    });

  // Overlay Click
  if (overlay.length) {
    overlay.on('click', function (e) {
      sidebarLeft.removeClass('show');
      overlay.removeClass('show');
    });
  }

  // Email Right sidebar toggle

  $(document).on('click', ".email-user-list li", function (e) {

    newFunction($(this).data("id"), $(this).data("admin"));

  });
  // Add class active on click of sidebar list

  $(".sidebar-menu-list").find('a').on('click', function () {
    $(".email-app-details").removeClass('show');
    if ($(".sidebar-menu-list").find('a').hasClass('active')) {
      $(".sidebar-menu-list").find('a').removeClass('active');
    }
    var el = this;
    newFunction2($(el).data("where"), $(el).data("admin"), el);


  });


  // Email detail view back button click
  $(document).on('click', ".go-back", function () {
    $(".sidebar-menu-list").find('a').eq(0).click();
    $(".email-app-details").removeClass('show');
  });



  // For app sidebar on small screen
  if ($(window).width() > 768) {
    if (overlay.hasClass('show')) {
      overlay.removeClass('show');
    }
  }

  // single checkbox select
  if (emailUserListInput.length) {
    emailUserListInput.on('click', function (e) {
      e.stopPropagation();
    });
    emailUserListInput.find('input').on('change', function (e) {
      e.stopPropagation();
      var $this = $(this);
      if ($this.is(':checked')) {
        $this.closest('.user-mail').addClass('selected-row-bg');
      } else {
        $this.closest('.user-mail').removeClass('selected-row-bg');
      }
    });
  }

  // select all
  $(document).on('click', '.email-app-list .selectAll input', function () {
    if ($(this).is(':checked')) {
      $('.user-action')
        .find('.form-check .form-check-input')
        .prop('checked', this.checked)
        .closest('.user-mail')
        .addClass('selected-row-bg');
    } else {
      $('.user-action')
        .find('.form-check .form-check-input')
        .prop('checked', '')
        .closest('.user-mail')
        .removeClass('selected-row-bg');
    }
  });

  // Delete selected Mail from list
  if (mailDelete.length) {
    mailDelete.on('click', function () {
      if ($('.user-action').find('.form-check .form-check-input:checked').length) {
        var ids = [];
        $('.user-action').find('.form-check .form-check-input:checked').each(function () {
          ids.push($(this).closest('.user-mail').data("id"));
          $(this).closest('.user-mail').remove();
        });
        $.post(HOST_URL + "/ajax.php", {
          id: ids.join(","),
          "table": "support",
          "action": "remove"
        }, function (data) {
          makeToast(data);
        }, "json");
        emailAppList.find('.selectAll input').prop('checked', false);
        $('.user-action').find('.form-check .form-check-input').prop('checked', '');
      }
    });
  }

  // Mark mail unread
  if (mailUnread.length) {
    mailUnread.on('click', function () {
      $('.user-action').find('.form-check .form-check-input:checked').closest('.user-mail').removeClass('mail-read');
    });
  }

  // Filter

  $(document).on('keyup', "#email-search", function () {
    var value = $(this).val().toLowerCase();
    console.log(value);
    if (value !== '') {
      $('.email-user-list').find('.email-media-list li').filter(function () {
        if ($(this).text().toLowerCase().indexOf(value) == -1) {
          $(this).addClass("d-none");
        }
        //return $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1);
      });
      var tbl_row = $('.email-user-list').find('.email-media-list li:visible').length;

      //Check if table has row or not
      if (tbl_row == 0) {
        $('.email-user-list').find('.no-results').addClass('show');
        $(".email-user-list").addClass("d-flex");
        $('.email-user-list').animate({ scrollTop: '0' }, 500);
      } else {
        $(".email-user-list").removeClass("d-flex");
        if ($('.email-user-list').find('.no-results').hasClass('show')) {
          $('.email-user-list').find('.no-results').removeClass('show');
        }
      }
    } else {
      // If filter box is empty
      $(".email-user-list").removeClass("d-flex");
      $('.email-user-list').find('.email-media-list li').removeClass("d-none");
      if ($('.email-user-list').find('.no-results').hasClass('show')) {
        $('.email-user-list').find('.no-results').removeClass('show');
      }
    }
  });




  // On navbar search and bookmark Icon click, hide compose mail
  $('.nav-link-search, .bookmark-star').on('click', function () {
    composeModal.modal('hide');
  });
});

$(window).on('resize', function () {
  var sidebarLeft = $('.sidebar-left');
  // remove show classes from sidebar and overlay if size is > 992
  if ($(window).width() > 768) {
    if ($('.app-content .body-content-overlay').hasClass('show')) {
      sidebarLeft.removeClass('show');
      $('.app-content .body-content-overlay').removeClass('show');
    }
  }
});
function newFunction2(where, admin, el) {
  $.post(HOST_URL + "/ajax.php", {
    where: where,
    admin: admin,
    "action": "messages_list"
  }, function (data) {
    $("#emailList").html(data.html);
    if (el)
      $(el).addClass('active');
    if (data.count == 0) {
      $('.email-user-list').find('.no-results').addClass('show');
      $(".email-user-list").addClass("d-flex");
      $('.email-user-list').animate({ scrollTop: '0' }, 500);
    } else {
      $(".email-user-list").removeClass("d-flex");
      if ($('.email-user-list').find('.no-results').hasClass('show')) {
        $('.email-user-list').find('.no-results').removeClass('show');
      }
    }
    new PerfectScrollbar($('.email-user-list').get(0));
  }, "json");
}

function newFunction(id, admin) {
  var html = $("#email-app-details");
  if (html.length < 1) {
    html = $(".email-app-details").html();
    $("body").append($('<div id="email-app-details" class="d-none"></div>').html(html));
  }
  else
    html = html.html();
  $.post(HOST_URL + "/ajax.php", {
    id: id,
    admin: (admin ? 1 : 0),
    "action": "messages"
  }, function (data) {

    Object.keys(data).map((k) => {
      html = html.replaceAll("{" + k + "}", data[k]);

    });
    $("#unread").text(data.unread);
    $(".email-app-details").html(html).doEditor();
    $(".email-app-details").find("form").formSubmit();
    if (!$.app.menu.is_touch_device()) {
      new PerfectScrollbar($('.email-scroll-area').get(0));
      if ($('.email-app-details').hasClass("show")) {
        $($('.email-scroll-area').get(0)).scrollTop($($('.email-scroll-area').get(0)).prop("scrollHeight"));
        $($('.email-scroll-area').get(0)).perfectScrollbar('update');
      }
    }
    $(".email-app-details").addClass('show');

  }, "json");
}

