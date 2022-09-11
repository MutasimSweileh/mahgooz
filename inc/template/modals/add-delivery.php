<form action="" id="delivery_cities" data-red="this">
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
            <label for="task-tag" class="form-label d-block"><?= $_lang["Status"] ?></label>
            <select class="form-select task-tag" id="task-tag" name="active">
                <option value="1"><?= $_lang["Activated"] ?></option>
                <option value="0"><?= $_lang["inactive"] ?></option>
            </select>
        </div>
    </div>
    <div class="my-1">
        <button type="submit" class="btn btn-primary me-1"><?= $_lang["add"] ?></button>
    </div>
</form>