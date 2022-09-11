<!-- Right Sidebar starts -->
<div class="modal modal-slide-in sidebar-todo-modal fade" id="slideModal" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog sidebar-lg">
        <div class="modal-content p-0">
            <div class="modal-header align-items-center mb-1">
                <h5 class="modal-title">Add Task</h5>
                <div class="todo-item-action d-flex align-items-center justify-content-between ms-auto">
                    <i data-feather="x" class="cursor-pointer" data-bs-dismiss="modal" stroke-width="3"></i>
                </div>
            </div>
            <div class="modal-body flex-grow-1 pb-sm-0 pb-3">
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="centerModal" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-transparent">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="text-center">
                <h1 class=" modal-title">Add New Card</h1>
            </div>
            <div class="modal-body">
            </div>
        </div>
    </div>
</div>
<!-- Right Sidebar ends -->
</div>
</div>
</div>
<!-- END: Content-->
<?php if ($_page->head) { ?>
    <div class="sidenav-overlay"></div>
    <div class="drag-target"></div>
    <!-- BEGIN: Footer-->
    <footer class="footer footer-static footer-light">
        <p class="clearfix mb-0">
            <span class="float-md-start text-center d-block d-md-inline-block mt-25"><a class="ms-25" href="<?= $St->url ?>" target="_blank"><?= ($lang != "english" ? $_Atitle : $_title) ?></a> © <?= date("Y", time()) ?> <span class="d-none2 d-sm-inline-block"> , <?= plang('جميع الحقوق محفوظه', 'All rights Reserved') ?></span></span>
            <span class="float-md-end d-none2 text-center d-block d-md-block"><?= plang('مصنوع مع', 'Made with') ?><i data-feather="heart"></i> <?= plang('بواسطة', 'By') ?> <a href="https://www.facebook.com/MutasimSweileh" target="_blank" rel="noopener noreferrer">MutasimSweileh</a></span>
        </p>
    </footer>
    <button class="btn btn-primary btn-icon scroll-top" type="button"><i data-feather="arrow-up"></i></button>
    <!-- END: Footer-->
<?php  } ?>
<script>
    var HOST_URL = "<?= $St->url ?>";
    var user_id = "<?= $user_id ?>";
    var _id = "<?= $_id ?>";
    var Gapp = "<?= $Gapp ?>";
    var Gtype = "<?= $Gtype ?>";
    var lang = "<?= $lang ?>";
    var _St = <?= json_encode($St) ?>;
    var _login = <?= json_encode($_login) ?>;
    var _lang = <?= json_encode($_lang) ?>;
    var jsonData = <?= json_encode($jsonData) ?>;
</script>
<!-- BEGIN: Vendor JS-->
<script src="<?= $_site ?>/app-assets/vendors/js/vendors.min.js"></script>
<!-- BEGIN Vendor JS-->
<script src="<?= $_site ?>/app-assets/vendors/js/forms/validation/jquery.validate.min.js"></script>
<script src="<?= $_site ?>/app-assets/vendors/js/forms/select/select2.full.min.js"></script>
<script src="<?= $_site ?>/app-assets/vendors/js/extensions/moment.min.js"></script>
<script src="<?= $_site ?>/app-assets/vendors/js/tables/datatable/jquery.dataTables.min.js"></script>
<script src="<?= $_site ?>/app-assets/vendors/js/tables/datatable/datatables.buttons.min.js"></script>
<script src="<?= $_site ?>/app-assets/vendors/js/tables/datatable/dataTables.bootstrap5.min.js"></script>
<script src="<?= $_site ?>/app-assets/vendors/js/tables/datatable/datatables.checkboxes.min.js"></script>
<script src="<?= $_site ?>/app-assets/vendors/js/tables/datatable/dataTables.responsive.min.js"></script>
<script src="<?= $_site ?>/app-assets/vendors/js/tables/datatable/responsive.bootstrap5.min.js"></script>
<script src="<?= $_site ?>/app-assets/vendors/js/tables/datatable/jszip.min.js"></script>
<script src="<?= $_site ?>/app-assets/vendors/js/tables/datatable/pdfmake.min.js"></script>
<script src="<?= $_site ?>/app-assets/vendors/js/tables/datatable/vfs_fonts.js"></script>
<script src="<?= $_site ?>/app-assets/vendors/js/tables/datatable/buttons.html5.min.js"></script>
<script src="<?= $_site ?>/app-assets/vendors/js/tables/datatable/buttons.print.min.js"></script>
<script src="<?= $_site ?>/app-assets/vendors/js/tables/datatable/dataTables.rowGroup.min.js"></script>
<script src="<?= $_site ?>/app-assets/vendors/js/pickers/flatpickr/flatpickr.min.js"></script>
<script src="<?= $_site ?>/app-assets/vendors/js/forms/repeater/jquery.repeater.min.js"></script>
<!-- BEGIN: Page Vendor JS-->
<script src="<?= $_site ?>/app-assets/vendors/js/charts/apexcharts.min.js"></script>
<script src="<?= $_site ?>/app-assets/vendors/js/extensions/wNumb.min.js"></script>
<script src="<?= $_site ?>/app-assets/vendors/js/extensions/nouislider.min.js"></script>
<script src="<?= $_site ?>/app-assets/vendors/js/extensions/toastr.min.js"></script>
<script src="<?= $_site ?>/app-assets/vendors/js/extensions/sweetalert2.all.min.js"></script>
<script src="<?= $_site ?>/app-assets/vendors/js/forms/spinner/jquery.bootstrap-touchspin.js"></script>
<script src="<?= $_site ?>/app-assets/vendors/js/extensions/swiper.min.js"></script>
<script src="<?= $_site ?>/app-assets/vendors/js/forms/wizard/bs-stepper.min.js"></script>
<script src="<?= $_site ?>/app-assets/vendors/js/editors/quill/katex.min.js"></script>
<script src="<?= $_site ?>/app-assets/vendors/js/editors/quill/highlight.min.js"></script>
<script src="<?= $_site ?>/app-assets/vendors/js/editors/quill/quill.min.js"></script>
<script src="<?= $_site ?>/app-assets/vendors/js/forms/cleave/cleave.min.js"></script>
<!-- END: Page Vendor JS-->
<!-- BEGIN: Theme JS-->
<!--  <script src="<?= $_site ?>/app-assets/js/scripts/forms/form-number-input.min.js"></script> -->
<script src="<?= $_site ?>/assets/js/app-ecommerce.js"></script>
<script src="<?= $_site ?>/assets/js/app-invoice-list.js"></script>
<script src="<?= $_site ?>/app-assets/js/core/app-menu.min.js"></script>
<script src="<?= $_site ?>/app-assets/js/core/app.js"></script>
<script src="<?= $_site ?>/assets/js/app-email.js"></script>
<script src="<?= $_site ?>/assets/js/html2canvas.min.js"></script>
<? if ($_page->slug == "index") { ?>
    <script src="<?= $_site ?>/assets/js/card-analytics.js"></script>
<? } ?>
<!-- END: Theme JS-->
<!-- BEGIN: Page JS-->
<!--  <script src="<?= $_site ?>/app-assets/js/scripts/pages/dashboard-ecommerce.js"></script> 
    <script src="<?= $_site ?>/app-assets/js/scripts/pages/page-auth-login.js"></script>-->
