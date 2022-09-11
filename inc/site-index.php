<section id="statistics-card">
    <!-- Stats Horizontal Card -->
    <?
    $where = "";
    $owhere = "";

    $orders = getUser("orders", $owhere);
    $products = getUser("products", $where);
    $sproducts = array_filter($products, function ($v) {
        return $v["user_id"];
    });
    $users = getUser("login", "");
    $support = getUser("support", $where);
    $payments = getUser("payments", $where);
    $ordersp = getPages("orders", false)["title" . $clang];
    $p = ["p" => 0, "t" => 0, "r" => 0, "d" => 0, "s" => 0, "f" => 0, "fr" => 0, "fs" => 0];
    array_map(function ($v) use (&$p, &$St) {

        switch ($v["status"]) {
            case 0:
            case 4:
                $p["p"] += $v["commission"];
                break;
            case 3:
                $p["d"] += $v["commission"];
                $p["t"] += $v["commission"];
                $pr = getUser("orders_products", "where order_id=" . $v["id"]);
                if ($pr) {
                    foreach ($pr as $v2) {
                        $pr2 = selaa("products", "where id=" . $v2["product_id"] . " ");
                        if ($pr2)
                            if ($pr2["user_id"]) {
                                $p["r"] +=  (($St->commission * $pr2["price"]) / 100) * $v2["amount"];
                                $p["s"] +=  ($pr2["price"]  - (($St->commission * $pr2["price"]) / 100)) * $v2["amount"];
                            } else
                                $p["r"] += $pr2["add_price"];
                    }
                }
                break;
            default:
                $p["f"] += $v["commission"];
                $pr = getUser("orders_products", "where order_id=" . $v["id"]);
                if ($pr) {
                    foreach ($pr as $v2) {
                        $pr2 = selaa("products", "where id=" . $v2["product_id"] . " ");
                        if ($pr2)
                            if ($pr2["user_id"]) {
                                $p["fr"] +=  (($St->commission * $pr2["price"]) / 100) * $v2["amount"];
                                $p["fs"] +=  ($pr2["price"]  - (($St->commission * $pr2["price"]) / 100)) * $v2["amount"];
                            } else
                                $p["fr"] += $pr2["add_price"];
                    }
                }
                break;
        }
    }, $orders);
    ?>

    <div class="row">
        <div class="col-lg-3 col-md-4 col-sm-6">
            <div class="card">
                <div class="card-header">
                    <div>
                        <h2 class="fw-bolder"><?= number_format(count($users)) ?></h2>
                        <p class="card-text"><?= $_lang["Totalusers"] ?></p>
                    </div>
                    <div class="avatar bg-light-info p-50 m-50">
                        <div class="avatar-content">
                            <i data-feather="users" class="font-medium-5"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-4 col-sm-6">
            <div class="card">
                <div class="card-header">

                    <div>
                        <h2 class="fw-bolder"><?= number_format(count($products)) ?></h2>
                        <p class="card-text"><?= $_lang["Totalproducts"] ?></p>
                    </div>
                    <div class="avatar bg-light-primary p-50 m-50">
                        <div class="avatar-content">
                            <i data-feather="grid" class="font-medium-5"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-4 col-sm-6">
            <div class="card">
                <div class="card-header">

                    <div>
                        <h2 class="fw-bolder"><?= number_format(count($sproducts)) ?></h2>
                        <p class="card-text"><?= $_lang["Totalproductsseller"] ?></p>
                    </div>
                    <div class="avatar bg-light-primary p-50 m-50">
                        <div class="avatar-content">
                            <i data-feather="grid" class="font-medium-5"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-4 col-sm-6">
            <div class="card">
                <div class="card-header">

                    <div>
                        <h2 class="fw-bolder"><?= number_format(count($orders)) ?></h2>
                        <p class="card-text"><?= $_lang["Totalorders"] ?></p>
                    </div>
                    <div class="avatar bg-light-danger p-50 m-50">
                        <div class="avatar-content">
                            <i data-feather="server" class="font-medium-5"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-4 col-sm-6">
            <div class="card">
                <div class="card-header">
                    <div>
                        <h2 class="fw-bolder"><span class="text-danger"><?= number_format($p["f"]) ?></span> / <span class="text-success"><?= number_format($p["t"]) ?></span></h2>
                        <p class="card-text"><?= $_lang["Totalcommissions"] ?></p>
                    </div>
                    <div class="avatar bg-light-success p-50 m-50">
                        <div class="avatar-content">
                            <span class="font-medium-2"><?= $_lang["currency"] ?></span>
                        </div>
                    </div>


                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-4 col-sm-6">
            <div class="card">
                <div class="card-header">
                    <div>
                        <h2 class="fw-bolder"><span class="text-danger"><?= number_format($p["fs"]) ?></span> / <span class="text-success"><?= number_format($p["s"]) ?></span></h2>
                        <p class="card-text"><?= $_lang["Totalcommissionsseller"] ?></p>
                    </div>
                    <div class="avatar bg-light-success p-50 m-50">
                        <div class="avatar-content">
                            <span class="font-medium-2"><?= $_lang["currency"] ?></span>
                        </div>
                    </div>


                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-4 col-sm-6">
            <div class="card">
                <div class="card-header">

                    <div>
                        <h2 class="fw-bolder"><?= number_format($p["p"]) ?></h2>
                        <p class="card-text"><?= $_lang["pendingbalance"] ?></p>
                    </div>
                    <div class="avatar bg-light-warning p-50 m-50">
                        <div class="avatar-content">
                            <i data-feather="alert-octagon" class="font-medium-5"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-4 col-sm-6">
            <div class="card">
                <div class="card-header">

                    <div>
                        <h2 class="fw-bolder"><span class="text-danger"><?= number_format($p["fr"]) ?></span> / <span class="text-success"><?= number_format($p["r"]) ?></span></h2>
                        <p class="card-text"><?= $_lang["TotalRevenue"] ?></p>
                    </div>
                    <div class="avatar bg-light-success p-50 m-50">
                        <div class="avatar-content">
                            <span class="font-medium-2"><?= $_lang["currency"] ?></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <? if ($_login->role != 1) { ?>
            <div class="col-lg-3 col-md-4 col-sm-6">
                <div class="card">
                    <div class="card-header">
                        <div class="avatar bg-light-success p-50 m-0">
                            <div class="avatar-content">
                                <i class="fas fa-money-bill font-medium-5"></i>
                            </div>
                        </div>
                        <div>
                            <h2 class="fw-bolder mb-0"><?= number_format($_login->money) ?></h2>
                            <p class="card-text"><?= $_lang["AvailableBalance"] ?></p>
                        </div>

                    </div>
                </div>
            </div>
        <? } ?>

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
                            <div data-done="<?= ($c ? ceil(($c / $data) * 100) : 0) ?>" id="support-trackers-chart"></div>
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
                            <div data-done="<?= ($c ? ceil(($c / $data) * 100) : 0) ?>" id="goal-overview-chart"></div>
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
                    // $user += $data[$y]["commission"];
                    $pr = getUser("orders_products", "where order_id=" . $data[$y]["id"]);
                    if ($pr) {
                        foreach ($pr as $v) {
                            $pr2 = selaa("products", "where id=" . $v["product_id"] . " ");
                            if ($pr2)
                                if ($pr2["user_id"]) {
                                    $user +=  (($St->commission * $pr2["price"]) / 100) * $v["amount"];
                                } else
                                    $user += $pr2["add_price"];
                        }
                    }
                }
                if (date("Y-m-d", $data[$y]["date"]) == date("Y-" . $lmonth . "-" . $day) && $data[$y]["status"] == 3) {
                    $pr = getUser("orders_products", "where order_id=" . $data[$y]["id"]);
                    if ($pr) {
                        foreach ($pr as $v) {
                            $pr2 = selaa("products", "where id=" . $v["product_id"] . " ");
                            if ($pr2)
                                if ($pr2["user_id"]) {
                                    $luser +=  (($St->commission * $pr2["price"]) / 100) * $v["amount"];
                                } else
                                    $luser += $pr2["add_price"];
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