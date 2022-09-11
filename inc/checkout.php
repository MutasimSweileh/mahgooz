<div class="bs-stepper checkout-tab-steps" data-wizard="true">
    <form action="" id="orders">
        <!-- Wizard starts -->
        <div class="bs-stepper-header">
            <div class="step" data-target="#step-address" role="tab" id="step-address-trigger">
                <button type="button" class="step-trigger">
                    <span class="bs-stepper-box">
                        <i data-feather="home" class="font-medium-3"></i>
                    </span>
                    <span class="bs-stepper-label">
                        <span class="bs-stepper-title"><?= $_lang["Address"] ?></span>
                        <span class="bs-stepper-subtitle"><?= $_lang["customerAddress"] ?></span>
                    </span>
                </button>
            </div>
            <div class="line">
                <i data-feather="chevron-right" class="font-medium-2"></i>
            </div>
            <div class="step" data-target="#step-cart" role="tab" id="step-cart-trigger">
                <button type="button" class="step-trigger">
                    <span class="bs-stepper-box">
                        <i data-feather="shopping-cart" class="font-medium-3"></i>
                    </span>
                    <span class="bs-stepper-label">
                        <span class="bs-stepper-title"><?= $_lang["cart"] ?></span>
                        <span class="bs-stepper-subtitle"><?= $_lang["cart"] ?> <?= $_lang["Items"] ?></span>
                    </span>
                </button>
            </div>

        </div>
        <!-- Wizard ends -->

        <div class="bs-stepper-content">

            <!-- Checkout Customer Address Starts -->
            <div id="step-address" class="content" role="tabpanel" aria-labelledby="step-address-trigger">
                <!--  <form id="checkout-address" data-nodata="true" class="list-view product-checkout"> -->
                <div id="checkout-address" class="list-view product-checkout">
                    <!-- Checkout Customer Address Left starts -->
                    <div class="card">
                        <div class="card-header flex-column align-items-start">
                            <h4 class="card-title"><?= $_lang["customerAddress"] ?></h4>
                            <p class="card-text text-muted mt-25"><? printf($_lang["DeliverNote"], $_lang["Delivertoaddress"]) ?></p>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6 col-sm-12">
                                    <div class="mb-2">
                                        <label class="form-label" cfor="checkout-name"><?= $_lang["fullname"] ?>:</label>
                                        <input type="text" data-validmsg="<?= $_lang["valid"] ?>" id="checkout-name" class="form-control" name="fullname" placeholder="<?= $_lang["fullname"] ?>" />
                                    </div>
                                </div>
                                <div class="col-md-6 col-sm-12">
                                    <div class="mb-2">
                                        <label class="form-label" cfor="checkout-number"><?= $_lang["phone"] ?>:</label>
                                        <input data-validmsg="<?= $_lang["valid"] ?>" type="number" id="checkout-number" class="form-control" name="phone" placeholder="<?= $_lang["phone"] ?>" />
                                    </div>
                                </div>

                                <div class="col-md-6 col-sm-12">
                                    <div class="mb-2">
                                        <label class="form-label" for="checkout-city"><?= $_lang["City"] ?>:</label>
                                        <select id="checkout-city" data-action="delivery_areas" data-search="true" data-select="<?= $_lang["choose"] ?> <?= $_lang["City"] ?>" data-validmsg="<?= $_lang["valid"] ?>" name="city" class="form-select">
                                            <option value=""><?= $_lang["choose"] ?> <?= $_lang["City"] ?></option>
                                            <? $variable = getUser("delivery_cities", "where active=1");
                                            foreach ($variable as $key => $v) {
                                            ?>
                                                <option data-price="<?= $v["price"] ?>" value="<?= $v["id"] ?>"><?= $v["name" . $clang] ?></option>
                                            <? } ?>

                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6 col-sm-12">
                                    <div class="mb-2">
                                        <label class="form-label" cfor="checkout-Area"><?= $_lang["Area"] ?>:</label>
                                        <select data-search="1" data-select="<?= $_lang["choose"] ?> <?= $_lang["Area"] ?>" data-validmsg="<?= $_lang["valid"] ?>" name="area" class="form-select">
                                            <option value=""><?= $_lang["choose"] ?> <?= $_lang["Area"] ?></option>

                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6 col-sm-12">
                                    <div class="mb-2">
                                        <label class="form-label" cfor="checkout-address"><?= $_lang["Address"] ?>:</label>
                                        <input type="text" data-validmsg="<?= $_lang["valid"] ?>" id="checkout-address" class="form-control" name="address" placeholder="<?= $_lang["Address"] ?>" />
                                    </div>
                                </div>
                                <div class="col-md-6 col-sm-12">
                                    <div class="mb-2">

                                        <label class="form-label" for="blog-edit-category"><?= $_lang["Store"] ?></label>

                                        <select id="blog-edit-category" data-add="<?= $_lang["Addstore"] ?>,add-store,1" data-search="1" data-select name="store_id" class="select2 form-select">
                                            <option data-avatar="blank.png" value="0"><?= $_lang["none"] ?></option>
                                            <? $variable = getUser('stores', 'where active=1 and user_id=' . $_login->id);

                                            foreach ($variable as $k => $v) { ?>

                                                <option data-avatar="<?= ($v["logo"] ? $v["logo"] : "blank.png") ?>" value="<?= $v["id"] ?>"><?= $v["name"] ?></option>

                                            <? } ?>
                                        </select>

                                    </div>
                                </div>

                                <div class="col-md-12 col-sm-12">
                                    <div class="mb-2">
                                        <label class="form-label" cfor="add-note"><?= $_lang["ShippingNote"] ?>:</label>
                                        <textarea name="note" class="form-control" rows="2" id="add-note" spellcheck="false"></textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Checkout Customer Address Left ends -->
                    <!-- Checkout Customer Address Right starts -->
                    <div class="customer-card">
                        <div class="card">
                            <div class="card-body actions checkout-options">
                                <div class="price-details">
                                    <ul class="list-unstyled">
                                        <li class="price-detail">
                                            <div class="detail-title"><?= $_lang["DeliveryCharges"] ?></div>
                                            <div class="detail-amt discount-amt text-success"><span class="delivery_charges">0</span> <?= $_lang["currency"] ?></div>
                                        </li>
                                    </ul>
                                    <hr />
                                </div>
                                <div class="alert alert-primary mb-0" role="alert">
                                    <div class="alert-body d-flex align-items-center">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-info me-50">
                                            <circle cx="12" cy="12" r="10"></circle>
                                            <line x1="12" y1="16" x2="12" y2="12"></line>
                                            <line x1="12" y1="8" x2="12.01" y2="8"></line>
                                        </svg>
                                        <span> <?= $_lang["Shippingfees"] ?></span>
                                    </div>
                                </div>
                                <button type="button" class="btn btn-primary w-100 btn-next delivery-address mt-1">
                                    <?= $_lang["Delivertoaddress"] ?>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Checkout Customer Address Right ends -->

            </div>
            <!-- Checkout Customer Address Ends -->
            <!-- Checkout Place order starts -->
            <div id="step-cart" class="content" role="tabpanel" aria-labelledby="step-cart-trigger">
                <div id="place-order" class="list-view product-checkout template_checkout">


                    <?php include "inc/template/checkout.php"  ?>


                </div>
                <!-- Checkout Place order Ends -->
            </div>

            <!-- </div> -->
        </div>
    </form>
</div>