<!-- END: Page JS-->
<script>
    (function() {

        var beforePrint = function() {
            console.log('Functionality to run before printing.');
        };

        var afterPrint = function() {
            console.log('Functionality to run after printing');
        };

        if (window.matchMedia) {
            var mediaQueryList = window.matchMedia('print');
            mediaQueryList.addListener(function(mql) {
                if (mql.matches) {
                    beforePrint();
                } else {
                    afterPrint();
                }
            });
        }

        window.onbeforeprint = beforePrint;
        window.onafterprint = afterPrint;

    }());

    function setCookie(cname, cvalue, exdays) {
        const d = new Date();
        d.setTime(d.getTime() + (exdays * 24 * 60 * 60 * 1000));
        let expires = "expires=" + d.toUTCString();
        document.cookie = cname + "=" + cvalue + ";" + expires + ";path=/";
    }

    function getCookie(cname) {
        let name = cname + "=";
        let decodedCookie = decodeURIComponent(document.cookie);
        let ca = decodedCookie.split(';');
        for (let i = 0; i < ca.length; i++) {
            let c = ca[i];
            while (c.charAt(0) == ' ') {
                c = c.substring(1);
            }
            if (c.indexOf(name) == 0) {
                return c.substring(name.length, c.length);
            }
        }
        return "";
    }
    var direction = 'ltr',
        isRTL = false;
    if ($('html').data('textdirection') == 'rtl') {
        direction = 'rtl';
        isRTL = true;
    }
    jQuery.fn.tagName = function() {
        if (!this.prop("tagName"))
            return "";
        return this.prop("tagName").toLowerCase();
    };
    String.prototype.isBase64 = function() {
        var str = this;
        if (str === '' || str.trim() === '') {
            return false;
        }
        try {
            return btoa(atob(str)) == str;
        } catch (err) {
            return false;
        }
    }
    String.prototype.isNumeric = function() {
        var value = this;
        return /^-?\d+$/.test(value);
    }
    if (jsonData)
        $("input,select,div").each(function() {
            var name = $(this).attr("name");
            if (name == "password")
                $(this).val("");
            else if (jsonData && jsonData[name] && jsonData[name].trim() != "") {
                if ($(this).tagName() == "div" || $(this).attr("type") == "file" || $(this).attr("type") == "date" ||
                    $(this).data().hasOwnProperty("flatpickr")
                )
                    $(this).attr("value", btoa(unescape(encodeURIComponent(jsonData[name]))));
                else
                    $(this).val(jsonData[name]);
            }
        });
    $(window).on('load', function() {
        if (feather) {
            feather.replace({
                width: 14,
                height: 14
            });
        }
        $("[data-action=product_colors]:first").trigger("click");
        if (Gapp.indexOf("print") !== -1) {
            window.print();
            window.onafterprint = function() {
                window.close();
            }
        }
    });

    function capitalizeFirstLetter(string) {
        return string.charAt(0).toUpperCase() + string.slice(1);
    }

    function makeAlert(data) {
        if (!data.msg)
            return false;
        var o = ("rtl" === $("html").data("textdirection"));
        var t = data.title;
        if (!data.title) {
            t = data.msg;
            data.msg = "";
        } else
            t = capitalizeFirstLetter(t);
        var options = {
            title: t,
            text: data.msg,
            icon: data.st,
            position: (data.toast ? (o ? 'top-start' : 'top-end') : ""),
            iconHtml: data.iconHtml,
            showCancelButton: data.callback,
            showConfirmButton: !data.toast,
            toast: data.toast,
            timer: (data.red ? 2500 : (data.callback ? false : 2500)),
            allowOutsideClick: false,
            timerProgressBar: true,
            confirmButtonText: _lang["ok"],
            cancelButtonText: _lang["Cancel"],
            customClass: {
                confirmButton: 'btn btn-primary',
                cancelButton: 'btn btn-outline-danger ms-1'
            },
            buttonsStyling: false,
            willClose: () => {
                if (data.red) {
                    if (data.red == window.location.href)
                        location.reload();
                    else
                        location.replace(data.red);
                }
            },
            didOpen: () => {
                feather.replace({
                    width: 30,
                    height: 30
                });
            }
        };

        Swal.fire(options).then(function(result) {
            if (result.value) {
                if (data.callback)
                    data.callback();
            } else if (result.dismiss === Swal.DismissReason.cancel) {
                if (data.callback_cancel)
                    data.callback_cancel();
            }
        });
    }



    function makeToast(data) {
        //console.log(lang);
        if (!data.msg)
            return false;
        // data.toast = true;
        // makeAlert(data);
        //  return;
        var o = ("rtl" === $("html").data("textdirection"));
        var t = data.title || data.st;
        if (data.title == "")
            t = "";
        t = capitalizeFirstLetter(t);
        t = "";
        var options = {
            closeButton: true,
            positionClass: "toast-top-right",
            tapToDismiss: true,
            progressBar: true,
            //closeDuration:300,
            timeOut: (data.red ? 2500 : 2500),
            rtl: o,
            onHidden: function() {
                if (data.red) {
                    if (data.red == window.location.href)
                        location.reload();
                    else
                        location.replace(data.red);
                }
            }
        };
        toastr[data.st](t, data.msg, options);
        /* if(data.st == "success")            
        toastr.success(data.msg,capitalizeFirstLetter(t), options);
        else if(data.st == "info")            
        toastr.info(data.msg,t, options);
        else      
        toastr.error(data.msg,t, options); */
    }

    function modalOpen(data, center) {
        if (data.modal) {
            data = data.modal;
            var $modal = $((center ? "#centerModal" : "#slideModal"));
            $modal.find(".modal-title").text(data.title);
            $modal.find(".modal-body").html(data.body);
            var id = makeid(10);

            function loop(sel, done) {
                sel.each(function() {
                    var name = $(this).attr("name");
                    if (name == "password")
                        $(this).val("");
                    else if (name && data.data[name]) {
                        if ($(this).tagName() == "div" || $(this).attr("type") == "file" || $(this).attr("type") == "date" ||
                            $(this).data().hasOwnProperty("flatpickr")
                        ) {
                            if (Array.isArray(data.data[name]))
                                data.data[name] = JSON.stringify(data.data[name]);
                            $(this).attr("value", btoa(unescape(encodeURIComponent(data.data[name]))));
                        } else
                            $(this).val(data.data[name]);
                        $(this).trigger("change");
                        var doit = 0;
                        if ($(this).tagName() == "select" && !done)
                            $(document).ajaxComplete(function() {
                                if (doit < 2) {
                                    loop($modal.find(".modal-body").find("input,select,div,textarea").filter(function(el) {
                                        return $(this).attr("name") != name;
                                    }), true);
                                    doit++;
                                }
                            });
                    }
                });
            }
            if (data.data)
                loop($modal.find(".modal-body").find("input,select,div,textarea"));
            $modal.find(".modal-body").find(".my-1").addClass("text-center");
            $modal.find(".modal-body").doEditor();
            $modal.find(".modal-body").doIcons();
            $modal.find(".modal-body").doTouchSpin();
            $modal.find(".modal-body").doflatpickr();
            $modal.find(".modal-body").doSelect2();
            $modal.find(".modal-body").doRepeater();
            $modal.find(".modal-body").formSubmit();
            $modal.find(".modal-body").fileUpload();
            $modal.find(".modal-body").doAutoDir();
            $modal.modal({
                backdrop: 'static',
                keyboard: true
            })
            $(".dtr-bs-modal").modal("hide");
            $modal.modal('show');
        }
    }
    $(".nav-link-interface").on("click", function() {
        var $html = $("html");
        var interface = "light";
        if ($html.hasClass("dark-layout")) {
            $html.removeClass('dark-layout');
            $html.addClass('light-layout');
            $(this).find('svg').replaceWith(feather.icons['moon'].toSvg({
                class: 'ficon'
            }));
            //setCookie("interface", "light", 1);
            interface = "light";
        } else {
            $html.addClass('dark-layout');
            $html.removeClass('light-layout');
            $(this).find('svg').replaceWith(feather.icons['sun'].toSvg({
                class: 'ficon'
            }));
            interface = "dark";
            //setCookie("interface", "dark", 1);
        }
        $.post(HOST_URL + "/ajax.php", {
            action: "update",
            id: _login.id,
            update: {
                "interface": interface
            },
            table: "login"
        }, function(d) {});
        return false;
    });
    $("[data-uslider]").each(function() {
        var currency = $(this).data("currency");
        var d = $(this).data("uslider");
        d = d.split(",").map(Number);
        //console.log(d);
        noUiSlider.create(this, {
            start: [d[0], d[1]],
            direction: direction,
            connect: true,
            tooltips: [true, true],
            format: wNumb({
                decimals: 0, // default is 2
                thousand: ',', // thousand delimiter
                postfix: " " + currency, // gets appended after the number
            }),
            range: {
                min: d[0],
                max: d[1]
            }
        }).on('change', function(val) {
            val = val.map(function(v) {
                return v.replace(currency, "").replace(",", "").trim();
            });
            $("#PriceRange").val(val.join(":"));
            //console.log(val); 
        });;
    });

    function makeid(length) {
        var result = '';
        var characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
        var charactersLength = characters.length;
        for (var i = 0; i < length; i++) {
            result += characters.charAt(Math.floor(Math.random() *
                charactersLength));
        }
        return result;
    }
    jQuery.fn.doSelect2 = function() {
        var ar = [];
        if ($(this).tagName() == "select" && !$(this).data().hasOwnProperty("noselect")) ar.push(this);
        else $(this).find("select").each(function() {
            if (!$(this).data().hasOwnProperty("noselect"))
                ar.push(this);
        });
        var templateResult = function(el) {
            if (!el.id) {
                return el.text;
            }
            var icon = $(el.element).data('icon');
            var classs = $(el.element).data('class');
            var avatar = $(el.element).data('avatar');
            var color = $(el.element).data('color');
            if (icon || avatar) {
                if (icon && icon.indexOf("class") === -1)
                    icon = feather.icons[icon].toSvg({
                        class: (classs ? classs : "m-0")
                    });
                if (avatar) {
                    icon = "<img src='" + HOST_URL + '/uploads/' + avatar + "' alt='avatar' />";
                }
                $html = `<div class="d-flex justify-content-left align-items-center">
                    <div class="avatar avatar-sm  bg-light-` + (color ? color : "secondary") + `  me-1">
                        <span class="avatar-content">` + icon + `</span></div>
                        <div class="d-flex flex-column">
                            <span class="emp_name text-truncate fw-bold">` + $(el.element).text() + `</span>`;
                if ($(el.element).data("number"))
                    $html += `<small class="emp_post text-truncate text-muted">` + $(el.element).data("number") + `</small>`;
                $html += `</div>
                    </div>`;
                return $html;
            } else {
                return el.text;
            }
        }
        ar.forEach(function(el) {
            var $this = $(el);
            $this.wrap('<div class="position-relative"></div>');
            var id = makeid(10);
            var options = {
                dropdownAutoWidth: true,
                width: '100%',
                dir: direction,
                minimumResultsForSearch: Infinity,
                dropdownParent: $this.parent(),
                templateResult: templateResult,
                templateSelection: templateResult,
                escapeMarkup: function(es) {
                    return es;
                }
            };
            if ($this.get(0).hasAttribute("multiple")) {
                // options.tags = true;
                options.closeOnSelect = false;
                options.tokenSeparators = [',', ' '];
                delete options["minimumResultsForSearch"];
            }
            if ($this.data().hasOwnProperty("search"))
                delete options["minimumResultsForSearch"]
            $this.select2(options).on("change", function() {
                $(this).valid();
                if ($this.find(':selected').data("price")) {
                    $(".delivery_charges").text($this.find(':selected').data("price"));
                    $("input[name=delivery_charges]").val($this.find(':selected').data("price"));
                    $(".template_checkout").load(HOST_URL + "/inc/template/checkout.php?show=true", {
                        delivery_charges: $("input[name=delivery_charges]").val()
                    }, function() {
                        feather.replace();
                        getTouchSpin(".quantity-counter");
                    });
                }
                if ($this.data("action")) {
                    $.post(HOST_URL + "/ajax.php", {
                        id: $(this).val(),
                        "action": $this.data("action")
                    }, function(data) {
                        _log(data);
                        $(data.target).html(data.html).trigger('change');
                    }, "json");
                }
                if ($this.data("action"))
                    $("[data-action=" + $this.data("action") + "]").trigger("click");
            }).on('select2:open', function() {
                if (!$(document).find('#' + id).length && $this.data("add")) {
                    var btn = $this.data("add").split(",");
                    var t = btn[0];
                    if (btn[1].indexOf("#") !== -1) {
                        btn = 'data-bs-toggle="modal" data-bs-target="' + btn[1] + '"';
                    } else {
                        btn = (btn.length > 2 ? "data-center" : "") + ' data-modal="' + btn[1] + '" ';
                    }
                    $(document)
                        .find('.select2-results__options')
                        .before('<div id="' + id + '" class="btn btn-flat-success cursor-pointer rounded-0 text-start mb-50 p-50 w-100" ' + btn + '>' + feather.icons['plus'].toSvg({
                            class: 'font-medium-1 me-50'
                        }) + '<span class="align-middle">' + t + '</span></div>');
                    $(document).on("click", "#" + id, function() {
                        $("#slideModal").modal("hide");
                    });
                }
            });
        });
    }
    jQuery.fn.doEditor = function() {
        var ar = [];
        if ($(this).data().hasOwnProperty("editorel")) ar.push(this);
        else $(this).find("[data-editorel]").each(function() {
            ar.push(this);
        });
        ar.forEach(function(el) {
            el.editorEl = $(el);
            var value = el.editorEl.attr("value");
            if (value && value.isBase64())
                value = decodeURIComponent(escape(atob(value)));
            var name = (el.editorEl.attr("name") ? el.editorEl.attr("name") : el.editorEl.data("editorEl"));
            var modules = {
                formula: true,
                syntax: true,
            };
            if (el.editorEl.tagName() != "textarea") {
                el.texteditor = $("<textarea></textarea>").attr("name", name).addClass("d-none");
                if (el.editorEl.data("validmsg"))
                    el.texteditor.attr("data-validmsg", el.editorEl.data("validmsg"));
                el.texteditor.insertBefore(el.editorEl);
            }
            if ($(el).nextAll("[data-editorbar]"))
                modules.toolbar = $(el).nextAll("[data-editorbar]").get(0);
            el.emailEditor = new Quill(el.editorEl.get(0), {
                modules: modules,
                placeholder: el.editorEl.data("placeholder") || _lang['Message'],
                theme: 'snow'
            });
            if (value) {
                el.emailEditor.setContents(el.emailEditor.clipboard.convert(value), 'silent');
                el.texteditor.val(value);
            }
            el.emailEditor.on('text-change', function(delta, oldDelta, source) {
                var html = el.emailEditor.root.innerHTML;
                //console.log(delta);
                el.texteditor.val(html);
            });
        });
        return this;
    };
    jQuery.fn.doTouchSpin = function() {
        var ar = [];
        if (typeof this != undefined && $(this).tagName() == "input") ar.push(this);
        else $(this).find("[data-TouchSpin]").each(function() {
            ar.push(this);
        });
        ar.forEach(function(el) {
            var touchspinValue = $(el),
                counterMin = $(el).attr("min"),
                counterMax = $(el).attr("max");
            $(el).wrap('<div class="input-group bootstrap-touchspin w-100"></div>');
            //console.log(counterMax);
            if (!counterMax) {
                counterMax = 1000;
                $(el).attr("max", counterMax);
            }
            $(el).TouchSpin({
                    min: counterMin,
                    max: counterMax,
                    verticalbuttons: false,
                    buttondown_txt: feather.icons['minus'].toSvg(),
                    buttonup_txt: feather.icons['plus'].toSvg()
                })
                .on('touchspin.on.startdownspin', function() {
                    // var $this = $(this);
                    $(this).closest(".bootstrap-touchspin").find('.bootstrap-touchspin-up').removeClass('disabled-max-min').removeClass('disabled');
                    if (Number($(this).val()) >= Number($(this).attr("min"))) {
                        upCart(this);
                    } else {
                        $(this).trigger("touchspin.updatesettings", {
                            max: $(this).attr("min")
                        });
                    }
                    if (Number($(this).val()) == Number($(this).attr("min"))) {
                        // $(this).siblings().find('.bootstrap-touchspin-down').attr("");
                        $(this).closest(".bootstrap-touchspin").find('.bootstrap-touchspin-down').addClass('disabled-max-min').addClass('disabled');
                    }
                })
                .on('touchspin.on.startupspin', function() {
                    //    var $this = $(this);
                    $(this).closest(".bootstrap-touchspin").find('.bootstrap-touchspin-down').removeClass('disabled-max-min').removeClass('disabled');
                    if (Number($(this).val()) <= Number($(this).attr("max")))
                        upCart(this);
                    else {
                        $(this).trigger("touchspin.updatesettings", {
                            max: $(this).attr("max")
                        });
                    }
                    if (Number($(this).val()) == Number($(this).attr("max"))) {
                        $(this).closest(".bootstrap-touchspin").find('.bootstrap-touchspin-up').addClass('disabled-max-min').addClass('disabled');
                        return false;
                    }
                });
            $(el).removeAttr("data-TouchSpin");
        });
    }
    jQuery.fn.fileUpload = function() {
        var ar = [];
        if ($(this).data() && $(this).data().hasOwnProperty("upload")) ar.push(this);
        else $(this).find("[data-upload],[type=file]").each(function() {
            if (!$(this).data().hasOwnProperty("upload2"))
                ar.push(this);
        });
        // _log($(this).tagName());
        ar.forEach(function(el) {
            var $this = $(el);
            var name = ($(el).attr("name") ? $(el).attr("name") : $(el).data("upload"));
            //var val = $(el).attr("value");
            var val = $(el).val();
            if (!val)
                val = $(el).attr("value");
            if (val && val.isBase64())
                val = decodeURIComponent(escape(atob(val)));
            var id = makeid(10);
            var $html = $(`<div class="d-flex">
                                <a  class="me-25 ">
                                    <img src="" data-image  class="rounded me-50 border cursor-pointer" alt="profile image" height="80" width="80">
                                </a>
                                <div class="mt-75 ms-1">
                                    <label for="` + id + `" class="btn btn-sm btn-primary mb-75 me-75 waves-effect waves-float waves-light">` + _lang["Upload"] + `</label>
                                    <input id="` + id + `" data-upload2 type="file" hidden="" accept="image/*">
                                    <input  data-input-image type="hidden" >
                                    <button type="button" data-remove class="btn btn-sm ` + (val ? "" : "d-none") + ` btn-outline-secondary mb-75 waves-effect">` + _lang["remove"] + `</button>
                                    <p>` + _lang["Allowed"] + `</p>
                                </div>
                            </div>`);
            var val2 = (!val || val.indexOf("base64") === -1 ? HOST_URL + "/uploads/" + (val || "blank.png") : val);
            $html.find("[data-image]").attr("src", val2);
            $html.find("[data-input-image]").attr("name", name);
            $html.find("[data-input-image]").val(val);
            $(el).replaceWith($html);
            $html.on("change", "[type=file]", function(e) {
                var n = $html.find("[data-image]");
                var r = new FileReader,
                    a = e.target.files;
                r.onload = function() {
                    n.attr("src", r.result);
                    $html.find("[data-input-image]").val(r.result);
                    $html.find("[data-remove]").removeClass("d-none");
                }, r.readAsDataURL(a[0]);
            });
            $html.on("click", "[data-remove]", function() {
                $html.find("[data-image]").attr("src", HOST_URL + "/uploads/blank.png");
                $html.find("[data-input-image]").val("");
                $(this).addClass("d-none");
            });
        });
    }
    jQuery.fn.doRepeater = function() {
        var ar = [];
        if ($(this).data().hasOwnProperty("repeater")) ar.push(this);
        else $(this).find("[data-repeater]").each(function() {
            ar.push(this);
        });
        ar.forEach(function(el) {
            var value = $(el).attr("value");
            var name = ($(el).attr("name") ? $(el).attr("name") : $(el).data("repeater"));
            var $input = $('<input type="hidden" name="items">');
            var col = $(el).data().hasOwnProperty("col");
            $input.attr("name", name);
            //console.log(value);
            if (value && value.isBase64() && typeof value != undefined)
                value = decodeURIComponent(escape(atob(value)));
            //console.log(value);
            var $repeater = $(el).repeater({
                initEmpty: $(el).data().hasOwnProperty("empty"),
                isFirstItemUndeletable: $(el).data().hasOwnProperty("undelete"),
                show: function() {
                    $(this).slideDown();
                    var i = $(this).index();
                    if (feather) {
                        feather.replace({
                            width: 14,
                            height: 14
                        });
                    }
                    $(this).fileUpload();
                    $(this).doTouchSpin();
                    $(this).doIcons();
                    $input.remove();
                    if ((i > 0) && col) {
                        $(this).closest("[data-repeater-list]").addClass("row");
                        $(this).closest("[data-repeater-list]").find("[data-repeater-item]").addClass("col-md-6");
                    }
                },
                hide: function(e) {
                    var i = $(this).index();
                    if (i == 0) {
                        $input.prependTo($(el));
                    } else {
                        $input.remove();
                    }
                    $(this).slideUp(function() {
                        if ((i == 1 || i == 0) && col) {
                            $(this).closest("[data-repeater-list]").removeClass("row");
                            $(this).closest("[data-repeater-list]").find("[data-repeater-item]").removeClass("col-md-6");
                        }
                        $(this).remove();
                    });
                },
                ready: function(setIndexes) {
                    // console.log(setIndexes);
                }
            });
            if (value && typeof value != undefined) {
                value = JSON.parse(decodeURIComponent(value));
                _log(value);
                $repeater.setList(value);
            }
            $(el).removeAttr("data-repeater");
        });
    }
    jQuery.fn.doIcons = function() {
        var ar = [];
        if ($(this).tagName() == "input") ar.push(this);
        else $(this).find("[data-icons]").each(function() {
            ar.push(this);
        });
        ar.forEach(function(el) {
            if ($(el).attr("type") != "file") {

                var id = makeid(10);
                $(el).attr("id", id);
                var $btn = null;
                if ($(el).nextAll(".input-group-text").length) {
                    $btn = $(el).nextAll(".input-group-text");
                } else {
                    $(el).wrap('<div class="input-group input-group-merge"></div>');
                    $btn = $('<span class="input-group-text">' + feather.icons["search"].toSvg({
                        "class": "font-medium-2  cursor-pointer"
                    }) + '</span>');
                    $(el).closest(".input-group").append($btn);
                }
                $btn.attr("id", id + "2");
                $(document).on("click", "#" + id + "2", function() {
                    var icons = Object.keys(feather.icons),
                        iconsContainer = $("#centerModal").find(".modal-body");
                    $("#centerModal").find(".modal-title").text(_lang["selectIcon"]);
                    $("#centerModal").find(".modal-dialog").addClass("modal-lg");
                    iconsContainer.addClass("d-flex flex-wrap justify-content-center p-0");
                    iconsContainer.html(`<div class="w-100"><div class="mb-1 input-group input-group-merge my-2 mx-auto w-50">
                <span class="input-group-text">` + feather.icons["search"].toSvg() + `</span>
                <input type="text" class="form-control" id="icons-search" placeholder="Search Icons...">
                </div></div>`);
                    if (icons.length) {
                        icons.map(function(icon) {
                            if (iconsContainer.length) {
                                iconsContainer.append('<div class="card icon-card cursor-pointer text-center mb-1 mx-50" data-bs-html="true" data-bs-toggle="tooltip" data-bs-placement="top" title="' + icon + '" data-icon="<i data-feather=\'' + icon + '\'></i>"> <div class="card-body"> <div class="icon-wrapper">' + feather.icons[icon].toSvg() + '</div><p class="icon-name d-none text-truncate mb-0 mt-1">' + icon + '</p> </div></div>');
                            }
                        });
                    }
                    iconsContainer.find('.icon-card').on('click', function() {
                        var $this = $(this),
                            iconCode = $this.data('icon');
                        iconsContainer.find('.icon-card.active').removeClass('border');
                        $this.addClass('border');
                        $("#" + id).val(iconCode);
                        $("#centerModal").modal("hide");
                    });
                    iconsContainer.find("#icons-search").on('keyup', function() {
                        var value = $(this).val().toLowerCase();
                        iconsContainer.find('.icon-card').filter(function() {
                            var $this = $(this);
                            if ($this.text().toLowerCase().indexOf(value) < !1) {
                                $this.css('display', 'none');
                            } else {
                                $this.css('display', 'block');
                            }
                        });
                    });
                    $("#centerModal").modal("show");
                });
            }
        });
    }
    jQuery.fn.doflatpickr = function() {
        var ar = [];
        if ($(this).tagName() == "input") ar.push(this);
        else $(this).find("[data-flatpickr]").each(function() {
            ar.push(this);
        });
        ar.forEach(function(el) {
            var value = $(el).attr("value");
            if (value) {
                if (value.isBase64())
                    value = decodeURIComponent(escape(atob(value)));
                value = moment((Number(value) * 1000)).format('YYYY-MM-DD');
                //console.log(value);
                //$(el).removeAttr("value");
                //$(el).val(value);
            } else {
                if ($(el).data().hasOwnProperty("nodate"))
                    value = "";
                else
                    value = "today";
            }
            $(el).wrap('<div class="input-group input-group-merge"></div>');
            var flat = $(el).flatpickr({
                dateFormat: ($(el).data("format") ? $(el).data("format") : 'Y-m-d'),
                defaultDate: value,
                //minDate: "today",
                onReady: function(selectedDates, dateStr, instance) {
                    if (instance.isMobile) {
                        $(instance.mobileInput).attr('step', null);
                    }
                }
            });
            $('<span class="input-group-text" id="basic-addon5">' + feather.icons["x-circle"].toSvg({
                "class": "font-medium-2  cursor-pointer"
            }) + '</span>').appendTo($(el).closest(".input-group")).on("click", function() {
                flat.clear();
                $(el).attr("placeholder", _lang["none"]);
                $(el).val("");
            });
        });
    }
    jQuery.fn.doFeather = function() {
        var el = $(this);
        el.find("[data-feather]").each(function() {
            $(this).replaceWith(feather.icons[$(this).data("feather")].toSvg({
                class: $(this).attr("class")
            }));
        });
        return el;
    };
    jQuery.fn.doAutoDir = function() {
        var ar = [];
        if ($(this).tagName() == "input" || $(this).tagName() == "textarea") ar.push(this);
        else $(this).find("input,textarea").each(function() {
            ar.push(this);
        });
        ar.forEach(function(el) {
            var name = $(el).attr("name");
            var type = $(el).attr("type");
            var placholder = $(el).attr("placeholder");
            if ((name == "price" || name == "total" || name == "money") && type != "hidden") {
                $(el).attr("type", "text");
                new Cleave(el, {
                    numeral: true,
                    numeralThousandsGroupStyle: 'thousand'
                });
            } else {
                if (name != "password" && (!placholder || placholder && !placholder.isNumeric() || name == "code") && type != "hidden") {
                    $(el).on("change keyup", function() {
                        var val = $(this).val();
                        if (!val && isRTL) {
                            $(this).attr("dir", "rtl");
                        } else {
                            $(this).attr("dir", "auto");
                        }
                    });
                }
                if (name != "date" && type != "file")
                    $(el).trigger("change");
                //var val = $(el).val();
                //if (name != "date" && $(el).val())
                //$(el).attr("dir", "auto");
            }
        });
    }
    $("input,textarea").each(function() {
        $(this).doAutoDir();
    });
    $("[data-select],[data-selecticons]").each(function() {
        $(this).doSelect2();
    });
    $("[data-icons],[name=icon]").each(function() {
        $(this).doIcons();
    });
    $("[data-repeater]").each(function(i, elm) {
        $(this).doRepeater();
    });
    $("[data-editorel]").each(function(i, elm) {
        $(this).doEditor();
    });

    function getTouchSpin(el) {
        $(el).doTouchSpin();
    }
    $(".form-switch").each(function() {
        $(this).find("input[type=checkbox]").eq(0).val(1);
        var el = $(this).find("input[type=checkbox]").eq(0).clone();
        el.attr("type", "hidden");
        el.removeAttr("id");
        el.removeAttr("checked");
        el.val(0);
        $(this).prepend(el);
    });
    $("[data-flatpickr]").each(function() {
        $(this).doflatpickr();
    });
    $("[data-load]").each(function() {
        var load = $(this).data("load");
        if ($(this).tagName() == "select")
            return;
        var value = $(this).attr("value");
        if (value && value.isBase64() && typeof value != undefined) {
            value = decodeURIComponent(escape(atob(value)));
            //value = JSON.parse(decodeURIComponent(value));
        }
        // if (value)
        $(this).load(HOST_URL + "/ajax.php", {
            "action": "load",
            "id": load,
            "data": value
        }, function() {
            if (feather) {
                feather.replace({
                    width: 14,
                    height: 14
                });
            }
        });
    });
    $("[data-TouchSpin]").each(function() {
        $(this).doTouchSpin();
    });

    function upCart(el) {
        if ($(el).data("id")) {
            var data = {};
            data.data_id = $(el).data("id");
            data.action = $(el).data("table");
            data.amount = $(el).val();
            var delivery_charges = 0;
            if ($(el).attr("name").indexOf("products") !== -1) {
                delivery_charges = $("input[name=delivery_charges]").val();
                coupon = $("input[name=coupon]").val();
            }
            // console.log(data);
            $.post(HOST_URL + "/ajax.php", data, function(data) {
                $("#template_cart").load(HOST_URL + "/inc/template/cart.php?show=true", function() {
                    feather.replace();
                    getTouchSpin("input[name=amount_cart]");
                    if ($(el).attr("name") == "amount_cart")
                        $("#cart_icon").dropdown('toggle');
                });
                if ($(el).attr("name").indexOf("products") !== -1)
                    $(".template_checkout").load(HOST_URL + "/inc/template/checkout.php?show=true", {
                        delivery_charges: delivery_charges,
                        coupon: coupon
                    }, function() {
                        feather.replace();
                        getTouchSpin(".quantity-counter");
                    });
            }, "json");
        }
    }

    function reCart(el) {
        var el2 = $("[data-action=cart]");
        //if (el2.length > 0)
        //   $("[data-action=cart]").trigger("click");
        //else {
        $.post(HOST_URL + "/ajax.php", {
            id: $(el).data("id"),
            "action": "cart",
            "remove": 1
        }, function(data) {
            $("#template_cart").load(HOST_URL + "/inc/template/cart.php?show=true", function() {
                feather.replace();
                getTouchSpin("input[name=amount_cart]");
                if (!$(el).data("checkout"))
                    $("#cart_icon").dropdown('toggle');
            });
            if ($(el).data("checkout"))
                $(".template_checkout").load(HOST_URL + "/inc/template/checkout.php?show=true", function() {
                    feather.replace();
                    getTouchSpin(".quantity-counter");
                });
            makeToast(data);
        }, "json");
        //}
    }
    $("#template_cart").load(HOST_URL + "/inc/template/cart.php", function() {
        if ($(this).find(".list-item").length)
            $("#cart_icon").toggleClass("cart_animation");
        feather.replace();
        getTouchSpin("input[name=amount_cart]");
        $(this).find("[data-cart]").on("click", function() {
            reCart(this);
        });
    });

    function _log(str, er) {
        console.log(str);
    }
    // $(".cart-item-remove").on("click",function(){ reCart(this); });
    $(document).on("keyup", "#searchFq", function() {
        var value = $(this).val().toLowerCase();
        if (value !== '') {
            $(".accordion-item").closest(".tab-pane").removeClass("active");
            $(".accordion-item").closest(".tab-pane").removeClass("mt-2");
            $('.accordion-item').filter(function() {
                if ($(this).text().toLowerCase().indexOf(value) == -1) {
                    $(this).addClass("d-none");
                } else {
                    $(this).closest(".tab-pane").addClass("active");
                    $(this).closest(".tab-pane").addClass("mt-2");
                }
            });
            var tbl_row = $('.accordion-item:visible').length;
            //Check if table has row or not
            if (tbl_row == 0) {
                $(".no-result").removeClass("d-none");
                $(".accordion-item").closest(".tab-pane").removeClass("active");
                $(".accordion-item").closest(".tab-pane").removeClass("mt-2");
                $('.accordion-item').animate({
                    scrollTop: '0'
                }, 500);
            } else {
                $(".no-result").addClass("d-none");
            }
            $(".faq-ansers").addClass("col-lg-12");
            $(".faq-category").addClass("d-none");
        } else {
            // If filter box is empty
            $(".faq-category").removeClass("d-none");
            $('.accordion-item').removeClass("d-none");
            $(".faq-ansers").removeClass("col-lg-12");
            //$(".tab-pane").eq(0).addClass("active");
            $(".accordion-item").eq(0).closest(".tab-pane").addClass("active");
            $(".accordion-item").closest(".tab-pane").removeClass("mt-2");
            $(".no-result").addClass("d-none");
        }
    });
    $(document).on("click", "[data-cart]", function(event) {
        ///  alert(event);
        reCart(this);
    });
    $(document).on("click", "[data-download]", function(event) {
        var download = $(this).data("download");
        download = $(download);

        html2canvas(download.get(0)).then(canvas => {
            var a = document.createElement('a');
            a.href = canvas.toDataURL("image/jpeg").replace("image/jpeg", "image/octet-stream");
            a.download = _St["title"].split("-")[0] + "-" + Gapp + _id + '.jpg';
            a.click();
        });
    });
    $(document).on("click", "[data-modal]", function(event) {
        var modal = $(this);
        $.post(HOST_URL + "/ajax.php", {
            action: "modal",
            modal: modal.data("modal"),
            table: modal.data("table"),
            id: modal.data("id"),
            jsondata: modal.data("data"),
            rawdata: modal.data("rawdata"),
            index: modal.data("index")
        }, function(data) {
            _log(data);
            modalOpen(data, modal.data().hasOwnProperty("center"));
            modal.tooltip('hide');
            if (feather) {
                feather.replace({
                    width: 14,
                    height: 14
                });
            }
        }, "json").fail(function(xhr, textStatus, error) {
            var err = textStatus + ", " + error;
            console.log("Request Failed: " + err);
            console.log(xhr.responseText);
        });;
    });
    $(document).on("change", "[data-load]", function(event) {
        var lo = $(this).data("load").split(",");
        var val = $(this).val();
        $(lo[1]).load(HOST_URL + "/ajax.php", {
            "action": lo[0],
            "id": val
        }, function() {});
    });
    $(document).on("click change keypress", "[data-action]", function(event) {
        var keycode = (event.keyCode ? event.keyCode : event.which);
        if (keycode && keycode != '13' && keycode != '1')
            return true;
        if ($(this).hasClass("disabled"))
            return false;
        var $this = $(this);
        var viewArr = $(this).closest("form").serializeArray();
        var viewArr2 = $(this).closest("form").serialize();
        var data = {};
        $.each($(this).data(), function(i, item) {
            if (i != "msg" && i.indexOf("select") === -1)
                data[i] = item;
        });
        viewArr.forEach(function(el) {
            if (data[el.name]) {
                if (!Array.isArray(data[el.name]))
                    data[el.name] = [data[el.name]];
                data[el.name].push(el.value);
            } else
                data[el.name] = el.value;

        });
        if ($("input[name=coupon]").val())
            data.coupon = $("input[name=coupon]").val();
        var action = data.action;
        var index = data.index;
        var index = data.index;
        var block = (data.block ? data.block : $(this).closest("form").data("block"));
        var red = (data.red ? data.red : $(this).closest("form").data("red"));
        _log(data);
        if (action == "ClearFilters") {
            location.reload();
            return false;
        }
        $(block).block({
            message: '<div class="spinner-grow spinner-grow-sm text-primary" role="status"></div>',
            css: {
                backgroundColor: 'transparent',
                border: '0'
            },
            overlayCSS: {
                backgroundColor: '#fff',
                opacity: 0.8
            }
        });
        if ($this.tagName() != "input" && $this.tagName() != "select")
            $(this).attr("disabled", "disabled");
        $.post(HOST_URL + "/ajax.php", data, function(data) {
            _log(data);
            $this.removeAttr("disabled");
            //if(data.st == "success"){
            switch (action) {
                case "cart":
                    var msg = data.msg;
                    // $this.toggleClass('btn-danger').find('.add-to-cart').text(data.btnmsg);
                    $("#template_cart").load(HOST_URL + "/inc/template/cart.php", function() {
                        $("#cart_icon").toggleClass("cart_animation");
                        feather.replace();
                        getTouchSpin("input[name=amount_cart]");
                    });
                    //data.msg = false;
                    break;
                case "product_colors":
                case "product_sizes":
                    if (action == "product_colors")
                        $("#product_sizes").html(data.html);
                    $(".stock").text(data.stock);
                    $("input[name=amount]").attr("max", data.stock);
                    $("input[name=amount]").val(1);
                    $("input[name=amount]").trigger("touchspin.updatesettings", {
                        max: data.stock
                    });
                    $('.bootstrap-touchspin-up').removeClass('disabled-max-min').removeClass('disabled');
                    break;
                case "Coupon":
                    $(".template_checkout [data-table=cart_table]").trigger("touchspin.on.startdownspin");
                    break;
                case "wishlist":
                    $this.find('svg').toggleClass('text-danger');
                    break;
                case "update":
                    if (data.st == "success")
                        data.red = window.location.href;
                    break;
                default:
                    break;
            }
            if (data.st == "success") {
                if (!data.red && red) {
                    red = (red == "this" ? window.location.href : red);
                    data.red = red;
                }
                var callback = $this.data("callback");
                if (callback) {
                    var x = eval(callback)
                    if (typeof x == 'function') {
                        x()
                    }
                }
                modalOpen(data);
            }
            if (data.template) {
                if (Array.isArray(data.id)) {
                    data.id.forEach(function(v, i) {
                        $(v).html(data.template[i]);
                    });
                } else
                    $(data.id).html(data.template);
            }
            if (data.search_results)
                $("#search_results").text(data.search_results);
            if (block)
                $(block).unblock();
            makeToast(data);
        }, "json").fail(function(jqxhr, textStatus, error) {
            var err = textStatus + ", " + error;
            _log("Request Failed: " + err, 1);
            _log(jqxhr.responseText, 1);
        });
        return ($this.attr("type") == "radio" || $this.attr("type") == "checkbox");
    });
    $("[data-upload]").each(function() {
        $(this).fileUpload();
    });
    $(function() {
        var hash = window.location.hash;
        hash && $('ul.nav a[href="' + hash + '"]').tab('show');
        $('.nav-tabs a,.nav-item a').click(function(e) {
            $(this).tab('show');
            var scrollmem = $('body').scrollTop() || $('html').scrollTop();
            window.location.hash = this.hash;
            $('html,body').scrollTop(scrollmem);
        });
    });
    $("[data-datatable]").each(function() {
        var el = this;
        var btn = $(this).data("btn");
        var rawdata = $(this).data("rawdata");
        var exp = $(this).data("export");
        var columnDefs = [{
            // For Responsive
            className: 'control',
            orderable: false,
            responsivePriority: 2,
            targets: 0
        }];

        var hide_cols = [];
        var cols = [];
        $(this).find("thead").find("th").each(function() {
            if ($(this).text().toLowerCase() != "actions")
                cols.push($(this).index());
        });
        $(this).find("thead tr").prepend("<td></td>");
        $(this).find("tbody tr").prepend("<td></td>");
        $(this).find("[data-hide]").each(function() {
            hide_cols.push($(this).index());
            columnDefs.push({
                targets: $(this).index(),
                visible: false
            });
        });
        var attr = {};
        if (btn) {
            btn = btn.split(",");
            attr = {
                'data-bs-toggle': 'modal',
                'data-bs-target': btn[1]
            };
            if (btn[1].indexOf("http") !== -1) {
                attr = {
                    'onclick': "location.replace('" + btn[1] + "');"
                };
            } else if (btn[1].indexOf("#") === -1) {
                attr = {
                    'data-modal': btn[1]
                };
                if (btn.length > 2)
                    attr["data-center"] = true;
            }
            if (rawdata)
                attr["data-rawdata"] = rawdata;
        }
        $(this).DataTable({
            order: [
                [0, 'desc']
            ],
            fixedHeader: true,
            columnDefs: columnDefs,
            //dom: '<"d-flex justify-content-between align-items-center header-actions text-nowrap mx-1 row mt-75"' + '<"col-sm-12 col-lg-4 d-flex justify-content-center justify-content-lg-start" l>' + '<"col-sm-12 col-lg-8"<"dt-action-buttons d-flex align-items-center justify-content-lg-end justify-content-center flex-md-nowrap flex-wrap"<"me-1"f><"user_role m2t-50 width-200 me-1">B>>' + '><"text-nowrap" t>' + '<"d-flex justify-content-between mx-2 row mb-1"' + '<"col-sm-12 col-md-6"i>' + '<"col-sm-12 col-md-6"p>' + '>',
            // dom: '<"row d-flex justify-content-between align-items-center m-1"<"col-lg-6 d-flex align-items-center"l><"col-lg-6 d-flex align-items-center justify-content-lg-end flex-lg-nowrap flex-wrap pe-lg-1 p-0"f<"invoice_status ms-sm-2"><"dt-action-buttons text-xl-end text-lg-start text-lg-end text-start m2s-2 "B>>>t<"d-flex justify-content-between mx-2 row"<"col-sm-12 col-md-6"i><"col-sm-12 col-md-6"p>>',
            dom: '<"row d-flex justify-content-between align-items-center m-1"<"col-lg-6 d-flex align-items-center p-0"lf><"col-lg-6 d-flex align-items-center justify-content-lg-end justify-content-center flex-lg-nowrap flex-wrap pe-lg-1 p-0"<"invoice_status ms-sm-2"><"dt-action-buttons text-xl-end text-lg-start text-lg-end flex-column flex-lg-row text-start d-flex align-items-center m2s-2 " <"user_role mt-2 mt-lg-0 width-200 me-lg-1 me-0">B>>>t<"d-flex justify-content-between mx-2 row"<"col-sm-12 col-md-6"i><"col-sm-12 col-md-6"p>>',
            //dom: '<"card-header border-bottom p-1"<"head-label"><"dt-action-buttons text-end"B>><"d-flex justify-content-between align-items-center mx-0 row"<"col-sm-12 col-md-6"l><"col-sm-12 col-md-6"f>>t<"d-flex justify-content-between mx-0 row"<"col-sm-12 col-md-6"i><"col-sm-12 col-md-6"p>>',
            displayLength: 7,
            lengthMenu: [7, 10, 25, 50, 75, 100],
            buttons: [{
                text: (btn ? btn[0] : ""),
                className: 'add-new btn btn-primary me-50 m2t-50' + (!btn ? " d-none" : ""),
                attr: attr,
                init: function(api, node, config) {
                    $(node).removeClass('btn-secondary');
                }
            }, {
                extend: 'collection',
                className: 'btn btn-outline-secondary dropdown-toggle' + (!exp ? " d-none" : ""),
                text: feather.icons['share'].toSvg({
                    class: 'font-small-4 me-50'
                }) + _lang['Export'],
                buttons: [{
                    extend: 'print',
                    text: feather.icons['printer'].toSvg({
                        class: 'font-small-4 me-50'
                    }) + _lang['Print'],
                    className: 'dropdown-item',
                    exportOptions: {
                        columns: cols
                    }
                }, {
                    extend: 'csv',
                    text: feather.icons['file-text'].toSvg({
                        class: 'font-small-4 me-50'
                    }) + 'Csv',
                    className: 'dropdown-item',
                    exportOptions: {
                        columns: cols
                    }
                }, {
                    extend: 'excel',
                    text: feather.icons['file'].toSvg({
                        class: 'font-small-4 me-50'
                    }) + 'Excel',
                    className: 'dropdown-item',
                    exportOptions: {
                        columns: cols
                    }
                }, {
                    extend: 'pdf',
                    text: feather.icons['clipboard'].toSvg({
                        class: 'font-small-4 me-50'
                    }) + 'Pdf',
                    className: 'dropdown-item',
                    exportOptions: {
                        columns: cols
                    }
                }, {
                    extend: 'copy',
                    text: feather.icons['copy'].toSvg({
                        class: 'font-small-4 me-50'
                    }) + _lang['Copy'],
                    className: 'dropdown-item',
                    exportOptions: {
                        columns: cols
                    }
                }],
                init: function(api, node, config) {
                    $(node).removeClass('btn-secondary');
                    $(node).parent().removeClass('btn-group');
                    setTimeout(function() {
                        $(node).closest('.dt-buttons').removeClass('btn-group').addClass('d-inline-flex');
                    }, 50);
                }
            }],
            responsive: {
                details: {
                    display: $.fn.dataTable.Responsive.display.modal({
                        header: function(row) {
                            var data = row.data();
                            // _log(data);
                            return _lang['Detailsof'] + " #" + data[1];
                        },
                        dialog: {
                            dialogClass: "modal-dialog-centered"
                        }
                    }),
                    type: 'column',
                    renderer: function(api, rowIdx, columns) {
                        var data = $.map(columns, function(col, i) {
                            //col.data = $(col.data).doFeather();
                            //  console.log(col.data);


                            return col.title !== '' && !hide_cols.includes(col.columnIndex) // ? Do not show row in modal popup if title is blank (for check box)
                                ?
                                '<tr data-dt-row="' + col.rowIdx + '" data-dt-column="' + col.columnIndex + '">' + '<td>' + col.title + ':' + '</td> ' + '<td>' + col.data + '</td>' + '</tr>' : '';
                        }).join('');
                        return data ? $('<table class="table"/>').append('<tbody>' + data + '</tbody>').doFeather() : false;
                    }
                }
            },
            initComplete: function() {
                //  if($(document).find('[data-bs-toggle="tooltip"]').length > 0)
                //   $(document).find('[data-bs-toggle="tooltip"]').tooltip();
                feather.replace({
                    width: 14,
                    height: 14
                });
                var index = $(el).data("index") || -2;
                var $status = $(el).data("status");
                var $SelectStatus = $(el).data("statustext") || _lang["SelectStatus"];
                if ($status)
                    this.api()
                    .columns(index + 1)
                    .every(function() {
                        var column = this;
                        var select = $('<select id="UserRole" class="form-select text-capitalize"><option value="">' + $SelectStatus + '</option></select>')
                            .appendTo('.user_role')
                            .on('change', function() {
                                var val = $.fn.dataTable.util.escapeRegex($(this).val());
                                // console.log(column.data());
                                column.search(val, true, false).draw();
                            });
                        $.map($status, function(v, k) {
                            select.append('<option value="' + v.title + '" class="text-capitalize">' + v.title + '</option>');
                        });
                    });
            },
            drawCallback: function() {
                feather.replace({
                    width: 14,
                    height: 14
                });
                //  if($(document).find('[data-bs-toggle="tooltip"]').length > 0)
                //$(document).find('[data-bs-toggle="tooltip"]').tooltip();
            },
            language: {
                sLengthMenu: _lang["Show"] + " _MENU_",
                search: "",
                zeroRecords: _lang["Nomatching"],
                info: _lang["Showingpage"],
                infoEmpty: _lang["Norecords"],
                infoFiltered: _lang["filtered"],
                searchPlaceholder: _lang["search"],
                paginate: {
                    previous: " ",
                    next: " "
                }
            }
        });
    });
    $(document).on('shown.bs.modal', '.modal', function() {
        $(this).find(".modal-dialog").addClass("modal-dialog-centered");
    });
    $("[data-wizard]").each(function() {
        var checkoutWizard = this;
        var $form = $(this).find('form');
        var wizard = new Stepper(this);
        var msgs = {};
        var rules = {};
        do_validate($form);
        $(this)
            .find('.btn-next')
            .each(function() {
                $(this).on('click', function(e) {
                    var isValid = $(this).closest('form').valid();
                    //console.log(isValid);
                    //var isValid = $(this).parent().siblings('form').valid();
                    if (isValid) {
                        wizard.next();
                    } else {
                        e.preventDefault();
                    }
                });
            });
        $(this)
            .find('.btn-prev')
            .on('click', function(e) {
                //  console.log(e);
                wizard.previous();
            });
    });
    /*  jQuery.validator.setDefaults({
         debug: true
     }); */
    jQuery.validator.addMethod("min", function(value, element, param) {
        value = Number(value.replace(",", ""));
        return this.optional(element) || value >= param;
    });
    jQuery.validator.addMethod("max", function(value, element, param) {
        value = Number(value.replace(",", ""));
        return this.optional(element) || value <= param;
    });

    function do_validate(el) {
        var msgs = {};
        var rules = {};
        $(el).find("input, textarea, select").each(function() {
            if ($(this).attr("name"))
                if ($(this).data("valid") || $(this).data("validmsg") || $(this).data().hasOwnProperty("valid")) {
                    if ($(this).data("validmsg") || $(this).data().hasOwnProperty("valid"))
                        msgs[$(this).attr("name")] = {
                            required: ($(this).data("validmsg") ? $(this).data("validmsg") : _lang["valid"])
                        };
                    if ($(this).attr("type") == "email" && $(this).data("validmsg-email"))
                        msgs[$(this).attr("name")].email = $(this).data("validmsg-email");
                    rules[$(this).attr("name")] = {
                        required: true,
                        email: ($(this).attr("type") == "email"),
                        number: ($(this).attr("type") == "number")
                    };
                    if ($(this).data("validmin"))
                        msgs[$(this).attr("name")].min = $(this).data("validmin");
                    if ($(this).data("validmax"))
                        msgs[$(this).attr("name")].max = $(this).data("validmax");
                }
        });
        _log(rules);
        _log(msgs);
        if (!rules)
            return false;
        return el.validate({
            rules: rules,
            messages: msgs
        });
        return el;
    }
    $(document).ajaxComplete(function() {
        //var el = $(this).find("form");
        // formSubmit(el);
        feather.replace({
            width: 14,
            height: 14
        });
        $('.scrollable-container').each(function() {
            var scrollable_container = new PerfectScrollbar($(this)[0], {
                wheelPropagation: false
            });
        });
    });

    /*    new PerfectScrollbar($("body")[0], {
           wheelPropagation: false
       }); */
    $("body").wrapInner("<div class='bodyScroll' style='overflow:auto;height:100%;position:relative'></div>");
    new PerfectScrollbar($(".bodyScroll")[0], {
        wheelPropagation: false
    });
    jQuery.fn.formSubmit = function() {
        var ar = [];
        if ($(this).tagName() == "form") ar.push(this);
        else $(this).find("form").each(function() {
            ar.push(this);
        });
        ar.forEach(function(el) {
            var $this = $(el);
            if ($this.data("nodata"))
                return false;
            // console.log($(el).tagName());
            var pageLoginForm = do_validate($(el));
            $(el).on("submit", function() {
                if (pageLoginForm)
                    pageLoginForm.destroy();
                do_validate($(this));
                if ($(this).valid()) {
                    var el = this;
                    var id = $(el).attr("id");
                    $(this).find("[type=submit]").attr("disabled", "disabled");
                    if (!id)
                        id = Gapp;
                    if ($(this).data("block"))
                        $($(this).data("block")).block({
                            message: '<div class="spinner-grow spinner-grow-sm text-primary" role="status"></div>',
                            css: {
                                backgroundColor: 'transparent',
                                border: '0'
                            },
                            overlayCSS: {
                                backgroundColor: '#fff',
                                opacity: 0.8
                            }
                        });
                    var red = $(this).data("red");
                    var values = $(this).serialize();
                    // console.log(values);
                    $.ajax({
                        type: "post",
                        url: HOST_URL + "/ajax.php?action=" + id,
                        data: new FormData(this),
                        dataType: "json",
                        processData: false,
                        contentType: false,
                        success: function(data) {
                            _log(data);
                            if ($this.data("block"))
                                $($this.data("block")).unblock();
                            if (data.st == "success") {
                                if (red) {
                                    red = (red == "this" ? window.location.href : red);
                                    data.red = red;
                                }
                                var callback = $this.data("callback");
                                if (callback) {
                                    var x = eval(callback)
                                    if (typeof x == 'function') {
                                        x()
                                    }
                                }
                                if ($this.data("msg"))
                                    data.msg = $this.data("msg");
                                if (data.template) {
                                    if (Array.isArray(data.id)) {
                                        data.id.forEach(function(v, i) {
                                            $(v).html(data.template[i]);
                                        });
                                    } else
                                        $(data.id).html(data.template);
                                }
                                if (data.hide) {
                                    $(data.hide).modal("hide");
                                }
                            } else {
                                _log(data, 1);
                            }
                            $(el).find("[type=submit]").removeAttr("disabled");
                            makeToast(data);
                        },
                        error: function(xhr, status, error) {
                            _log("error: " + xhr.responseText, 1);
                        }
                    });
                }
                return false;
            }).on("reset", function() {
                location.reload();
            });
        });
    }
    $("form").each(function() {
        $(this).formSubmit();
    });
    <?php if ($_msg) {
        if (is_array($_msg))
            $_msg = json_encode($_msg);
        else
            $_msg = json_encode(["st" => "info", "msg" => $_msg]);
    ?>
        var data = <?= $_msg ?>;
        // print_r(data);
        makeToast(data);
    <?php  } ?>
