<div class="checkout-items">
    <? if (!function_exists("getUser")) {
        include "../../inc.php";
    }
    $price = 0;
    $Commission = 0;
    $coupon = isv("coupon");
    $discount = false;
    if ($coupon) {
        $sql = Sel("coupons", "where code='" . $coupon . "' and active=1");
        if ($sql &&  (!$sql->date || ($sql->date &&  $sql->date < time())))
            $discount = $sql->cost;
    }
    $DeliveryCharges = (isv("delivery_charges") ? isv("delivery_charges") : 0);
    $data = getUser("cart", "where user_id=" . $_login->id);
    foreach ($data as $key => $v) {
        $p = Selaa("products", "where id=" . $v["product_id"]);
        // $s = Selaa("product_sizes", "where id=" . $v["product_size"]);
        // $c = Selaa("product_colors", "where id=" . $v["product_color"]);
        $price += ($v["amount"] * ($p["price"] + $p["add_price"]));
        $stock = $p["stock"];
        $company = "";
        if ($p["product_specification"]) {
            $data = json_decode(rawurldecode($p["product_specification"]), true)[$v["product_color"]];
            $stock = $data["sizes"][$v["product_size"]]["stock"];
            $company = ucfirst($data["title" . $clang]);
            if (trim($data["sizes"][$v["product_size"]]["size"]))
                $company = ($company ? $company . " - " . $data["sizes"][$v["product_size"]]["size"] : $data["sizes"][$v["product_size"]]["size"]);
        }
        $image = "";
        if ($p["product_images"]) {
            $image = json_decode(rawurldecode($p["product_images"]), true)[0]["image"];
        }
        $Commission += ($v["amount"] * $v["commission"]);
        $id = $key;

    ?>
        <div class="card ecommerce-card">
            <div class="item-img">
                <a href="<?= getSiteUrl("product-details", $p["id"]) ?>">
                    <img src="<?= getUpUrl($image) ?>" alt="img-placeholder" />
                </a>
            </div>
            <div class="card-body">
                <div class="item-name">
                    <h6 class="mb-0">
                        <a href="<?= getSiteUrl("product-details", $p["id"]) ?>" class="text-body"><?= $p["name" . $clang] ?> </a>
                    </h6>
                    <span class="item-company"><?= $company ?></span>
                    <input type="hidden" name="products[<?= $id ?>][product_id]" value="<?= $p["id"] ?>">
                    <input type="hidden" name="products[<?= $id ?>][product_size]" value="<?= $v["product_size"] ?>">
                    <input type="hidden" name="products[<?= $id ?>][product_color]" value="<?= $v["product_color"] ?>">
                </div>
                <span class="mb-1"> <span class="badge rounded-pill bg-primary stock"><?= $stock ?></span> - <span class="text-success"> <?= $_lang["pieceinstock"] ?></span></span>
                <div class="item-quantity">
                    <span class="quantity-title"><?= $_lang["Qty"] ?>:</span>
                    <div class="quantity-counter-wrapper">
                        <div class="input-group">
                            <input type="text" class="quantity-counter" data-table="cart_table" data-id="<?= $v["id"] ?>" min="1" max="<?= $stock ?>" name="products[<?= $id ?>][amount]" readonly data-TouchSpin="true" value="<?= $v["amount"] ?>" />
                        </div>
                    </div>
                </div>
                <span class="delivery-date text-muted d-none">Delivery by, Wed Apr 30</span>
                <span class="text-success d-none">6% off 3 offers Available</span>
            </div>
            <div class="item-options text-center">
                <div class="item-wrapper">
                    <div class="item-cost">
                        <h4 class="item-price"><?= number_format(($v["amount"] * $p["price"])) ?> <?= $_lang["currency"] ?></h4>
                        <p class="card-text shipping">
                        <div class="badge rounded-pill badge-light-success"><i class="fas fa-money-bill me-50" style=""></i><span><?= $v["commission"] ?></span></div>
                        </p>
                    </div>
                </div>
                <button type="button" data-checkout="true" data-id="<?= $p["id"] ?>" class="btn btn-light mt-1 cart-item-remove">
                    <i data-feather="x" class="align-middle me-25"></i>
                    <span><?= $_lang["Remove"] ?></span>
                </button>
                <button type="button" data-msg="<?= $_lang["Addedwishlist"] ?>" data-id="<?= $p["id"] ?>" data-action="wishlist" class="btn btn-outline-secondary btn-cart move-cart">
                    <svg class="<?= (in_array($p["id"], explode(",", $_login->wishlist)) ? "text-danger" : "") ?>" xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-heart text-danger">
                        <path d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z"></path>
                    </svg>
                    <span class="text-truncate"><?= $_lang["Wishlist"] ?></span>
                </button>
            </div>
        </div>
    <? } ?>
