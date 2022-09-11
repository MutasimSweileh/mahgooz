<!DOCTYPE html>
<html class="loading <?= $interface ?>-layout" lang="en" data-textdirection="<?= ($lang == "english" ? "ltr" : "rtl") ?>">
<!-- BEGIN: Head-->

<head>
    <? $pageTitle = ($lang != "english" ? $_Atitle : $_title) . " | " . $_pageAr["title" . $clang]; ?>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1.0,user-scalable=0,minimal-ui">
    <meta name="description" content="<?= $_pageAr["subtitle" . $clang] ? $_pageAr["subtitle" . $clang] : $St->description ?>">
    <meta name="keywords" content="<?= $St->keywords ?>">
    <meta name="author" content="<?= $St->title ?>">
    <meta property="og:type" content="website" />
    <meta property="og:title" content="<?= $pageTitle ?>" />
    <meta property="og:description" content="<?= $St->description ?>" />
    <meta property="og:url" content="https://puppysimply.com/" />
    <meta property="og:site_name" content="<?= $St->title ?>" />
    <meta property="og:image" content="<?= getUpUrl($St->logo) ?>" />
    <meta property="og:image:secure_url" content="<?= getUpUrl($St->logo) ?>" />
    <meta name="twitter:card" content="summary_large_image" />
    <meta name="twitter:title" content="<?= $pageTitle ?>" />
    <meta name="twitter:description" content="<?= $St->description ?>" />
    <meta name="twitter:site" content="@<?= explode("/", rtrim($St->twitter, "/"))[count(explode("/", rtrim($St->twitter, "/"))) - 1] ?>" />
    <meta name="twitter:image" content="<?= getUpUrl($St->logo) ?>" />

    <title><?= $pageTitle ?></title>
    <link rel="apple-touch-icon" href="<?= getUpUrl($St->icon) ?>">
    <link rel="shortcut icon" type="image/x-icon" href="<?= $_site ?>/app-assets/images/ico/favicon.ico">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,300;0,400;0,500;0,600;1,400;1,500;1,600" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Tajawal&display=swap" rel="stylesheet">
    <!-- BEGIN: Vendor CSS-->
    <link rel="stylesheet" type="text/css" href="<?= $_site ?>/app-assets/vendors/css/vendors<?= ($lang == "english" ? "" : "-rtl") ?>.min.css">
    <link rel="stylesheet" type="text/css" href="<?= $_site ?>/app-assets/vendors/css/charts/apexcharts.css">
    <link rel="stylesheet" type="text/css" href="<?= $_site ?>/app-assets/vendors/css/extensions/nouislider.min.css">
    <link rel="stylesheet" type="text/css" href="<?= $_site ?>/app-assets/vendors/css/editors/quill/katex.min.css">
    <link rel="stylesheet" type="text/css" href="<?= $_site ?>/app-assets/vendors/css/editors/quill/monokai-sublime.min.css">
    <link rel="stylesheet" type="text/css" href="<?= $_site ?>/app-assets/vendors/css/editors/quill/quill.snow.css">
    <link rel="stylesheet" type="text/css" href="<?= $_site ?>/app-assets/vendors/css/extensions/toastr.min.css">
    <link rel="stylesheet" type="text/css" href="<?= $_site ?>/app-assets/vendors/css/forms/spinner/jquery.bootstrap-touchspin.css">
    <link rel="stylesheet" type="text/css" href="<?= $_site ?>/app-assets/vendors/css/extensions/swiper.min.css">
    <link rel="stylesheet" type="text/css" href="<?= $_site ?>/app-assets/vendors/css/forms/wizard/bs-stepper.min.css">
    <link rel="stylesheet" type="text/css" href="<?= $_site ?>/app-assets/vendors/css/tables/datatable/dataTables.bootstrap5.min.css">
    <link rel="stylesheet" type="text/css" href="<?= $_site ?>/app-assets/vendors/css/tables/datatable/extensions/dataTables.checkboxes.css">
    <link rel="stylesheet" type="text/css" href="<?= $_site ?>/app-assets/vendors/css/tables/datatable/responsive.bootstrap5.min.css">
    <link rel="stylesheet" type="text/css" href="<?= $_site ?>/app-assets/vendors/css/tables/datatable/buttons.bootstrap5.min.css">
    <link rel="stylesheet" type="text/css" href="<?= $_site ?>/app-assets/vendors/css/tables/datatable/rowGroup.bootstrap5.min.css">
    <link rel="stylesheet" type="text/css" href="<?= $_site ?>/app-assets/vendors/css/pickers/flatpickr/flatpickr.min.css">
    <!-- END: Vendor CSS-->

    <!-- BEGIN: Theme CSS-->
    <link rel="stylesheet" type="text/css" href="<?= $_site ?>/app-assets/css<?= ($lang == "english" ? "" : "-rtl") ?>/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="<?= $_site ?>/app-assets/css<?= ($lang == "english" ? "" : "-rtl") ?>/bootstrap-extended.css">
    <link rel="stylesheet" type="text/css" href="<?= $_site ?>/app-assets/vendors/css/forms/select/select2.min.css">
    <link rel="stylesheet" type="text/css" href="<?= $_site ?>/app-assets/css<?= ($lang == "english" ? "" : "-rtl") ?>/components.min.css">
    <link rel="stylesheet" type="text/css" href="<?= $_site ?>/app-assets/css<?= ($lang == "english" ? "" : "-rtl") ?>/themes/dark-layout.min.css">
    <link rel="stylesheet" type="text/css" href="<?= $_site ?>/app-assets/css<?= ($lang == "english" ? "" : "-rtl") ?>/themes/bordered-layout.css">
    <link rel="stylesheet" type="text/css" href="<?= $_site ?>/app-assets/css<?= ($lang == "english" ? "" : "-rtl") ?>/themes/semi-dark-layout.css">
    <link rel="stylesheet" type="text/css" href="<?= $_site ?>/app-assets/css/plugins/forms/form-validation.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="<?= $_site ?>/app-assets/vendors/css/extensions/sweetalert2.min.css">
    <!-- BEGIN: Page CSS-->
    <link rel="stylesheet" type="text/css" href="<?= $_site ?>/app-assets/css<?= ($lang == "english" ? "" : "-rtl") ?>/pages/app-ecommerce-details.min.css">
    <link rel="stylesheet" type="text/css" href="<?= $_site ?>/app-assets/css<?= ($lang == "english" ? "" : "-rtl") ?>/plugins/forms/form-number-input.min.css">
    <link rel="stylesheet" type="text/css" href="<?= $_site ?>/app-assets/css<?= ($lang == "english" ? "" : "-rtl") ?>/core/menu/menu-types/vertical-menu.min.css">
    <link rel="stylesheet" type="text/css" href="<?= $_site ?>/app-assets/css<?= ($lang == "english" ? "" : "-rtl") ?>/pages/dashboard-ecommerce.css">
    <link rel="stylesheet" type="text/css" href="<?= $_site ?>/app-assets/css<?= ($lang == "english" ? "" : "-rtl") ?>/plugins/extensions/ext-component-sliders.min.css">
    <link rel="stylesheet" type="text/css" href="<?= $_site ?>/app-assets/css<?= ($lang == "english" ? "" : "-rtl") ?>/pages/app-ecommerce.min.css">
    <link rel="stylesheet" type="text/css" href="<?= $_site ?>/app-assets/css<?= ($lang == "english" ? "" : "-rtl") ?>/plugins/charts/chart-apex.css">
    <link rel="stylesheet" type="text/css" href="<?= $_site ?>/app-assets/css<?= ($lang == "english" ? "" : "-rtl") ?>/plugins/extensions/ext-component-toastr.css">
    <link rel="stylesheet" type="text/css" href="<?= $_site ?>/app-assets/css<?= ($lang == "english" ? "" : "-rtl") ?>/plugins/extensions/ext-component-sweet-alerts.min.css">
    <link rel="stylesheet" type="text/css" href="<?= $_site ?>/app-assets/css/plugins/forms/pickers/form-pickadate.min.css">
    <link rel="stylesheet" type="text/css" href="<?= $_site ?>/app-assets/css<?= ($lang == "english" ? "" : "-rtl") ?>/plugins/forms/pickers/form-flat-pickr.min.css">
    <link rel="stylesheet" type="text/css" href="<?= $_site ?>/app-assets/css<?= ($lang == "english" ? "" : "-rtl") ?>/plugins/forms/form-wizard.min.css">
    <!--   <link rel="stylesheet" type="text/css" href="<?= $_site ?>/app-assets/css<?= ($lang == "english" ? "" : "-rtl") ?>/pages/app-invoice-list.min.css">
 -->
    <link rel="stylesheet" type="text/css" href="<?= $_site ?>/app-assets/css<?= ($lang == "english" ? "" : "-rtl") ?>/pages/app-invoice.min.css">
    <? if (strpos($_page->slug, "print") !== false) { ?>
        <link rel="stylesheet" type="text/css" href="<?= $_site ?>/app-assets/css<?= ($lang == "english" ? "" : "-rtl") ?>/pages/app-invoice-print.min.css">

    <? } ?>
    <link rel="stylesheet" type="text/css" href="<?= $_site ?>/app-assets/css<?= ($lang == "english" ? "" : "-rtl") ?>/plugins/forms/form-quill-editor.min.css">
    <link rel="stylesheet" type="text/css" href="<?= $_site ?>/app-assets/css<?= ($lang == "english" ? "" : "-rtl") ?>/pages/app-email.min.css">
    <link rel="stylesheet" type="text/css" href="<?= $_site ?>/app-assets/css<?= ($lang == "english" ? "" : "-rtl") ?>/pages/page-faq.min.css">

    <!-- END: Page CSS-->
    <script src="https://cdn.onesignal.com/sdks/OneSignalSDK.js" async=""></script>

    <!-- BEGIN: Custom CSS-->
    <?php if ($lang != "english") { ?>
        <link rel="stylesheet" type="text/css" href="<?= $_site ?>/app-assets/css-rtl/custom-rtl.min.css">
    <?php } ?>
    <link rel="stylesheet" type="text/css" href="<?= $_site ?>/assets/css/style<?= ($lang == "english" ? "" : "-rtl") ?>.css">
    <link rel="stylesheet" type="text/css" href="<?= $_site ?>/app-assets/css/colors.min.css">
    <!-- END: Custom CSS-->
    <style>
        @keyframes cart {
            0% {
                transform: scale(1);
            }

            50% {
                transform: scale(3);
            }

            100% {
                transform: scale(1);
            }
        }

        .cart_animation {
            animation-name: cart;
            animation-duration: 500ms;
        }

        .header-navbar .navbar-container ul.navbar-nav li.dropdown-cart .cart-item-remove {
            font-size: 13px;
        }

        .ecommerce-application .sidebar-shop .range-slider.noUi-horizontal .noUi-handle .noUi-tooltip:before {
            content: '';
        }

        div.dataTables_wrapper div.dataTables_filter label,
        div.dataTables_wrapper div.dataTables_length label {
            margin-top: 0;
            margin-bottom: 0;
        }

        .invoice-add .invoice-total-wrapper,
        .invoice-edit .invoice-total-wrapper,
        .invoice-preview .invoice-total-wrapper,
        .invoice-print .invoice-total-wrapper {
            width: 100%;
            max-width: unset;
        }

        .avatar-content.avatar-sm {
            width: 25px;
            height: 25px;
        }

        input[name*=size] {
            text-align: center;
        }

        .list-item.active {
            background: #f8f8f8;
        }

        .swal2-icon-content svg {
            width: 30px;
            height: 30px;
        }

        .dark-layout .list-item.active {
            background: #3B4253;
        }

        .product-details-border {
            border: 1px solid #EBE9F1;
            border-radius: .357rem;
        }

        .dark-layout .product-details-border {
            border-color: #404656;
        }

        span#select2-basicSelect2-container .emp_post {
            display: none;
        }

        [data-editorel*="arabic"] .ql-editor,
        [data-editorel*="arabic"] .ql-container {
            direction: rtl;
            text-align: right;
            font-family: 'Tajawal';
        }

        ::-webkit-scrollbar {
            width: 15px;
        }

        ::-webkit-scrollbar-thumb {
            height: 6px;
            border: 4px solid rgba(0, 0, 0, 0);
            background-clip: padding-box;
            -webkit-border-radius: 7px;
            background-color: #e3e3e3;
        }

        body {
            position: fixed;
            top: 0;
            left: 0;
            bottom: 0;
            right: 0;
        }

        [name*="arabic"],
        .arabic,
        body {
            font-family: 'Tajawal';
        }

        [dir="rtl"] {
            text-align: right;
            font-family: 'Tajawal';
        }

        #select2-basicSelect-container .emp_post {
            display: none;
        }

        /*  [data-editorel*="arabic"] .ql-editor,
    [data-editorel*="arabic"] .ql-container,
    [name*="arabic"],
    .arabic {
      direction: rtl;
      text-align: right;
      font-family: 'Tajawal';
    }
    .english-center {
      direction: ltr;
      text-align: center;
    } */
        #statistics-card {
            text-transform: capitalize;
        }

        footer.footer.footer-static.footer-light {
            clear: both;
        }

        <? if (!$_login) { ?>.auth-wrapper .brand-logo {
            display: block !important;
            text-align: center;
        }

        .brand-logo svg {
            display: block;
            margin: 10px auto;
        }

        .brand-logo img {
            width: 210px;
        }

        <? } ?>.logo-wrapper img {
            height: 50px;
        }

        .main-menu .navbar-header .navbar-brand .brand-text {
            padding: 0;
            width: 160px;
        }

        .brand-logo {
            display: none;
        }

        .vertical-layout.vertical-menu-modern.menu-collapsed .main-menu .navbar-header:not(.expanded) .brand-logo {
            display: inline;
        }

        .swal2-container .swal2-toast {

            padding: 5px !important;
        }

        .swal2-container .swal2-toast #swal2-title {
            font-size: 15px !important;
        }

        .colored-toast.swal2-icon-success {
            background-color: #a5dc86 !important;
        }

        .colored-toast.swal2-icon-error {
            background-color: #f27474 !important;
        }

        .colored-toast.swal2-icon-warning {
            background-color: #f8bb86 !important;
        }

        .colored-toast.swal2-icon-info {
            background-color: #3fc3ee !important;
        }

        .colored-toast.swal2-icon-question {
            background-color: #87adbd !important;
        }

        .colored-toast .swal2-title {
            color: white;
        }

        .colored-toast .swal2-close {
            color: white;
        }

        .colored-toast .swal2-html-container {
            color: white;
        }
    </style>
    <?php if ($lang != "english") { ?>
        <style>
            .popover,
            .tooltip,
            body,
            .navigation,
            .header-navbar,
            .navigation .navigation-header,
            .ql-container {
                font-family: 'Tajawal';
                letter-spacing: normal;
                word-wrap: normal;
            }

            * {
                word-wrap: normal !important;
                letter-spacing: normal !important;
            }

            .toast .toast-title {
                direction: rtl;
                text-align: right;
            }

            html body {
                margin: 0;
                padding: 0;
                overflow-x: hidden;
            }

            .apexcharts-tooltip-marker {
                margin-right: 0;
                margin-left: 10px;
            }

            .apexcharts-yaxis {
                direction: ltr;
            }

            .apexcharts-tooltip-series-group {
                text-align: right !important;
                justify-content: right !important;
            }

            .apexcharts-tooltip *,
            .apexcharts-canvas .apexcharts-text,
            .apexcharts-canvas .apexcharts-tooltip-text,
            .apexcharts-canvas .apexcharts-datalabel-label,
            .apexcharts-canvas .apexcharts-datalabel {
                letter-spacing: normal;
                font-size: 15px;
                font-family: 'Tajawal' !important;
            }

            .ql-editor {
                direction: rtl;
                text-align: right;
            }

            .english .ql-editor

            /*,
       .english  */
                {
                direction: ltr;
                text-align: left;
            }

            .invoice-preview-card {
                direction: rtl;
                text-align: justify;
                letter-spacing: normal;
            }
        </style>
    <?php } ?>

