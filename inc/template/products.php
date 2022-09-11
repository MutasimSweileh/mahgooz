<?php
if (!function_exists("getUser")) {
    include "../../inc.php";
}
$page = (isv("id") ? isv("id") : 1);
$page = (isv("page") ? isv("page") : $page);
$sort = isv("sort");
?>
<section id="ecommerce-products" class="grid-view">
    <?php
    $limit = 9;
    $where = "where active=1";
    if (isv("search_product")) {
        $where .= " and (name like '%" . isv("search_product") . "%' || name_arabic like '%" . isv("search_product") . "%') ";
    }

    if (isv("PriceRange")) {
        $PriceRange = explode(":", isv("PriceRange"));
        $where .= " and  cast(price as unsigned) >= " . $PriceRange[0] . "  and cast(price as unsigned) <= " . $PriceRange[1];
    }
    if (isv("category")) {
        $where .= " and  category in (" . join(",", $_POST["category"]) . ") ";
    }
    if ($sort) {
        if ($sort == "Wishlist") {
            $wishlist = array_filter(explode(",", $_login->wishlist));
            $where .= " and  id in (" . join(",", $wishlist) . ") ";
            $sort = "";
        } else if ($sort == "Highest") {
            $sort = " order by cast(price as unsigned) DESC";
        } else {
            $sort = " order by cast(price as unsigned) ASC";
        }
    }

    $_limit = " limit 0," . $limit;
    if ($page)
        $_limit = " limit " . (($page - 1) * $limit) . "," . $limit;
    // echo $_limit;
    // echo $where . $sort . $_limit;
    $data = getUser("products", $where . $sort . $_limit);
    foreach ($data as $k => $v) {
        $v["price"] += $v["add_price"];
        $image = "";
        if ($v["product_images"]) {
            $image = json_decode(rawurldecode($v["product_images"]), true)[0]["image"];
        }
        if ($v["product_specification"]) {
            $data2 = json_decode(rawurldecode($v["product_specification"]), true);
            $stock = 0;
            array_map(function ($v) use (&$stock) {
                array_map(function ($v) use (&$stock) {
                    $stock += $v["stock"];
                }, $v["sizes"]);
            }, $data2);
            $v["stock"] = $stock;
        }

    ?>
        <div class="card ecommerce-card">
            <div class="item-img text-center">
                <a href="<?= getSiteUrl("product-details", $v["id"]) ?>">
                    <img class="img-fluid card-img-top" src="<?= getUpUrl($image) ?>" alt="img-placeholder"></a>
            </div>
            <div class="card-body">
                <div class="item-wrapper">
                    <div class="item-rating" data-bs-toggle="tooltip" data-bs-placement="top" title="<?= $v["stock"] ?> <?= $_lang["pieceinstock"] ?>">
                        <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-package">
                            <line x1="16.5" y1="9.4" x2="7.5" y2="4.21"></line>
                            <path d="M21 16V8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73l7 4a2 2 0 0 0 2 0l7-4A2 2 0 0 0 21 16z"></path>
                            <polyline points="3.27 6.96 12 12.01 20.73 6.96"></polyline>
                            <line x1="12" y1="22.08" x2="12" y2="12"></line>
                        </svg>
                        <?= $v["stock"] ?>
                    </div>
                    <div>
                        <h6 class="item-price"><?= number_format($v["price"]) ?> <?= $_lang["currency"] ?></h6>
                    </div>
                </div>
                <h6 class="item-name">
                    <a class="text-body" href="<?= getSiteUrl("product-details", $v["id"]) ?>"><?= $v["name" . $clang] ?></a>
                    <span class="card-text item-company d-none">By <a href="#" class="company-name">Apple</a></span>
                </h6>
                <p class="card-text item-description">
                    <?= $v["description" . $clang] ?>
                </p>
            </div>
            <div class="item-options text-center">
                <div class="item-wrapper">
                    <div class="item-cost">
                        <h4 class="item-price"><?= number_format($v["price"]) ?> <?= $_lang["currency"] ?></h4>
                    </div>
                </div>

                <a href="#" data-msg="<?= $_lang["Addedwishlist"] ?>" data-id="<?= $v["id"] ?>" data-action="wishlist" class="btn btn-light btn-wishlist waves-effect waves-float waves-light">
                    <svg class="<?= (in_array($v["id"], explode(",", $_login->wishlist)) ? "text-danger" : "") ?>" xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-heart text-danger">
                        <path d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z"></path>
                    </svg>
                    <span><?= $_lang["Wishlist"] ?></span>
                </a>
                <a href="<?= getSiteUrl("product-details", $v["id"]) ?>" class="btn btn-primary btn-cart2 waves-effect waves-float waves-light">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-eye font-medium-2">
                        <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path>
                        <circle cx="12" cy="12" r="3"></circle>
                    </svg>
                    <span class="add-to-cart"><?= $_lang["View"] ?></span>
                </a>
            </div>
        </div>
    <?php }
    if (!$data) { ?>

    <? } ?>
</section>
<!-- E-commerce Products Ends -->
<? if (!$data) { ?>
    <div class="justify-content-center align-content-center d-flex">
        <div class="no-results m-auto show">
            <h5><?= $_lang['No Items Found'] ?></h5>
        </div>
    </div> <? } ?>
<!-- E-commerce Pagination Starts -->
<? if ($data) { ?>
    <section id="ecommerce-pagination">
        <div class="row">
            <div class="col-sm-12">

                <nav aria-label="Page navigation example">
                    <ul class="pagination justify-content-center mt-2">

                        <li data-action="applyFilters" data-block="#products" data-page="<?= $page - 1 ?>" class="page-item prev-item <?= (!($page - 1) ? "disabled" : "") ?>"><a class="page-link" href="<?= getSiteUrl("products", $page - 1) ?>"></a></li>
                        <?php
                        $data = getUser("products", $where);
                        $num = (count($data) / $limit);

                        for ($i = 0; $i < ceil($num); $i++) {
                        ?>

                            <li data-action="applyFilters" data-block="#products" data-page="<?= $i + 1 ?>" class="page-item <?= ((!$page && !$i || $page == ($i + 1)) ? "active" : "") ?>"><a class="page-link" href="<?= getSiteUrl("products", $i + 1) ?>"><?= $i + 1 ?></a></li>
                        <? }  ?>
                        <li data-action="applyFilters" data-block="#products" data-page="<?= $page + 1 ?>" class="page-item next-item <?= (($page >= ceil($num)) ? "disabled" : "") ?> "><a class="page-link" href="<?= getSiteUrl("products", $page + 1) ?>"></a></li>
                    </ul>
                </nav>
            </div>
        </div>
    </section>
<? } ?>