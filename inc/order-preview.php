<?php
$id = isv("id");
if ($_login->role) {
    include "order-preview-admin.php";
} else {
    $data = Sel("orders", "where id=" . isv("id"));
    if (!$data)
        header("Location: " . getSiteUrl((($_login->role) ? "site-" : "") . "orders"));
?>
    <section class="invoice-preview-wrapper">
        <div class="row invoice-preview">
            <!-- Invoice -->
            <div class="col-xl-9 col-md-8 col-12">
                <div class="card invoice-preview-card">
                    <div class="card-body invoice-padding pb-0">
                        <!-- Header starts -->
                        <div class="d-flex justify-content-between flex-md-row flex-column invoice-spacing mt-0">
                            <div>

                                <p class="card-text mb-25"><i data-feather='user'></i> <?= $data->fullname ?></p>
                                <p class="card-text mb-25"><i data-feather='map-pin'></i> <?= $data->address ?>, <?= Selaa("delivery_areas", "where id=" . $data->area)["name" . $clang] ?>, <?= Selaa("delivery_cities", "where id=" . $data->city)["name" . $clang] ?></p>
                                <p class="card-text mb-0"><i data-feather='phone'></i> <?= $data->phone ?></p>
                                <p class="card-text mb-0 d-none"><?= $data->note ?></p>
                            </div>
                            <div class="mt-md-0 mt-2">
                                <h4 class="invoice-title">
                                    <?= $_lang["Invoice"] ?>
                                    <span class="invoice-number">#<?= $id ?></span>
                                </h4>
                                <div class="invoice-date-wrapper">
                                    <p class="invoice-date-title"><?= $_lang["Date"] ?>:</p>
                                    <p class="invoice-date"><?= date("d/m/Y", $data->date) ?></p>
                                </div>
                                <? if ($data->deliverydate) { ?>
                                    <div class="invoice-date-wrapper">
                                        <p class="invoice-date-title"><?= $_lang["deliverydate"] ?>:</p>
                                        <p class="invoice-date"><?= date("d/m/Y", $data->deliverydate) ?></p>
                                    </div>
                                <? } ?>
                            </div>
                        </div>
                        <!-- Header ends -->
                    </div>
                    <!-- Invoice Description starts -->
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th class="py-1"><?= $_lang["product"] ?></th>
                                    <th class="py-1"><?= $_lang["price"] ?></th>
                                    <th class="py-1"><?= $_lang["Qty"] ?></th>
                                    <th class="py-1"><?= $_lang["Total"] ?></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $Commission = 0;
                                $data2 = getUser("orders_products", "where order_id=" . $id);
                                foreach ($data2 as $k => $v) {
                                    $p = Selaa("products", "where id=" . $v["product_id"]);
                                    // $s = Selaa("product_sizes", "where id=" . $v["product_size"]);
                                    // $c = Selaa("product_colors", "where id=" . $v["product_color"]);
                                    $p["price"] += $p["add_price"];
                                    $company = "";
                                    if ($p["product_specification"]) {
                                        $data3 = json_decode(rawurldecode($p["product_specification"]), true)[$v["product_color"]];
                                        $stock = $data3["sizes"][$v["product_size"]]["stock"];
                                        $company = ucfirst($data3["title" . $clang]);
                                        $company = ($company ? $company . " - " . $data3["sizes"][$v["product_size"]]["size"] : $data3["sizes"][$v["product_size"]]["size"]);
                                    }
                                    $image = "";
                                    if ($p["product_images"]) {
                                        $image = json_decode(rawurldecode($p["product_images"]), true)[0]["image"];
                                    }
                                ?>
                                    <tr class="<?= ($k == count($data2) - 1 ? "border-bottom" : "") ?>">
                                        <td class="py-1">
                                            <div class="d-flex justify-content-left align-items-center">
                                                <div class="avatar-wrapper">
                                                    <div class="avatar avatar-xl me-50"><img src="<?= getUpUrl($image) ?>" alt="Avatar" width="32" height="32"></div>
                                                </div>
                                                <div class="d-flex flex-column">
                                                    <h6 class="user-name text-truncate mb-0"><?= $p["name" . $clang] ?></h6>
                                                    <small class="text-truncate text-muted"> <?= $company ?></small>
                                                </div>
                                            </div>

                                        </td>
                                        <td class="py-1">
                                            <span class="fw-bold"><?= number_format($p["price"]) ?> <?= $_lang["currency"] ?></span>
                                        </td>
                                        <td class="py-1">
                                            <span class="fw-bold"><?= $v["amount"] ?></span>
                                        </td>
                                        <td class="py-1">
                                            <span class="fw-bold"><?= number_format(($v["amount"] * $p["price"])) ?> <?= $_lang["currency"] ?></span>
                                        </td>
                                    </tr>
                                <? } ?>


                            </tbody>
                        </table>
                    </div>

                    <div class="card-body invoice-padding pb-0">
                        <div class="row invoice-sales-total-wrapper">
                            <div class="col-md-6 order-md-1 order-2 mt-md-0 mt-3">
                                <p class="card-text mb-0 ">
                                    <span class="fw-bold "><?= $_lang["Commission"] ?>:</span> <span class="ms-75 text-success"><?= number_format($data->commission) ?> <?= $_lang["currency"] ?></span>
                                </p>
                            </div>
                            <div class="col-md-6 d-flex justify-content-end order-md-2 order-1">
                                <div class="invoice-total-wrapper">
                                    <div class="invoice-total-item">
                                        <p class="invoice-total-title"><?= $_lang["Subtotal"] ?>:</p>
                                        <p class="invoice-total-amount"><?= number_format(($data->total - $data->delivery_charges - $data->commission)) ?> <?= $_lang["currency"] ?></p>
                                    </div>

                                    <div class="invoice-total-item">
                                        <p class="invoice-total-title"><?= $_lang["DeliveryCharges"] ?>:</p>
                                        <p class="invoice-total-amount "><?= number_format($data->delivery_charges) ?> <?= $_lang["currency"] ?></p>
                                    </div>
                                    <hr class="my-50" />
                                    <div class="invoice-total-item">
                                        <p class="invoice-total-title"><?= $_lang["Total"] ?>:</p>
                                        <p class="invoice-total-amount"><?= number_format($data->total) ?> <?= $_lang["currency"] ?></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Invoice Description ends -->
                    <? if ($data->note) { ?>
                        <hr class="invoice-spacing" />

                        <!-- Invoice Note starts -->
                        <div class="card-body invoice-padding pt-0">
                            <div class="row">
                                <div class="col-12">
                                    <span class="fw-bold"><?= $_lang["ShippingNote"] ?>:</span>
                                    <span><?= $data->note ?></span>
                                </div>
                            </div>
                        </div>
                    <? } ?>
                    <!-- Invoice Note ends -->
                </div>
                <div class="card">
                    <div class="card-body">
                        <? $variable = getUser('comments', 'where  order_id=' . $_id);
                        foreach ($variable as $k => $v) {
                            $u = Sel('login', "where id=" . $v["user_id"]);
                            $roles = roles($u->role);

                        ?>
                            <div class="d-flex align-items-start mb-1">
                                <div class="avatar mt-25 me-75">
                                    <img src="<?= getUpUrl($u->avatar) ?>" alt="Avatar" height="34" width="34">
                                </div>
                                <div class="profile-user-info w-100">
                                    <div class="d-flex align-items-center justify-content-between">
                                        <h6 class="mb-0"><?= $u->fullname ?> <span class="badge badge-light-<?= $roles["color"] ?>"><?= $roles["name"] ?></span> </h6>
                                        <div>
                                            <span class="align-middle d-block text-muted"><?= cptime($v["date"]) ?></span>


                                        </div>
                                    </div>
                                    <small><?= $v["text"] ?></small>
                                </div>
                            </div>
                        <? } ?>

                        <!--/ comments -->

                        <!-- comment box -->
                        <form action="" id="comments" data-red="this" method="POST">
                            <fieldset class="mb-75">
                                <textarea class="form-control" data-valid id="label-textarea" name="text" rows="3" placeholder="<?= $_lang["AddComment"] ?>" spellcheck="false"></textarea>
                            </fieldset>
                            <!--/ comment box -->
                            <input type="hidden" name="user_id" value="<?= $_login->id ?>">
                            <input type="hidden" name="order_id" value="<?= $_id ?>">
                            <input type="hidden" name="date" value="<?= time() ?>">
                            <button type="submit" class="btn btn-sm btn-primary waves-effect waves-float waves-light"><?= $_lang["PostComment"] ?></button>
                        </form>
                    </div>
                </div>
            </div>
            <!-- /Invoice -->

            <!-- Invoice Actions -->
            <div class="col-xl-3 col-md-4 col-12 invoice-actions mt-md-0 mt-2">
                <div class="card">
                    <div class="card-body">
                        <a class="btn btn-primary w-100 mb-75" href="<?= getSiteUrl("order-print", $data->id) ?>" target="_blank">
                            <?= $_lang["Print"] ?>
                        </a>
                        <a class="btn btn-outline-secondary w-100 mb-75 d-none"> <?= $_lang["Print"] ?> </a>
                        <a class="btn btn-success w-100" href="<?= getSiteUrl("orders") ?>">
                            <?= $_lang["BacktoOrders"] ?>
                        </a>
                    </div>
                </div>
            </div>
            <!-- /Invoice Actions -->
        </div>
    </section>
<? } ?>