<form action="" id="delivery_areas" data-red="this">
    <div class="action-tags">

        <div class="mb-1">
            <label for="todoTitleAdd" class="form-label"><?= $_lang["title"] ?></label>
            <input type="text" data-validmsg="<?= $_lang["valid"] ?>" id="todoTitleAdd" name="name" class="english new-todo-item-title form-control" placeholder="<?= $_lang["title"] ?>" />
        </div>
        <div class="mb-1">
            <label for="todoTitleAdd" class="form-label"><?= $_lang["title_arabic"] ?></label>
            <input type="text" data-validmsg="<?= $_lang["valid"] ?>" id="todoTitleAdd" name="name_arabic" class="new-todo-item-title form-control" placeholder="<?= $_lang["title_arabic"] ?>" />
        </div>

        <div class="mb-1">
            <label class="form-label" for="basic-default"><?= $_lang["price"] ?></label>
            <div class="input-group">
                <input data-validmsg="<?= $_lang["valid"] ?>" type="text" class="form-control" name="price" id="basic-default2" placeholder="0">
                <span class="input-group-text"><?= $_lang["currency"] ?></span>
            </div>
        </div>
        <div class="mb-1">
            <label for="task-tag2" class="form-label d-block"><?= $_lang["city"] ?></label>
            <select class="form-select task-tag" data-add="<?= $_lang["Addcity"] ?>,add-delivery" data-search="1" data-select id="task-tag2" name="city">
                <? $variable = getUser('delivery_cities');
                foreach ($variable as $k => $v) { ?>
                    <option value="<?= $v["id"] ?>"><?= $v["name" . $clang] ?></option>
                <? } ?>
            </select>
        </div>
        <div class="mb-1">
            <label for="task-tag" class="form-label d-block"><?= $_lang["Status"] ?></label>
            <select class="form-select task-tag" id="task-tag" name="active">
                <option value="1"><?= $_lang["Activated"] ?></option>
                <option value="0"><?= $_lang["inactive"] ?></option>
            </select>
        </div>
    </div>
    <div class="my-1">
        <input type="hidden" name="id">
        <button type="submit" class="btn btn-primary me-1"><?= $_lang["Update"] ?></button>
        <button type="button" data-red="this" data-action="remove" data-table="delivery_areas" class="btn btn-outline-danger">
            <?= $_lang["delete"] ?>
        </button>
    </div>
</form>