</head>
<!-- END: Head-->

<!-- BEGIN: Body-->

<body class="vertical-layout vertical-menu-modern <?= !$_page->head ? "blank-page" : "" ?> navbar-floating footer-static  " data-open="click" data-menu="vertical-menu-modern" data-col="">
    <?php if ($_page->head) { ?>
        <!-- BEGIN: Header-->
        <nav class="header-navbar navbar navbar-expand-lg align-items-center floating-nav navbar-light navbar-shadow container-xxl">
            <div class="navbar-container d-flex content">
                <div class="bookmark-wrapper d-flex align-items-center">
                    <ul class="nav navbar-nav d-xl-none">
                        <li class="nav-item"><a class="nav-link menu-toggle" href="#"><i class="ficon" data-feather="menu"></i></a></li>
                    </ul>
                    <ul class="nav navbar-nav">
                        <? if ($_login->role) { ?>
                            <li class="nav-item"><a class="nav-link nav-link-interface">
                                    <i class="ficon" data-feather="<?= $interface == "dark" ? "sun" : "moon" ?>"></i>
                                </a></li>
                        <? } ?>
                        <?
                        $w = "(user_id=" . $_login->id . " || user_id=0) and admin=0";
                        if ($_login->role == 1)
                            $w = "admin=1";
                        $variable = getUser('notifications', 'where active=1 and ' . $w . ' and date <= ' . time() . ' order by `id` desc');
                        $noneSys = array_filter($variable, function ($v) {
                            return !$v["system"];
                        });
                        $reads = array_filter($variable, function ($v) use ($_login) {
                            $done = explode(",", $v["done"]);
                            return !$v["read"] && !in_array($_login->id, $done);
                        }); ?>
                        <li class="nav-item dropdown dropdown-notification me-25" data-action="up_notifications">
                            <a class="nav-link" href="#" data-bs-toggle="dropdown"><svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-bell ficon">
                                    <path d="M18 8A6 6 0 0 0 6 8c0 7-3 9-3 9h18s-3-2-3-9"></path>
                                    <path d="M13.73 21a2 2 0 0 1-3.46 0"></path>
                                </svg><span id="nof-read" class="badge rounded-pill bg-danger badge-up nof-read"><?= count($reads) ?></span></a>
                            <ul id="template_notifications" class="dropdown-menu dropdown-menu-media dropdown-menu-start <?= (!$variable ? "d-none" : "") ?> ">
                                <?php include "inc/template/notifications.php"  ?>
                            </ul>
                        </li>
                        <?
                        if (!$_login->role) { ?>
                            <li class="nav-item dropdown dropdown-cart me-25" id="template_cart">
                                <?php //include "inc/template/cart.php"  
                                ?>
                            </li>
                        <? } ?>

                    </ul>
                </div>
                <ul class="nav navbar-nav align-items-center ms-auto">
                    <li class="nav-item dropdown dropdown-language">
                        <a class="nav-link dropdown-toggle" id="dropdown-flag" href="#" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="flag-icon flag-icon-<?= ($lang == "english" ? "us" : "eg") ?>"></i><span class="selected-language"><?= $_lang[$lang] ?></span></a>
                        <div class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdown-flag">
                            <a class="dropdown-item" href="<?= getSiteUrl("index", "?lang=english&redirect=" . $_redirect) ?>"><i class="flag-icon flag-icon-us"></i> <?= $_lang["english"] ?></a>
                            <a class="dropdown-item" href="<?= getSiteUrl("index", "?lang=_arabic&redirect=" . $_redirect) ?>"><i class="flag-icon flag-icon-eg"></i> <?= $_lang["_arabic"] ?></a>
                        </div>
                    </li>
                    <li class="nav-item nav-search d-none"><a class="nav-link nav-link-search"><svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-search ficon">
                                <circle cx="11" cy="11" r="8"></circle>
                                <line x1="21" y1="21" x2="16.65" y2="16.65"></line>
                            </svg></a>
                        <div class="search-input">
                            <div class="search-input-icon"><svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-search">
                                    <circle cx="11" cy="11" r="8"></circle>
                                    <line x1="21" y1="21" x2="16.65" y2="16.65"></line>
                                </svg></div>
                            <input class="form-control input" type="text" name="search" placeholder="<?= $_lang["search"] ?>" tabindex="-1" data-search="search">
                            <div class="search-input-close"><svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x">
                                    <line x1="18" y1="6" x2="6" y2="18"></line>
                                    <line x1="6" y1="6" x2="18" y2="18"></line>
                                </svg></div>
                            <ul class="search-list search-list-main">
                            </ul>
                        </div>
                    </li>

                    <? if (!$_login->role) { ?>
                        <li class="nav-item"><a class="nav-link nav-link-interface">
                                <i class="ficon" data-feather="<?= $interface == "dark" ? "sun" : "moon" ?>"></i>
                            </a></li>
                    <? } ?>
                    <li class="nav-item dropdown dropdown-user"><a class="nav-link dropdown-toggle dropdown-user-link" id="dropdown-user" href="#" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <div class="user-nav d-sm-flex d-none"><span class="user-name fw-bolder"><?= $_login->fullname ?></span>
                                <span class="user-status" style="margin: 0 auto;">
                                    <?
                                    if ($_login->role == 1) {
                                        $roles = roles($_login->role);
                                    ?>
                                        <span class="text-truncate align-middle">
                                            <i class="font-medium-3 text-<?= $roles["color"] ?> me-50" data-feather='<?= $roles["icon"] ?>'></i><?= $roles["name"] ?></span>
                                    <? } else { ?>
                                        <span class="badge bg-success">
                                            <i class="fas fa-money-bill" style="margin-<?= ($clang ? "left" : "right") ?>: 10px"></i>
                                            <span><?= number_format($_login->money) ?> <?= $_lang["currency"] ?></span>
                                        </span> <? } ?>
                                </span>
                            </div><span class="avatar"><img class="round" src="<?= getUpUrl($_login->avatar, "blank-user.png") ?>" alt="avatar" height="40" width="40"><span class="avatar-status-online d-none"></span></span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdown-user">
                            <? if ($_login->role != 1) { ?>
                                <a class="dropdown-item" href="<?= getSiteUrl("page-faq") ?>"><i class="me-50" data-feather="help-circle"></i> <?= getPages("page-faq", false)["title" . $clang] ?></a>
                                <a class="dropdown-item" href="<?= getSiteUrl("support") ?>"><i class="me-50" data-feather="message-square"></i> <?= getPages("support", false)["title" . $clang] ?></a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="<?= getSiteUrl("payments") ?>"><i class="me-50" data-feather="credit-card"></i> <?= getPages("payments", false)["title" . $clang] ?></a>
                            <? } ?>
                            <a class="dropdown-item" href="<?= getSiteUrl("account-settings") ?>"><i class="me-50" data-feather="settings"></i> <?= explode(" ", getPages("account-settings", false)["title" . $clang])[1] ?></a>
                            <a class="dropdown-item" href="<?= getSiteUrl("sign-out") ?>"><i class="me-50" data-feather="power"></i> <?= getPages("sign-out", false)["title" . $clang] ?></a>
                        </div>
                    </li>
                </ul>
            </div>
        </nav>
        <!-- END: Header-->


        <!-- BEGIN: Main Menu-->
        <div class="main-menu menu-fixed menu-light menu-accordion menu-shadow" data-scroll-to-active="true">
            <div class="navbar-header">
                <ul class="nav navbar-nav flex-row">
                    <li class="nav-item me-auto"><a class="navbar-brand mt-0" href="<?= getSiteUrl("index") ?>">
                            <span class="brand-logo">
                                <img src="<?= getUpUrl($_St["icon"]) ?>" width="60" alt="<?= $St->title ?>">
                            </span>
                            <? $t = explode("-", $St->title); ?>
                            <!-- <h2 class="brand-text"><?= $lang == "english" ? explode("-", $St->title)[0] : explode("-", $St->title)[1] ?></h2> -->
                            <h2 class="brand-text">
                                <img src="<?= getUpUrl($_St["logo" . $clang]) ?>" class="img-fluid" alt="<?= $St->title ?>">
                            </h2>
                        </a></li>
                    <li class="nav-item nav-toggle"><a class="nav-link modern-nav-toggle pe-0" data-bs-toggle="collapse"><i class="d-block d-xl-none text-primary toggle-icon font-medium-4" data-feather="x"></i><i class="d-none d-xl-block collapse-toggle-icon font-medium-4  text-primary" data-feather="disc" data-ticon="disc"></i></a></li>
                </ul>
            </div>
            <div class="shadow-bottom"></div>
            <div class="main-menu-content">
                <ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation">
                    <li class="nav-item <?= menuActive("index") ?>"><a class="d-flex align-items-center" href="<?= getSiteUrl("index") ?>">
                            <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-home">
                                <path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path>
                                <polyline points="9 22 9 12 15 12 15 22"></polyline>
                            </svg>
                            <span class="menu-title text-truncate" data-i18n="Dashboards"><?= getPages("index", false)["title" . $clang] ?></span></a>

                    </li>
                    <?php
                    $data = getUser("pages", "where active=1 and section=1 order by `index`");
                    foreach ($data as $k => $v) {
                        if (trim($v["role"]) != "" && !in_array($_login->role, explode(",", $v["role"])))
                            continue;
                    ?>
                        <li class=" navigation-header"><span data-i18n="User Interface"><?= $v["title" . $clang] ?></span><svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-more-horizontal">
                                <circle cx="12" cy="12" r="1"></circle>
                                <circle cx="19" cy="12" r="1"></circle>
                                <circle cx="5" cy="12" r="1"></circle>
                            </svg>
                        </li>
                        <?php
                        $sdata = getUser("pages", "where menu=1 and active=1 and level=" . $v["id"] . " order by `index`");
                        foreach ($sdata as $v2) {
                            $s2data = getUser("pages", "where menu=1 and active=1 and level=" . $v2["id"] . " order by `index`");
                            if ($s2data) {
                                $s2data = array_map(function ($d) {
                                    unset($d["index"]);
                                    return $d;
                                }, $s2data);
                            }
                            $json_menu = json_encode($s2data);
                            if (trim($v2["role"]) != "" && !in_array($_login->role, explode(",", $v2["role"])))
                                continue;
                        ?>

                            <li class="nav-item <?= (strpos($json_menu, $Gapp) !== false ? "sidebar-group-active open" : "") ?> <?= menuActive($v2["slug"]) ?> <?= ($s2data ? "has-sub" : "") ?>">
                                <a class="d-flex align-items-center" href="<?= ($s2data ? "javascript:;" : getSiteUrl($v2["slug"])) ?>">
                                    <?= str_replace("me-50", "", $v2["icon"]) ?>


                                    <span class="menu-title text-truncate" data-i18n="Home"><?= $v2["title" . $clang] ?></span></a>
                                <?php if ($s2data) {

                                ?>
                                    <ul class="menu-content">
                                        <?php

                                        foreach ($s2data as $v3) {
                                            $link = getSiteUrl($v3["slug"]);
                                            if (strpos($v3["slug"], "#") !== false)
                                                $link = getSiteUrl($v2["slug"], $v3["slug"]);
                                            if (trim($v3["role"]) != "" && !in_array($_login->role, explode(",", $v3["role"])))
                                                continue;
                                        ?>
                                            <li class="<?= menuActive($v3["slug"]) ?>"><a class="d-flex align-items-center" href="<?= $link ?>">
                                                    <i data-feather="circle"></i><span class="menu-item text-truncate" data-i18n="Collapsed Menu"><?= $v3["title" . $clang] ?></span></a>
                                            </li>

                                        <?php } ?>
                                    </ul>
                                <?php } ?>
                            </li>
                    <?php }
                    } ?>

                </ul>
                <ul class="nav nav-pills navbar-right justify-content-around <?= ($_login->role != 1 ? "mt-3" : "mt-lg-2") ?> ">
                    <li class="nav-item"><a class="btn btn-icon btn-icon rounded-circle btn-outline-secondary" target="_blank" href="<?= $St->fb ?>" data-bs-toggle="tooltip" data-bs-placement="top" title="<?= $_lang["facebook"] ?>">
                            <i data-feather='facebook' class="font-medium-1"></i></a></li>
                    <li class="nav-item"><a class="btn btn-icon btn-icon rounded-circle btn-outline-secondary" target="_blank" href="<?= $St->twitter ?>" data-bs-toggle="tooltip" data-bs-placement="top" title="<?= $_lang["twitter"] ?>">
                            <i data-feather='twitter' class="font-medium-1"></i></a></li>
                    <li class="nav-item"><a class="btn btn-icon btn-icon rounded-circle btn-outline-secondary" target="_blank" href="<?= $St->instagram ?>" data-bs-toggle="tooltip" data-bs-placement="top" title="<?= $_lang["instagram"] ?>">
                            <i data-feather='instagram' class="font-medium-1"></i></a></li>
                    <li class="nav-item"><a class="btn btn-icon btn-icon rounded-circle btn-outline-secondary" target="_blank" href="https://api.whatsapp.com/send?phone=2<?= $St->whatsapp ?>" data-bs-toggle="tooltip" data-bs-placement="top" title="<?= $_lang["whatsapp"] ?>">
                            <i class="font-medium-1 fab fa-whatsapp"></i></a></li>
                </ul>
            </div>
        </div>
        <!-- END: Main Menu-->
    <?php  } ?>
    <!-- BEGIN: Content-->
    <div class="app-content  content ecommerce-application<?= (in_array($_page->slug, ["products", "checkout"]) ? "" : "payments") ?> <?= strpos($_page->slug, "support") === false ? "" : "email-application" ?>">
        <div class="content-overlay"></div>
        <div class="header-navbar-shadow"></div>
        <?php if ($_page->head) { ?>
            <div class="content-wrapper container-xxl p-0">
                <div class="content-header row">
                    <div class="content-header-left col-md-12 col-12 mb-2">
                        <?php if ($_page  && $_page->head && $_page->slug != "index") {
                        ?>
                            <div class="row breadcrumbs-top">
                                <div class="col-12">

                                    <h2 class="content-header-title float-start mb-0"><?= $_pageAr["title" . $clang] ?></h2>
                                    <div class="breadcrumb-wrapper">
                                        <ol class="breadcrumb">
                                            <li class="breadcrumb-item <? ($_page->slug == "index" ? "d-none" : "") ?>"><a href="<?= getSiteUrl("index") ?>"><?= getPages("index", false)["title" . $clang] ?></a>
                                            </li>
                                            <?php $u = getUser("pages", "where id=" . $_page->level);
                                            if ($u) foreach ($u as $v) {
                                            ?>
                                                <li class="breadcrumb-item"> <a href="<?= getSiteUrl($v["slug"]) ?>"><?= $v["title" . $clang] ?></a>
                                                </li> <?php } ?>
                                            <li class="breadcrumb-item active"><?= $_pageAr["title" . $clang] ?>
                                            </li>
                                        </ol>
                                    </div>


                                </div>
                            </div>
                        <?php  } ?>
                    </div>

                </div>
                <div class="content-body">
                <?php  } ?>