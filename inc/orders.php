<!-- Basic table -->
<section id="basic-datatable">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <table class="table" data-datatable="true" data-export="true" data-index="7" data-status='<?= json_encode(orderStatus()) ?>'>
                    <thead>
                        <tr>
                            <th data-id="id">#</th>
                            <th data-id="fullname"><?= $_lang["Customer"] ?></th>
                            <th data-id="phone"><?= $_lang["phone"] ?></th>
                            <th data-id="Commission"><?= $_lang["Commission"] ?></th>
                            <th data-id="total"><?= $_lang["Total"] ?></th>
                            <th data-id="date"><?= $_lang["Date"] ?></th>
                            <th data-id="date"><?= $_lang["deliverydate"] ?></th>
                            <th data-id="status"><?= $_lang["Status"] ?></th>
                            <th data-id=" "><?= $_lang["Action"] ?></th>
                        </tr>
                    </thead>
                    <tbody>

                        <?


                        $variable = getUser("orders", "where user_id=" . $_login->id);
                        $variable = array_map(function ($v) use ($_lang, $clang) {
                            $v["area"] = Selaa("delivery_areas", "where id=" . $v["area"])["name" . $clang];
                            $v["city"] = Selaa("delivery_cities", "where id=" . $v["city"])["name" . $clang];
                            return $v += ["responsive_id" => ""];
                        }, $variable);
                        foreach ($variable as $k => $v) {
                            $roles = orderStatus($v["status"]);
                        ?>

                            <tr>
                                <td> <?= $v["id"] ?> </td>
                                <td>
                                    <div class="d-flex justify-content-left align-items-center">

                                        <div class="avatar-wrapper">

                                            <div class="avatar  me-1">

                                                <div class="avatar-content"><i class="avatar-icon" data-feather='user'></i></div>

                                            </div>

                                        </div>
                                        <div class="d-flex flex-column">

                                            <span class="emp_name text-truncate fw-bold"><?= $v["fullname"] ?></span>

                                            <small class="emp_post text-truncate text-muted"><?= $v["city"] ?> - <?= $v["area"] ?></small>

                                        </div>

                                    </div>

                                </td>

                                <td> <?= $v["phone"] ?> </td>


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

                                        <? if (!$v["status"]) { ?>
                                            <a href="javascript:;" data-red="this" data-action="cancel-order" data-table="orders" data-index="<?= $k ?>" data-id="<?= $v["id"] ?>" data-bs-toggle="tooltip" data-bs-placement="top" title="<?= $_lang["cancel-order"] ?>" class="item-edit me-1">

                                                <i data-feather='trash-2' class="font-medium-2 text-body"></i>

                                            </a>
                                            <a href="javascript:;" data-modal="edit-order-user" data-table="orders" data-index="<?= $k ?>" data-id="<?= $v["id"] ?>" data-bs-toggle="tooltip" data-bs-placement="top" title="<?= $_lang["edit"] ?>" class="item-edit me-1">

                                                <i data-feather='edit' class="font-medium-2 text-body"></i>

                                            </a>
                                        <? } ?>
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
<!--/ Basic table -->