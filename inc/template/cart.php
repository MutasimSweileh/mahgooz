<?
//echo __DIR__;
$show = "";
if (!function_exists("getUser")) {
    include "../../inc.php";
    //$show = (isv("show")?"show":"");
}
$data = getUser("cart", "where user_id=" . $_login->id);

?>
<a class="nav-link <?= $show ?>" href="#" id="cart_icon" data-bs-toggle="dropdown" aria-expanded="<?= $show ? "true" : "false" ?>"><i class="ficon" data-feather="shopping-cart"></i><span class="badge rounded-pill bg-primary badge-up cart-item-count"><?= count($data) ?></span></a>
<ul class="<?= (!$data ? "d-none" : "") ?> dropdown-menu dropdown-menu-media dropdown-menu-start <?= $show ?>" data-bs-popper="none">
    <li class="dropdown-menu-header">
        <div class="dropdown-header d-flex">
            <h4 class="notification-title mb-0 me-auto"><?= $_lang["cart"] ?></h4>

            <div class="badge rounded-pill badge-light-primary"><?= count($data) ?> <?= $_lang["Items"] ?></div>
        </div>
    </li>
    <li class="scrollable-container media-list">
        <? $price = 0;
        foreach ($data as $key => $v) {
            $p = Selaa("products", "where id=" . $v["product_id"]);
            $p["price"] += $p["add_price"];
            $price += ($v["amount"] * ($p["price"]));
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
        ?>


            <div class="list-item align-items-center"><img class="d-block rounded me-1" src="<?= getUpUrl($image) ?>" alt="donuts" width="62">
                <div class="list-item-body flex-grow-1">
                    <i class="ficon cart-item-remove fas fa-times" data-cart="<?= $v["id"] ?>" data-id="<?= $v["id"] ?>"></i>
                    <svg xmlns="http://www.w3.org/2000/svg" data-cart="<?= $p["id"] ?>" data-id="<?= $p["id"] ?>" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather d-none cart-item-remove feather-trash-2">
                        <polyline points="3 6 5 6 21 6"></polyline>
                        <path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path>
                        <line x1="10" y1="11" x2="10" y2="17"></line>
                        <line x1="14" y1="11" x2="14" y2="17"></line>
                    </svg>
                    <div class="media-heading">
                        <h6 class="cart-item-title"><a class="text-body" href="<?= getSiteUrl("product-details", $p["id"]) ?>"> <?= $p["name" . $clang] ?></a></h6>
                        <small class="cart-item-by"><?= $company ?></small>
                    </div>
                    <div class="cart-item-qty">
                        <div class="input-group">
                            <input value="<?= $v["amount"] ?>" data-table="cart_table" data-id="<?= $v["id"] ?>" min="1" name="amount_cart" max="<?= $stock ?>" readonly data-TouchSpin="true" type="number">
                        </div>
                    </div>
                    <h5 class="cart-item-price"><?= number_format(($v["amount"] * $p["price"])) ?> <?= $_lang["currency"] ?></h5>
                </div>
            </div>
        <? } ?>
    </li>
    <li class="dropdown-menu-footer">
        <div class="d-flex justify-content-between mb-1">
            <h6 class="fw-bolder mb-0"><?= $_lang["Total"] ?>:</h6>
            <h6 class="text-primary fw-bolder mb-0"><?= number_format($price) ?> <?= $_lang["currency"] ?></h6>
        </div><a class="btn btn-primary w-100" href="<?= getSiteUrl("checkout") ?>"><?= $_lang["Checkout"] ?></a>
    </li>
</ul>