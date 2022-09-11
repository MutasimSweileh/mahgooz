<section id="statistics-card">
    <!-- Stats Horizontal Card -->
    <?
    $owhere = "";
    $where = "where user_id=" . $_login->id;
    $orders = getUser("orders", $owhere);
    $products = getUser("products", $where);
    $support = getUser("support", $where);
    $payments = getUser("payments", $where);
    $ordersp = getPages("orders", false)["title" . $clang];
    $p = ["p" => 0, "t" => 0, "ft" => 0, "r" => 0, "d" => 0, "o" => 0];
    $filter_orders = [];
    array_map(function ($v) use (&$p, $_login, &$filter_orders, &$St) {
        $pr = getUser("orders_products", "where order_id=" . $v["id"]);
        if ($pr) {
            $pr2 = 0;
            foreach ($pr as $v2) {
                $pr2 = selaa("products", "where id=" . $v2["product_id"] . " and user_id=" . $_login->id);
                if ($pr2) {
                    $pr2["price"] =  ($pr2["price"] - (($St->commission * $pr2["price"]) / 100)) * $v2["amount"];
                    //$pr2["price"] -=  (($St->commission * $pr2["price"]) / 100) * $v2["amount"];

                    switch ($v["status"]) {
                        case 0:
                        case 4:
                            $p["p"] += $pr2["price"];
                            break;
                        case 2:
                            $p["r"] += $pr2["price"];
                            break;
                        case 3:
                            $p["t"] += $pr2["price"];
                            $p["d"] += $pr2["price"];
                            break;
                        default:
                            $p["ft"] += $pr2["price"];
                            break;
                    }
                }
            }
            if ($pr2) {
                $p["o"] += 1;
                $filter_orders[] = $v;
            }
        }
    }, $orders);
    $orders = $filter_orders;
    ?>
    <div class="row">

        <div class="col-xl col-md-4 col-sm-6">
            <div class="card text-center">
                <div class="card-body">
                    <div class="avatar bg-light-primary p-50 m-1">
                        <div class="avatar-content">
                            <i data-feather="grid" class="font-medium-5"></i>
                        </div>
                    </div>
                    <div>
                        <h2 class="fw-bolder"><?= number_format(count($products)) ?></h2>
                        <p class="card-text"><?= $_lang["Totalproducts"] ?></p>
                    </div>

                </div>
            </div>
        </div>
        <div class="col-xl col-md-4 col-sm-6">
            <div class="card text-center">
                <div class="card-body">
                    <div class="avatar bg-light-danger p-50 m-1">
                        <div class="avatar-content">
                            <i data-feather="server" class="font-medium-5"></i>
                        </div>
                    </div>
                    <div>
                        <h2 class="fw-bolder"><?= number_format(count($orders)) ?></h2>
                        <p class="card-text"><?= $_lang["Totalorders"] ?></p>
                    </div>

                </div>
            </div>
        </div>
        <div class="col-xl col-md-4 col-sm-6">
            <div class="card text-center">
                <div class="card-body">
                    <div class="avatar bg-light-success p-50 m-1">
                        <div class="avatar-content">
                            <span class="font-medium-2"><?= $_lang["currency"] ?></span>
                        </div>
                    </div>
                    <div>
                        <h2 class="fw-bolder">
                            <!-- <span class="text-danger"><?= number_format($p["ft"]) ?></span> / --> <span class="text-success2"><?= number_format($p["t"]) ?></span>
                        </h2>
                        <p class="card-text"><?= $_lang["Totalcommissionsuser"] ?></p>
                    </div>

                </div>
            </div>
        </div>
        <div class="col-xl col-md-4 col-sm-6">
            <div class="card text-center">
                <div class="card-body">
                    <div class="avatar bg-light-warning p-50 m-1">
                        <div class="avatar-content">
                            <i data-feather="alert-octagon" class="font-medium-5"></i>
                        </div>
                    </div>
                    <div>
                        <h2 class="fw-bolder"><?= number_format($p["p"]) ?></h2>
                        <p class="card-text"><?= $_lang["pendingbalance"] ?></p>
                    </div>

                </div>
            </div>
        </div>


        <div class="col-xl col-md-4 col-sm-6">
            <div class="card text-center">
                <div class="card-body">
                    <div class="avatar bg-light-success p-50 m-1">
                        <div class="avatar-content">
                            <i class="fas fa-money-bill font-medium-5"></i>
                        </div>
                    </div>
                    <div>
                        <h2 class="fw-bolder"><?= number_format($_login->money) ?></h2>
                        <p class="card-text"><?= $_lang["AvailableBalance"] ?></p>
                    </div>

                </div>
            </div>
        </div>


    </div>
    <div class="row">
        <?
        $p = count(array_filter($support, function ($v) use ($_login) {
            return !$v[($_login->role == 1 ? "" : "u") . "read"];
        }));
        $o = count(array_filter($support, function ($v) {
            return !$v["status"];
        }));
        $c = count(array_filter($support, function ($v) {
            return $v["status"] == 2;
        }));
        $data = count($support); ?>
        <!-- Support Tracker Chart Card starts -->
        <div class="col-lg-6 col-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between pb-0">
                    <h4 class="card-title"><?= $_lang["Support"] ?></h4>
                    <div class="dropdown chart-dropdown d-none">
                        <button class="btn btn-sm border-0 dropdown-toggle p-50" type="button" id="dropdownItem4" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Last 7 Days
                        </button>
                        <div class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownItem4">
                            <a class="dropdown-item" href="#">Last 28 Days</a>
                            <a class="dropdown-item" href="#">Last Month</a>
                            <a class="dropdown-item" href="#">Last Year</a>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-sm-2 col-12 d-flex flex-column flex-wrap text-center">
                            <h1 class="font-large-2 fw-bolder mt-2 mb-0"><?= $data ?></h1>
                            <p class="card-text"><?= $_lang["Tickets"] ?></p>
                        </div>
                        <div class="col-sm-10 col-12 d-flex justify-content-center">
                            <div data-done="<?= ($c ? ceil(($c / $data) * 100) : "0")  ?>" id="support-trackers-chart"></div>
                        </div>
                    </div>
                    <div class="d-flex justify-content-between mt-1">
                        <div class="text-center">
                            <p class="card-text mb-50"><?= $_lang["New Tickets"] ?></p>
                            <span class="font-large-1 fw-bold"><?= $p ?></span>
                        </div>
                        <div class="text-center">
                            <p class="card-text mb-50"><?= $_lang["Open Tickets"] ?></p>
                            <span class="font-large-1 fw-bold"><?= $o ?></span>
                        </div>
                        <div class="text-center">
                            <p class="card-text mb-50"><?= $_lang["Closed Tickets"] ?></p>
                            <span class="font-large-1 fw-bold"><?= $c ?></span>
                        </div>

                    </div>
                </div>
            </div>
        </div>
        <?

        $o = count(array_filter($support, function ($v) {
            return !$v["status"];
        }));
        $c = count(array_filter($support, function ($v) {
            return $v["status"] == 1;
        }));
        $data = count($payments); ?>
        <!-- Support Tracker Chart Card ends -->
        <div class="col-lg-6 col-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h4 class="card-title"><?= $_lang["Moneyrequests"] ?></h4>
                    <i data-feather="help-circle" class="font-medium-3 text-muted cursor-pointer"></i>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-sm-2 col-12 d-flex flex-column flex-wrap text-center">
                            <h1 class="font-large-2 fw-bolder mt-2 mb-0"><?= $data ?></h1>
                            <p class="card-text"><?= $_lang["Total"] ?></p>
                        </div>
                        <div class="col-sm-10 col-12 d-flex justify-content-center">
                            <div data-done="<?= ($c ? ceil(($c / $data) * 100) : "0")  ?>" id="goal-overview-chart"></div>
                        </div>
                    </div>

                    <div class="row border-top text-center mx-0 mt-1">
                        <div class="col-6 border-end py-1">
                            <p class="card-text text-muted mb-0"><?= $_lang["Completed"] ?></p>
                            <h3 class="fw-bolder mb-0"><?= $c ?></h3>
                        </div>
                        <div class="col-6 py-1">
                            <p class="card-text text-muted mb-0"><?= $_lang["In Progress"] ?></p>
                            <h3 class="fw-bolder mb-0"><?= $o ?></h3>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--/ Goal Overview Card -->
    </div>
    <!--/ Stats Horizontal Card -->
    <div class="row match-height">
        <!-- Revenue Card -->
        <?php
        $data = $orders;
        $day_this_month  = date("d");
        $lmonth  = date("m", strtotime("-1 month"));
        //echo strtotime('14-08-2021');
        $days = [];
        $thismonth = array();
        $lastmonth = array();
        $lastmonthTotal = 0;
        $thismonthTotal = 0;
        for ($i = 0; $i < $day_this_month; $i++) {
            $user = 0;
            $luser = 0;
            $day = (($i + 1) < 10 ? "0" . ($i + 1) : ($i + 1));
            for ($y = 0; $y < count($data); $y++) {
                if (date("Y-m-d", $data[$y]["date"]) == date("Y-m-" . $day) && $data[$y]["status"] == 3) {
                    // $user += $data[$y]["total"];
                    $pr = getUser("orders_products", "where order_id=" . $data[$y]["id"]);
                    if ($pr) {
                        foreach ($pr as $v) {
                            $pr2 = selaa("products", "where id=" . $v["product_id"] . " ");
                            if ($pr2) {
                                $pr2["price"] -= ($pr2["price"] - (($St->commission * $pr2["price"]) / 100)) *  $v["amount"];
                                //  $pr2["price"] -=  (($St->commission * $pr2["price"]) / 100) * $v["amount"];
                                $user += $pr2["price"];
                            }
                        }
                    }
                }
                if (date("Y-m-d", $data[$y]["date"]) == date("Y-" . $lmonth . "-" . $day) && $data[$y]["status"] == 3) {
                    $pr = getUser("orders_products", "where order_id=" . $data[$y]["id"]);
                    if ($pr) {
                        foreach ($pr as $v) {
                            $pr2 = selaa("products", "where id=" . $v["product_id"] . " ");
                            if ($pr2) {
                                //$pr2["price"] -= $pr2["add_price"];
                                $pr2["price"] -= ($pr2["price"] - (($St->commission * $pr2["price"]) / 100)) *  $v["amount"];
                                $luser += $pr2["price"];
                            }
                        }
                    }
                }
            }
            $days[] = $day;
            $thismonthTotal += $user;
            $lastmonthTotal += $luser;
            $thismonth[] = $user;
            $lastmonth[] = $luser;
        }
        ?>
        <div class="col-lg-8 col-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h4 class="card-title"><?= $_lang["Revenue"] ?></h4>
                    <i data-feather="settings" class="font-medium-3 text-muted cursor-pointer"></i>
                </div>
                <div class="card-body">
                    <div class="d-flex justify-content-start mb-3">
                        <div class="me-2">
                            <p class="card-text mb-50"><?= $_lang["ThisMonth"] ?></p>
                            <h3 class="fw-bolder">
                                <sup class="font-medium-1 fw-bold"><?= $_lang["currency"] ?></sup>
                                <span class="text-primary"><?= number_format($thismonthTotal) ?></span>
                            </h3>
                        </div>
                        <div>
                            <p class="card-text mb-50"><?= $_lang["LastMonth"] ?></p>
                            <h3 class="fw-bolder">
                                <sup class="font-medium-1 fw-bold"><?= $_lang["currency"] ?></sup>
                                <span><?= number_format($lastmonthTotal) ?></span>
                            </h3>
                        </div>
                    </div>
                    <div id="revenue-chart" data-lastmonth='<?= json_encode($lastmonth) ?>' data-thismonth='<?= json_encode($thismonth) ?>' data-catjson='<?= json_encode($days) ?>'></div>
                </div>
            </div>
        </div>
        <!--/ Revenue Card -->

        <!-- Sales Polygon Chart Card -->
        <div class="col-lg-4 col-12">
            <?
            $p = count(array_filter($orders, function ($v) {
                return !$v["status"];
            }));
            $d = count(array_filter($orders, function ($v) {
                return $v["status"] == 3;
            }));
            $r = count(array_filter($orders, function ($v) {
                return $v["status"] == 2;
            }));
            $data = count($orders);
            ?>
            <div class="card">
                <div class="card-header d-flex justify-content-between">
                    <h4 class="card-title"><?= $ordersp ?></h4>
                    <div class="dropdown chart-dropdown d-none">
                        <button class="btn btn-sm border-0 dropdown-toggle px-50" type="button" id="dropdownItem2" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Last 7 Days
                        </button>
                        <div class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownItem2">
                            <a class="dropdown-item" href="#">Last 28 Days</a>
                            <a class="dropdown-item" href="#">Last Month</a>
                            <a class="dropdown-item" href="#">Last Year</a>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div id="product-order-chart" dir="rtl" data-total="<?= $data ?>" data-refunded="<?= ceil(($r / $data) * 100) ?>" data-pending="<?= ceil(($p / $data) * 100) ?>" data-finished="<?= ceil(($d / $data) * 100) ?>"> </div>
                    <div class="d-flex justify-content-between mb-1">
                        <div class="d-flex align-items-center">
                            <i data-feather="circle" class="font-medium-1 text-primary"></i>
                            <span class="fw-bold ms-75"><?= $_lang["Done"] ?></span>
                        </div>
                        <span><?= number_format($d) ?></span>
                    </div>
                    <div class="d-flex justify-content-between mb-1">
                        <div class="d-flex align-items-center">
                            <i data-feather="circle" class="font-medium-1 text-warning"></i>
                            <span class="fw-bold ms-75"><?= $_lang["Pending"] ?></span>
                        </div>
                        <span><?= number_format($p) ?></span>
                    </div>
                    <div class="d-flex justify-content-between">
                        <div class="d-flex align-items-center">
                            <i data-feather="circle" class="font-medium-1 text-danger"></i>
                            <span class="fw-bold ms-75"><?= $_lang["Refunded"] ?></span>
                        </div>
                        <span><?= number_format($r) ?></span>
                    </div>
                </div>
            </div>
        </div>
        <!--/ Product Order Card -->

    </div>
</section>