</script>
<script>
    window.OneSignal = window.OneSignal || [];
    OneSignal.push(function() {
        OneSignal.init({
            appId: "30be48c4-ad2c-4989-adeb-3c14667ec40c",
            safari_web_id: "web.onesignal.auto.54d60a3d-c0d7-4ae1-b490-c29a9cfa7b70",
            notifyButton: {
                enable: false,
            },
            welcomeNotification: {
                title: _St["title"],
                message: _lang["push"],
            }
        });
        OneSignal.setDefaultNotificationUrl(_St["url"]);
        OneSignal.push(["getNotificationPermission", function(permission) {
            console.log("Site Notification Permission:", permission);
            if (permission == "default" && _login.id && !getCookie("push_cancel")) {
                setTimeout(() => {
                    makeAlert({
                        st: "info",
                        title: _lang["sendnotifications"],
                        msg: _lang["sendnotificationsD"],
                        iconHtml: "<i data-feather='bell'></i>",
                        callback: () => {
                            OneSignal.showNativePrompt();
                        },
                        callback_cancel: () => {
                            setCookie("push_cancel", 1, 1);
                        }
                    });
                }, 2000);
            }
        }]);
        OneSignal.on('permissionPromptDisplay', function() {
            console.log("The prompt displayed");
        });

        OneSignal.on('notificationPermissionChange', function(permissionChange) {
            var currentPermission = permissionChange.to;
            console.log(permissionChange);
            console.log('New permission state:', currentPermission);
        });
        if (_login) {
            OneSignal.on('subscriptionChange', function(isSubscribed) {
                if (isSubscribed) {
                    OneSignal.getUserId(function(userId) {
                        $.post(HOST_URL + "/ajax.php", {
                            action: "update",
                            id: _login["id"],
                            update: {
                                "push_id": userId
                            },
                            add: ",",
                            table: "login"
                        }, function(d) {});
                    });
                }
                console.log("The user's subscription state is now:", isSubscribed);
            });
        }
    });
</script>
</body>
<!-- END: Body-->

</html>