</div>
<div class="checkout-options">
    <div class="card">
        <div class="card-body">
            <div class="coupons input-group input-group-merge">
                <input type="text" class="form-control" value="<?= $coupon ?>" name="coupon" placeholder="<?= $_lang["Coupon"] ?>" aria-label="Coupons" aria-describedby="input-coupons" />
                <button data-action="Coupon" class="btn  input-group-text text-primary ps-1" id="input-coupons"><?= $_lang["Apply"] ?></button>
            </div>
            <hr />
            <div class="price-details">
                <h6 class="price-title"><?= $_lang["PriceDetails"] ?></h6>
                <ul class="list-unstyled">
                    <li class="price-detail">
                        <div class="detail-title"><?= $_lang["Subtotal"] ?></div>
                        <div id="Subtotal" class="detail-amt"><?= number_format($price) ?> <?= $_lang["currency"] ?></div>
                    </li>
                    <? if ($discount) {
                        $discount = (($discount * $price) / 100);
                        $price -= $discount;
                    ?>
                        <li class="price-detail">
                            <div class="detail-title"><?= $_lang["discount"] ?></div>
                            <div id="Subtotal" class="detail-amt">-<?= number_format($discount) ?> <?= $_lang["currency"] ?></div>
                        </li>
                    <? } ?>
                    <li class="price-detail">
                        <div class="detail-title"><?= $_lang["Commission"] ?></div>
                        <input type="hidden" class="form-control" name="commission" value="<?= $Commission ?>">
                        <div id="Commission" class="detail-amt discount-amt text-success"><?= number_format($Commission) ?> <?= $_lang["currency"] ?></div>
                    </li>
                    <li class="price-detail">
                        <div class="detail-title"><?= $_lang["DeliveryCharges"] ?></div>
                        <div class="detail-amt discount-amt text-success DeliveryCharges">
                            <input type="hidden" class="form-control" name="delivery_charges" value="<?= $DeliveryCharges ?>">
                            <span class="delivery_charges"><?= $DeliveryCharges ?></span> <?= $_lang["currency"] ?>
                        </div>
                    </li>
                </ul>
                <hr />
                <?php
                $price += $Commission;
                ?>
                <ul class="list-unstyled">
                    <li class="price-detail">
                        <div class="detail-title detail-total"><?= $_lang["Total"] ?></div>
                        <input type="hidden" class="form-control" name="total" value="<?= ($price + $DeliveryCharges) ?>">
                        <div id="Total" class="detail-amt fw-bolder"><?= number_format(($price + $DeliveryCharges)) ?> <?= $_lang["currency"] ?></div>
                    </li>
                </ul>
                <input type="hidden" class="form-control" name="date" value="<?= time() ?>">
                <input type="hidden" class="form-control" name="user_id" value="<?= $_login->id ?>">
                <button type="submit" class="btn btn-primary w-100 btn-next place-order"><?= $_lang["PlaceOrder"] ?></button>
            </div>
        </div>
    </div>
    <!-- Checkout Place Order Right ends -->
</div>