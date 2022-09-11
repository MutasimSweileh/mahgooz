<?php

$data = Selaa("products", "where active=1 and id=" . $_id);

if (!$data) {

    header("Location: " . getSiteUrl((($_login->role) ? "site-" : "") . "products"));
}

$image = "";

if ($data["product_images"]) {

    $image = json_decode(rawurldecode($data["product_images"]), true)[0]["image"];
}

$data["price"] += $data["add_price"];

?>

<section class="app-ecommerce-details">

    <div class="card">

        <!-- Product Details starts -->

        <div class="card-body">

            <form data-nodata="true">

                <div class="row my-2">

                    <div class="col-12 col-md-5 d-flex align-items-center justify-content-center mb-2 mb-md-0">

                        <div class="swiper-container mySwiper">

                            <div class="swiper-wrapper">

                                <div class="d-flex2 swiper-slide align-items-center justify-content-center">

                                    <img src="<?= getUpUrl($image) ?>" class="img-fluid product-img" alt="product image">

                                </div>

                                <?php

                                if ($data["product_images"]) {

                                    $data2 = json_decode(rawurldecode($data["product_images"]), true);

                                    foreach ($data2 as $k => $v) {

                                        if (!$k)

                                            continue;

                                ?>

                                        <div class="d-flex2 swiper-slide align-items-center justify-content-center">

                                            <img src="<?= getUpUrl($v["image"]) ?>" class="img-fluid product-img" alt="product image">

                                        </div>

                                <? }
                                } ?>

                            </div>

                            <div class="swiper-button-next"></div>

                            <div class="swiper-button-prev"></div>

                            <div class="swiper-pagination"></div>

                        </div>



                    </div>

                    <div class="col-12 col-md-7">

                        <h4><?= $data["name" . $clang] ?></h4>

                        <span class="card-text item-company d-none">By <a href="#" class="company-name">Apple</a></span>

                        <div class="ecommerce-details-price d-flex flex-wrap mt-1">

                            <h4 class="item-price me-1"><?= number_format($data["price"]) ?> <?= $_lang["currency"] ?></h4>



                        </div>

                        <p class="card-text"> <span class="badge rounded-pill bg-primary stock"><?= $data["stock"] ?></span> - <span class="text-success"> <?= $_lang["pieceinstock"] ?></span></p>

                        <p class="card-text">

                            <?= $data["description" . $clang] ?>

                        </p>

                        <ul class="product-features list-unstyled">

                            <?php

                            if ($data["product_features"]) {

                                $data2 = json_decode(rawurldecode($data["product_features"]), true);

                                foreach ($data2 as $k => $v) {

                            ?>

                                    <li><?= $v["icon"] ?>

                                        <span><?= $v["title" . $clang] ?></span>

                                    </li>

                            <? }
                            } ?>



                        </ul> <?php

                                $stock = $data["stock"];



                                if ($data["product_specification"]) {

                                    $data2 = json_decode(rawurldecode($data["product_specification"]), true);

                                    $stock = $data2[0]["sizes"][0]["stock"];

                                ?>

                            <hr>



                            <div class="product-color-options">

                                <h6><?= $_lang["Color"] ?></h6>

                                <?php

                                    foreach ($data2 as $k => $v) {

                                ?>

                                    <input type="radio" data-id="<?= $k ?>" data-pid="<?= $data["id"] ?>" data-action="product_colors" value="<?= $k ?>" <?= (!$k ? "checked" : "") ?> class="btn-check" name="product_color" id="product_color<?= $k ?>" autocomplete="off">

                                    <label type="button" for="product_color<?= $k ?>" class="btn btn-outline-secondary waves-effect"><?= ucfirst($v["title" . $clang]) ?></label>

                                <? } ?>



                            </div>

                        <? }



                                //$data2 = getUser("product_sizes", "where active=1 " . ($data2 ? "and color_id=" . $data2[0]["id"] : "") . " and ( product_id =" . $data["id"] . ") ");
                                if ($data2)
                                    $size = array_filter($data2[0]["sizes"], function ($v) {
                                        return trim($v["size"]);
                                    });
                                if ($data2 && $size) { ?>

                            <hr>

                            <div class="product-color-options">

                                <h6><?= $_lang["Size"] ?></h6>

                                <div id="product_sizes">

                                    <?php

                                    foreach ($data2[0]["sizes"] as $k => $v) {

                                        $stock = $v["stock"];

                                    ?>

                                        <input type="radio" data-id="<?= $k ?>" data-cid="0" data-pid="<?= $data["id"] ?>" data-action="product_sizes" value="<?= $k ?>" <?= (!$k ? "checked" : "") ?> class="btn-check" name="product_size" id="product_size<?= $k ?>" autocomplete="off">

                                        <label type="button" for="product_size<?= $k ?>" class="btn btn-outline-secondary waves-effect"><?= ucfirst($v["size"]) ?></label>

                                    <? } ?>

                                </div>

                            </div>



                        <? } else { ?>
                            <input type="hidden" name="product_size" value="0">
                        <? } ?>

                        <hr>

                        <div class="product-color-options">



                            <div class="row">

                                <div class="col">

                                    <h6><?= $_lang["amount"] ?></h6>

                                    <div class="input-group">

                                        <input type="text" name="amount" min="1" readonly data-TouchSpin="true" class="touchspin" max="<?= $stock ?>" value="1" />

                                    </div>

                                </div>

                                <div class="col">

                                    <h6><?= $_lang["Commission"] ?></h6>

                                    <div class="input-group">

                                        <input type="text" name="commission" min="<?= $data["commission"] ? $data["commission"] : "1" ?>" readonly data-TouchSpin="true" class="touchspin" value="<?= $data["commission"] ? $data["commission"] : "1" ?>" />

                                    </div>

                                </div>

                            </div>

                        </div>

                        <hr>

                        <div class="d-flex flex-column flex-sm-row pt-1 <?= $_login->role ? "d-none" : "" ?>">

                            <?php

                            // $sel = Sel("cart", "where product_id=" . $data["id"]);

                            $sel = 0;

                            ?>

                            <a href="#" data-msg="<?= $_lang["AddedCart"] ?>" data-id="<?= $data["id"] ?>" data-action="cart" class="btn btn-primary <?= $stock ? "" : "disabled" ?> <?= ($sel ? "btn-danger" : "") ?> btn-cart me-0 me-sm-1 mb-1 mb-sm-0 waves-effect waves-float waves-light">

                                <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-shopping-cart me-50">

                                    <circle cx="9" cy="21" r="1"></circle>

                                    <circle cx="20" cy="21" r="1"></circle>

                                    <path d="M1 1h4l2.68 13.39a2 2 0 0 0 2 1.61h9.72a2 2 0 0 0 2-1.61L23 6H6"></path>

                                </svg>

                                <span class="add-to-cart"><?= ($sel ? $_lang["removeCart"] : $_lang["Addcart"]) ?></span>

                            </a>



                            <a href="#" data-msg="<?= $_lang["Addedwishlist"] ?>" data-id="<?= $data["id"] ?>" data-action="wishlist" class="btn btn-outline-secondary btn-wishlist me-0 me-sm-1 mb-1 mb-sm-0 waves-effect">

                                <svg class="<?= (in_array($data["id"], explode(",", $_login->wishlist)) ? "text-danger" : "") ?>" xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-heart me-50">

                                    <path d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z"></path>

                                </svg>

                                <span><?= $_lang["Wishlist"] ?></span>

                            </a>



                        </div>

                    </div>

                </div>

            </form>

        </div>

        <!-- Product Details ends -->



        <!-- Item features starts -->

        <div class="item-features">

            <div class="row text-center">

                <?php

                if ($data["item_features"]) {

                    $data2 = json_decode($data["item_features"], true);

                    foreach ($data2 as $k => $v) {

                ?>

                        <div class="col-12 col-md-4 mb-4 mb-md-0">

                            <div class="w-75 mx-auto">

                                <?= $v["icon"] ?>

                                <h4 class="mt-2 mb-1"><?= $v["title" . $clang] ?></h4>

                                <p class="card-text"><?= $v["description" . $clang] ?></p>

                            </div>

                        </div>

                <? }
                } ?>



            </div>

        </div>

        <!-- Item features ends -->



        <!-- Related Products starts -->
        <? $data = getUser("products", "where active=1 and id!=" . $data["id"] . " and category=" . $data["category"]);
        if ($data) { ?>
            <div class="card-body">

                <div class="mt-4 mb-2 text-center">

                    <h4><?= $_lang["RelatedProducts"] ?></h4>

                    <p class="card-text"><?= $_lang["Peoplealso"] ?></p>

                </div>

                <div class="swiper-responsive-breakpoints swiper-container px-4 py-2">

                    <div class="swiper-wrapper">

                        <?php



                        foreach ($data as $k => $v) {
                            $image = "";

                            if ($v["product_images"]) {

                                $image = json_decode(rawurldecode($v["product_images"]), true)[0]["image"];
                            }
                            $data2 = json_decode(rawurldecode($v["product_specification"]), true);
                            $stock = 0;
                            if ($data2) {
                                array_map(function ($v) use (&$stock) {
                                    array_map(function ($v) use (&$stock) {
                                        $stock += $v["stock"];
                                    }, $v["sizes"]);
                                }, $data2);
                                $v["stock"] = $stock;
                            }
                        ?>

                            <div class="swiper-slide text-center">

                                <a href="<?= getSiteUrl("product-details", $v["id"]) ?>">

                                    <div class="item-heading">

                                        <h5 class="text-truncate mb-0"><?= $v["name" . $clang] ?></h5>

                                        <small class="text-body d-none">by Apple</small>

                                    </div>

                                    <div class="img-container w-50 mx-auto py-75">

                                        <img src="<?= getUpUrl($image) ?>" class="img-fluid" alt="image">

                                    </div>

                                    <div class="item-meta">



                                        <div class="mb-25 text-success" data-bs-toggle="tooltip" data-bs-placement="top" title="<?= $v["stock"] ?> <?= $_lang["pieceinstock"] ?>">

                                            <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-package">

                                                <line x1="16.5" y1="9.4" x2="7.5" y2="4.21"></line>

                                                <path d="M21 16V8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73l7 4a2 2 0 0 0 2 0l7-4A2 2 0 0 0 21 16z"></path>

                                                <polyline points="3.27 6.96 12 12.01 20.73 6.96"></polyline>

                                                <line x1="12" y1="22.08" x2="12" y2="12"></line>

                                            </svg>

                                            <?= $v["stock"] ?>

                                        </div>

                                        <p class="card-text text-primary mb-0"><?= $v["price"] + $v["add_price"] ?> <?= $_lang["currency"] ?></p>

                                    </div>

                                </a>

                            </div>

                        <?php } ?>



                    </div>

                    <!-- Add Arrows -->

                    <div class="swiper-button-next" tabindex="0" role="button" aria-label="Next slide" aria-controls="swiper-wrapper-c3718b36017f54107" aria-disabled="false"></div>

                    <div class="swiper-button-prev swiper-button-disabled" tabindex="-1" role="button" aria-label="Previous slide" aria-controls="swiper-wrapper-c3718b36017f54107" aria-disabled="true"></div>

                    <span class="swiper-notification" aria-live="assertive" aria-atomic="true"></span>

                </div>

            </div>
        <? } ?>
        <!-- Related Products ends -->

    </div>

</section>