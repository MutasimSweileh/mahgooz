<section id="basic-datatable">

    <div class="row">

        <div class="col-12">

            <div class="card">

                <table class="table" data-datatable="true" data-export="true" data-index="7" data-status='<?= json_encode(orderStatus()) ?>'>

                    <thead>

                        <tr>

                            <th data-id="id">#</th>

                            <th data-id="fullname"><?= $_lang["user"] ?></th>

                            <th <?= ($_login->role != 1 ? "data-hide" : "") ?> data-id="fullname"><?= $_lang["Customer"] ?></th>


                            <th <?= ($_login->role != 1 ? "data-hide" : "") ?> data-id="phone"><?= $_lang["Commission"] ?></th>


                            <th data-id="phone"><?= $_lang["Total"] ?></th>

                            <th data-id="date"><?= $_lang["Date"] ?></th>
                            <th data-id="date"><?= $_lang["deliverydate"] ?></th>

                            <th data-id="status"><?= $_lang["Status"] ?></th>

                            <th data-id=" "><?= $_lang["Action"] ?></th>

                        </tr>

                    </thead>

                    <tbody>

                        <?



                        $variable = getUser("orders");

                        $filter_orders = [];

                        if ($_login->role != 1) {

                            array_map(function ($v) use (&$p, $_login, &$filter_orders) {

                                $pr = sel("orders_products", "where order_id=" . $v["id"]);

                                if ($pr) {

                                    $pr = selaa("products", "where id=" . $pr->product_id . " and user_id=" . $_login->id);

                                    if ($pr) {

                                        $filter_orders[] = $v;
                                    }
                                }
                            }, $variable);

                            $variable = $filter_orders;
                        }

                        foreach ($variable as $k => $v) {

                            $sel = Selaa("login", "where id=" . $v["user_id"]);

                            //  $sel2 = Selaa("method_type", "where id=" . $sel["method_type"]);

                            $roles = orderStatus($v["status"]);
                            if ($_login->role != 1) {
                                $v["total"] -= $v["commission"];
                            }
                            //print_r($roles);

                            //die();



                        ?>

                            <tr>

                                <td> <?= $v["id"] ?> </td>

                                <td>

                                    <div class="d-flex justify-content-left align-items-center">

                                        <div class="avatar-wrapper">

                                            <div class="avatar  me-1"><img src="<?= getUpUrl($sel["avatar"]) ?>" alt="Avatar" height="32" width="32"></div>

                                        </div>



                                        <div class="d-flex flex-column">

                                            <span class="emp_name text-truncate fw-bold"><?= $sel["fullname"] ?></span>

                                            <small class="emp_post text-truncate text-muted"><?= $sel["phone"] ?></small>

                                        </div>

                                    </div>

                                </td>

                                <td>

                                    <div class="d-flex justify-content-left align-items-center">

                                        <div class="avatar-wrapper">

                                            <div class="avatar  me-1">

                                                <div class="avatar-content"><i class="avatar-icon" data-feather='user'></i></div>

                                            </div>

                                        </div>



                                        <div class="d-flex flex-column">

                                            <span class="emp_name text-truncate fw-bold"><?= $v["fullname"] ?></span>

                                            <small class="emp_post text-truncate text-muted"><?= $v["phone"] ?></small>

                                        </div>

                                    </div>

                                </td>




                                <td><?= number_format($v["commission"]) ?> <?= $_lang["currency"] ?></td>


                                <td><?= number_format($v["total"]) ?> <?= $_lang["currency"] ?></td>

                                <td><?= date("d/m/Y", $v["date"]) ?></td>
                                <td><?= ($v["deliverydate"] ? date("d/m/Y", $v["deliverydate"]) : $_lang["none"])  ?></td>

                                <td> <span class="badge rounded-pill  badge-light-<?= $roles["class"] ?>"><?= $roles["title"] ?></span>

                                </td>

                                <td>

                                    <div class="text-center">



                                        <a href="<?= getSiteUrl("order-preview", $v["id"]) ?>" data-bs-toggle="tooltip" data-bs-placement="top" class="item-edit me-1" title="<?= $_lang["order-preview"] ?>">

                                            <i data-feather='eye' class="font-medium-2 text-body"></i>

                                        </a>



                                        <? if ($_login->role == 1) { ?>

                                            <a href="javascript:;" data-red="this" data-action="remove" data-table="orders" data-index="<?= $k ?>" data-id="<?= $v["id"] ?>" data-bs-toggle="tooltip" data-bs-placement="top" title="<?= $_lang["delete"] ?>" class="item-edit me-1">

                                                <i data-feather='trash-2' class="font-medium-2 text-body"></i>

                                            </a>

                                            <a href="javascript:;" data-modal="edit-order" data-table="orders" data-index="<?= $k ?>" data-id="<?= $v["id"] ?>" data-bs-toggle="tooltip" data-bs-placement="top" title="<?= $_lang["edit"] ?>" class="item-edit me-1">

                                                <i data-feather='edit' class="font-medium-2 text-body"></i>

                                            </a><? } ?>

                                    </div>

                                </td>

                            </tr>

                        <? } ?>

                    </tbody>

                </table>

            </div>

        </div>

    </div>



</section>