<form action="" id="orders_table" data-red="this">
    <div class="action-tags">
        <div class="mb-1">
            <label for="todoTitleAdd" class="form-label"><?= $_lang["fullname"] ?></label>
            <input type="text" data-validmsg="<?= $_lang["valid"] ?>" id="todoTitleAdd" name="fullname" class="new-todo-item-title form-control" placeholder="<?= $_lang["fullname"] ?>" />
        </div>
        <div class="mb-1">
            <label for="todoTitleAddemail" class="form-label"><?= $_lang["phone"] ?></label>
            <input type="number" data-validmsg="<?= $_lang["valid"] ?>" id="todoTitleAddemail" name="phone" class="new-todo-item-title form-control" placeholder="<?= $_lang["phone"] ?>" />
        </div>
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
        <div class="mb-2">
            <label class="form-label" cfor="checkout-Area"><?= $_lang["Area"] ?>:</label>
            <select data-search="1" data-select="<?= $_lang["choose"] ?> <?= $_lang["Area"] ?>" data-validmsg="<?= $_lang["valid"] ?>" name="area" class="form-select">
                <option value=""><?= $_lang["choose"] ?> <?= $_lang["Area"] ?></option>
            </select>
        </div>
        <div class="mb-2">
            <label class="form-label" cfor="checkout-address"><?= $_lang["Address"] ?>:</label>
            <input type="text" data-validmsg="<?= $_lang["valid"] ?>" id="checkout-address" class="form-control" name="address" placeholder="<?= $_lang["Address"] ?>" />
        </div>
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
        <div class="mb-1">
            <label class="form-label" cfor="add-note"><?= $_lang["ShippingNote"] ?>:</label>
            <textarea name="note" class="form-control" rows="2" id="add-note" spellcheck="false"></textarea>
        </div>



    </div>
    <div class="my-1">
        <input type="hidden" name="id">
        <button type="submit" class="btn btn-primary me-1"><?= $_lang["Update"] ?></button>
    </div>
</form>