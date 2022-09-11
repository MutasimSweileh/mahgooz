<?php
$id = isv("id");
$data = Sel("orders", "where id=" . isv("id"));
if (!$data)
    header("Location: " . getSiteUrl("orders"));
?>
<div class="invoice-print p-3">
    <div class="invoice-header d-flex justify-content-between flex-md-row flex-column pb-2">
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
        </div>
    </div>



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

    <div class="row invoice-sales-total-wrapper mt-3">
        <div class="col-md-6 order-md-1 order-2 mt-md-0 mt-3">
            <p class="card-text mb-0"> <span class="fw-bold "><?= $_lang["Commission"] ?>:</span> <span class="ms-75"><?= number_format($data->commission) ?> <?= $_lang["currency"] ?></span></p>
        </div>
        <div class="col-md-6 d-flex justify-content-end order-md-2 order-1">
            <div class="invoice-total-wrapper">
                <div class="invoice-total-item">
                    <p class="invoice-total-title"><?= $_lang["Subtotal"] ?>:</p>
                    <p class="invoice-total-amount"><?= number_format(($data->total - $data->delivery_charges)) ?> <?= $_lang["currency"] ?></p>
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
    <? if ($data->note) { ?>
        <hr class="my-2" />

        <div class="row">
            <div class="col-12">
                <span class="fw-bold"><?= $_lang["ShippingNote"] ?>:</span>
                <span><?= $data->note ?></span>
            </div>
        </div>
    <? } ?>
</div>