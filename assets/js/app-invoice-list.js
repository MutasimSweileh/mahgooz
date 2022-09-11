/*=========================================================================================
    File Name: app-invoice-list.js
    Description: app-invoice-list Javascripts
    ----------------------------------------------------------------------------------------
    Item Name: Vuexy  - Vuejs, HTML & Laravel Admin Dashboard Template
   Version: 1.0
    Author: PIXINVENT
    Author URL: http://www.themeforest.net/user/pixinvent
==========================================================================================*/
String.prototype.initials = function () {
    var initials = "";
    var name = this;
    var wordArray = name.split(" ");
    for (var i = 0; i < wordArray.length; i++) {
        initials += " " + wordArray[i].substring(0, 1);
    }
    return initials;
}
$(function () {
    'use strict';

    var dtInvoiceTable = $('.datatables-basic'),
        invoicePreview = 'javascript:;';
    if (dtInvoiceTable.length) {
        var columns = [];
        dtInvoiceTable.find("th").each(function () {
            columns.push({ data: $(this).data("id") });
        });
        $.post(HOST_URL + "/ajax.php", { id: dtInvoiceTable.data("id"), "action": "_get" }, function (data) {
            var dt_basic = dtInvoiceTable.DataTable({
                //  ajax: HOST_URL+'/ajax.php?action=get_orders',
                data: data.data,
                columns: columns,
                columnDefs: [{
                    // For Responsive
                    className: 'control',
                    orderable: false,
                    responsivePriority: 2,
                    targets: 0
                }, {
                    // Invoice ID
                    targets: 1,
                    width: '46px',
                    render: function (data, type, full, meta) {
                        var $invoiceId = full['id'];
                        // Creates full output for row
                        var $rowOutput = '<a class="fw-bold" href="' + invoicePreview + '"> ' + $invoiceId + '</a>';
                        return $rowOutput;
                    }
                }, {
                    // Avatar image/badge, Name and post
                    targets: 2,
                    responsivePriority: 1,
                    render: function (data, type, full, meta) {

                        var $name = full['fullname'],
                            $post = full['area'] + " - " + full['city'];
                        var stateNum = full['status'];
                        var states = ['warning', 'dark', 'danger', 'success'];
                        var $state = states[stateNum], $initials = $name.initials();
                        var $output = '<span class="avatar-content">' + $initials + '</span>';
                        var colorClass = ' bg-light-' + $state + ' ';
                        var $row_output = '<div class="d-flex justify-content-left align-items-center">' + '<div class="avatar ' + colorClass + ' me-1">' + $output + '</div>' + '<div class="d-flex flex-column">' + '<span class="emp_name text-truncate fw-bold">' + $name + '</span>' + '<small class="emp_post text-truncate text-muted">' + $post + '</small>' + '</div>' + '</div>';
                        return $row_output;
                    }
                },
                {
                    targets: 4,
                    render: function (data, type, full, meta) {
                        if (type != 'display')
                            return data;
                        var $dueDate = Number(full['date']) * 1000;
                        return moment($dueDate).format('DD/MM/YYYY');
                    }
                }, {
                    responsivePriority: 4,
                    targets: 3
                }, {
                    // Label
                    targets: -2,
                    render: function (data, type, full, meta) {
                        if (type != 'display')
                            return data;
                        var $status_number = full['status'];
                        var $status = {
                            1: {
                                title: _lang["Canceled"],
                                class: 'badge-light-dark'
                            },
                            3: {
                                title: _lang['Done'],
                                class: ' badge-light-success'
                            },
                            2: {
                                title: _lang['Refunded'],
                                class: ' badge-light-danger'
                            },
                            0: {
                                title: _lang['Pending'],
                                class: ' badge-light-warning'
                            }
                        };
                        if (typeof $status[$status_number] === 'undefined') {
                            return data;
                        }
                        return ('<span class="badge rounded-pill ' + $status[$status_number].class + '">' + $status[$status_number].title + '</span>');
                    }
                }, {
                    // Actions
                    targets: -1,
                    orderable: false,
                    render: function (data, type, full, meta) {
                        return ('<div class="text-center">' + '<a href="' + dtInvoiceTable.data("page") + full["id"] + '" data-bs-toggle="tooltip" data-bs-placement="top" title="' + _lang["order-preview"] + '" class="item-edit me-1">' + feather.icons['eye'].toSvg({
                            class: 'font-medium-2 text-body'
                        }) + '</a>' + '<a href="javasript:;" data-bs-toggle="tooltip" data-bs-placement="top" data-index="' + meta.row + '" data-id="' + full["id"] + '" title="' + _lang["cancel-order"] + '" data-action="cancel-order" class="item-edit ' + (full["status"] != "0" ? "d-none" : "") + '">' + feather.icons['trash-2'].toSvg({
                            class: 'font-medium-2 text-body'
                        }) + '</a></div>');
                    }
                }],
                order: [
                    [1, 'desc']
                ],
                //dom: '<"d-flex justify-content-between align-items-center header-actions text-nowrap mx-1 row mt-75"' + '<"col-sm-12 col-lg-4 d-flex justify-content-center justify-content-lg-start" l>' + '<"col-sm-12 col-lg-8"<"dt-action-buttons d-flex align-items-center justify-content-lg-end justify-content-center flex-md-nowrap flex-wrap"<"me-1"f><"user_role m2t-50 width-200 me-1">B>>' + '><"text-nowrap" t>' + '<"d-flex justify-content-between mx-2 row mb-1"' + '<"col-sm-12 col-md-6"i>' + '<"col-sm-12 col-md-6"p>' + '>',
                dom: '<"d-flex justify-content-between align-items-center header-actions text-nowrap mx-1 row mt-75"' + '<"col-sm-12 col-lg-4 d-flex justify-content-center justify-content-lg-start" lf>' + '<"col-sm-12 col-lg-8"<"dt-action-buttons d-flex align-items-center justify-content-lg-end justify-content-center flex-md-nowrap flex-wrap3"<"user_role m2t-50 width-200 me-0 me-lg-1">B>>' + '><"text-nowrap" t>' + '<"d-flex justify-content-between mx-2 row mb-1"' + '<"col-sm-12 col-md-6"i>' + '<"col-sm-12 col-md-6"p>' + '>',

                // dom: '<"row d-flex justify-content-between align-items-center m-1"<"col-lg-6 d-flex align-items-center"l><"col-lg-6 d-flex align-items-center justify-content-lg-end flex-lg-nowrap flex-wrap pe-lg-1 p-0"f<"invoice_status ms-sm-2"><"dt-action-buttons text-xl-end text-lg-start text-lg-end text-start ms-2 "B>>>t<"d-flex justify-content-between mx-2 row"<"col-sm-12 col-md-6"i><"col-sm-12 col-md-6"p>>',
                //dom: '<"card-header border-bottom p-1"<"head-label"><"dt-action-buttons text-end"B>><"d-flex justify-content-between align-items-center mx-0 row"<"col-sm-12 col-md-6"l><"col-sm-12 col-md-6"f>>t<"d-flex justify-content-between mx-0 row"<"col-sm-12 col-md-6"i><"col-sm-12 col-md-6"p>>',
                displayLength: 7,
                lengthMenu: [7, 10, 25, 50, 75, 100],
                buttons: [{
                    extend: 'collection',
                    className: 'btn btn-outline-secondary dropdown-toggle',
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
                            columns: [3, 4, 5, 6, 7]
                        }
                    }, {
                        extend: 'csv',
                        text: feather.icons['file-text'].toSvg({
                            class: 'font-small-4 me-50'
                        }) + 'Csv',
                        className: 'dropdown-item',
                        exportOptions: {
                            columns: [3, 4, 5, 6, 7]
                        }
                    }, {
                        extend: 'excel',
                        text: feather.icons['file'].toSvg({
                            class: 'font-small-4 me-50'
                        }) + 'Excel',
                        className: 'dropdown-item',
                        exportOptions: {
                            columns: [3, 4, 5, 6, 7]
                        }
                    }, {
                        extend: 'pdf',
                        text: feather.icons['clipboard'].toSvg({
                            class: 'font-small-4 me-50'
                        }) + 'Pdf',
                        className: 'dropdown-item',
                        exportOptions: {
                            columns: [3, 4, 5, 6, 7]
                        }
                    }, {
                        extend: 'copy',
                        text: feather.icons['copy'].toSvg({
                            class: 'font-small-4 me-50'
                        }) + _lang['Copy'],
                        className: 'dropdown-item',
                        exportOptions: {
                            columns: [3, 4, 5, 6, 7]
                        }
                    }],
                    init: function (api, node, config) {
                        $(node).removeClass('btn-secondary');
                        $(node).parent().removeClass('btn-group');
                        setTimeout(function () {
                            $(node).closest('.dt-buttons').removeClass('btn-group').addClass('d-inline-flex');
                        }, 50);
                    }
                }],
                responsive: {
                    details: {
                        display: $.fn.dataTable.Responsive.display.modal({
                            header: function (row) {
                                var data = row.data();
                                return _lang['Detailsof'] + " #" + data['id'];
                            }
                        }),
                        type: 'column',
                        renderer: function (api, rowIdx, columns) {
                            var data = $.map(columns, function (col, i) {
                                return col.title !== '' // ? Do not show row in modal popup if title is blank (for check box)
                                    ?
                                    '<tr data-dt-row="' + col.rowIdx + '" data-dt-column="' + col.columnIndex + '">' + '<td>' + col.title + ':' + '</td> ' + '<td>' + col.data + '</td>' + '</tr>' : '';
                            }).join('');

                            return data ? $('<table class="table"/>').append('<tbody>' + data + '</tbody>') : false;
                        }
                    }
                }, initComplete: function () {
                    $(document).find('[data-bs-toggle="tooltip"]').tooltip();
                    // Adding role filter once table initialized
                    var $status = {
                        1: {
                            title: _lang["Canceled"],
                            class: 'badge-light-dark'
                        },
                        3: {
                            title: _lang['Done'],
                            class: ' badge-light-success'
                        },
                        2: {
                            title: _lang['Refunded'],
                            class: ' badge-light-danger'
                        },
                        0: {
                            title: _lang['Pending'],
                            class: ' badge-light-warning'
                        }
                    };
                    this.api()
                        .columns(6)
                        .every(function () {
                            var column = this;
                            var select = $('<select id="UserRole" class="form-select ms-50 text-capitalize"><option value="">' + _lang["SelectStatus"] + '</option></select>')
                                .appendTo('.user_role')
                                .on('change', function () {
                                    var val = $.fn.dataTable.util.escapeRegex($(this).val());
                                    //console.log(val);
                                    column.search(val, true, false).draw();
                                });

                            column.data()
                                .unique()
                                .sort()
                                .each(function (d, j) {
                                    select.append('<option value="' + d + '" class="text-capitalize">' + $status[d].title + '</option>');
                                });
                        });
                },
                drawCallback: function () {
                    $(document).find('[data-bs-toggle="tooltip"]').tooltip()
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
        }, "json");
    }


});
