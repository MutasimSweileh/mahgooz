$(window).on('load', function () {
    'use strict';

    var $textHeadingColor = '#5e5873';
    var $strokeColor = '#ebe9f1';
    var $labelColor = '#e7eef7';
    var $avgSessionStrokeColor2 = '#ebf0f7';
    var $budgetStrokeColor2 = '#dcdae3';
    var $goalStrokeColor2 = '#51e5a8';
    var $revenueStrokeColor2 = '#d0ccff';
    var $textMutedColor = '#b9b9c3';
    var $salesStrokeColor2 = '#df87f2';
    var $white = '#fff';
    var $earningsStrokeColor2 = '#28c76f66';
    var $earningsStrokeColor3 = '#28c76f33';
    var $productOrderChart = $('#product-order-chart');
    var $revenueChart = $('#revenue-chart');
    var $supportTrackerChart = $('#support-trackers-chart');
    var $goalOverviewChart = $('#goal-overview-chart');
    var supportTrackerChartOptions;
    var goalOverviewChartOptions;
    var goalOverviewChart;
    var supportTrackerChart;
    // Support Tracker Chart
    // -----------------------------
    supportTrackerChartOptions = {
        chart: {
            height: 270,
            type: 'radialBar'
        },
        plotOptions: {
            radialBar: {
                size: 150,
                offsetY: 20,
                startAngle: -150,
                endAngle: 150,
                hollow: {
                    size: '65%'
                },
                track: {
                    background: $white,
                    strokeWidth: '100%'
                },
                dataLabels: {
                    name: {
                        offsetY: -5,
                        color: $textHeadingColor,
                        fontSize: '1rem'
                    },
                    value: {
                        offsetY: 15,
                        color: $textHeadingColor,
                        fontSize: '1.714rem'
                    }
                }
            }
        },
        colors: [window.colors.solid.danger],
        fill: {
            type: 'gradient',
            gradient: {
                shade: 'dark',
                type: 'horizontal',
                shadeIntensity: 0.5,
                gradientToColors: [window.colors.solid.primary],
                inverseColors: true,
                opacityFrom: 1,
                opacityTo: 1,
                stops: [0, 100]
            }
        },
        stroke: {
            dashArray: 8
        },
        series: [$supportTrackerChart.data("done")],
        labels: [_lang["CompletedTickets"]]
    };
    if ($supportTrackerChart.length > 0) {
        supportTrackerChart = new ApexCharts($supportTrackerChart.get(0), supportTrackerChartOptions);
        supportTrackerChart.render();
    }
    //------------ Goal Overview Chart ------------
    //---------------------------------------------
    goalOverviewChartOptions = {
        chart: {
            height: 270,
            type: 'radialBar',
            sparkline: {
                enabled: true
            },
            dropShadow: {
                enabled: true,
                blur: 3,
                left: 1,
                top: 1,
                opacity: 0.1
            }
        },
        colors: [$goalStrokeColor2],
        plotOptions: {
            radialBar: {
                offsetY: -10,
                startAngle: -150,
                endAngle: 150,
                hollow: {
                    size: '77%'
                },
                track: {
                    background: $strokeColor,
                    strokeWidth: '50%'
                },
                dataLabels: {
                    name: {
                        show: false
                    },
                    value: {
                        color: $textHeadingColor,
                        fontSize: '2.86rem',
                        fontWeight: '600'
                    }
                }
            }
        },
        fill: {
            type: 'gradient',
            gradient: {
                shade: 'dark',
                type: 'horizontal',
                shadeIntensity: 0.5,
                gradientToColors: [window.colors.solid.success],
                inverseColors: true,
                opacityFrom: 1,
                opacityTo: 1,
                stops: [0, 100]
            }
        },
        series: [$goalOverviewChart.data("done")],
        stroke: {
            lineCap: 'round'
        },
        grid: {
            padding: {
                bottom: 30
            }
        }
    };
    if ($goalOverviewChart.length > 0) {
        goalOverviewChart = new ApexCharts($goalOverviewChart.get(0), goalOverviewChartOptions);
        goalOverviewChart.render();
    }
    // Product Order Chart
    // -----------------------------
    var orderChartOptions = {
        chart: {
            height: 325,
            type: 'radialBar',

        },
        colors: [window.colors.solid.primary, window.colors.solid.warning, window.colors.solid.danger],
        stroke: {
            lineCap: 'round'
        },
        plotOptions: {
            radialBar: {
                size: 150,
                hollow: {
                    size: '20%'
                },
                track: {
                    strokeWidth: '100%',
                    margin: 15
                },
                dataLabels: {
                    value: {
                        fontSize: '1rem',
                        colors: $textHeadingColor,
                        fontWeight: '500',
                        offsetY: 5
                    },
                    total: {
                        show: true,
                        label: _lang["Total"],
                        fontSize: '1.286rem',
                        direction: "rtl",
                        fontFamily: 'Tajawal',
                        colors: $textHeadingColor,
                        letterSpacing: "normal",
                        fontWeight: '500',

                        formatter: function (w) {
                            // By default this function returns the average of all series. The below is just an example to show the use of custom formatter function
                            return $productOrderChart.data("total");
                        }
                    }
                }
            }
        },
        series: [$productOrderChart.data("finished"), $productOrderChart.data("pending"), $productOrderChart.data("refunded")],
        labels: [_lang['Done'], _lang['Pending'], _lang['Refunded']],
    };
    if ($productOrderChart.length > 0) {
        var orderChart = new ApexCharts($productOrderChart.get(0), orderChartOptions);
        orderChart.render();
    }
    // Revenue  Chart
    // -----------------------------
    var revenueChartOptions = {
        chart: {
            height: 240,
            toolbar: {
                show: false
            },
            zoom: {
                enabled: false
            },
            type: 'line',
            offsetX: -10
        },
        stroke: {
            curve: 'smooth',
            dashArray: [0, 12],
            width: [4, 3]
        },
        grid: {
            borderColor: $labelColor
        },
        legend: {
            show: false
        },
        colors: [$revenueStrokeColor2, $strokeColor],
        fill: {
            type: 'gradient',
            gradient: {
                shade: 'dark',
                inverseColors: false,
                gradientToColors: [window.colors.solid.primary, $strokeColor],
                shadeIntensity: 1,
                type: 'horizontal',
                opacityFrom: 1,
                opacityTo: 1,
                stops: [0, 100, 100, 100]
            }
        },
        markers: {
            size: 0,
            hover: {
                size: 5
            }
        },
        xaxis: {
            labels: {
                style: {
                    colors: $textMutedColor,
                    fontSize: '1rem',

                }
            },
            axisTicks: {
                show: false
            },
            categories: $revenueChart.data("catjson"),
            axisBorder: {
                show: false
            },
            tickPlacement: 'on'
        },
        yaxis: {
            tickAmount: 5,
            labels: {
                style: {
                    colors: $textMutedColor,
                    fontSize: '1rem',

                },
                formatter: function (val) {
                    var formatter = new Intl.NumberFormat();
                    return formatter.format(val).replace(_lang["currency"], "") + " " + _lang["currency"];
                    return val > 999 ? (val / 1000).toFixed(0) + 'k' : val;
                }
            }
        },
        grid: {
            padding: {
                top: -20,
                bottom: -10,
                left: 20
            }
        },
        tooltip: {
            x: {
                show: false
            }
        },
        series: [{
            name: _lang["ThisMonth"],
            data: $revenueChart.data("thismonth")
        }, {
            name: _lang["LastMonth"],
            data: $revenueChart.data("lastmonth")
        }]
    };
    if ($revenueChart.length > 0) {
        var revenueChart = new ApexCharts($revenueChart.get(0), revenueChartOptions);
        revenueChart.render();
    }

});