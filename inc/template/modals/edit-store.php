<form action="" id="stores" data-red="this">
    <div class="action-tags">

        <div class="mb-1">
            <label for="todoTitleAdd" class="form-label"><?= $_lang["title"] ?></label>
            <input type="name" data-validmsg="<?= $_lang["valid"] ?>" id="todoTitleAdd" name="name" class="english new-todo-item-title form-control" placeholder="<?= $_lang["title"] ?>" />
        </div>
        <div class="mb-1">
            <label for="todoTitleAddavatar" class="form-label"><?= $_lang["Logo"] ?></label>
            <input type="file" data-validmsg="<?= $_lang["valid"] ?>" id="todoTitleAddavatar" name="logo" class="new-todo-item-title form-control" placeholder="<?= $_lang["fullname"] ?>" />
        </div>
        <div class="mb-1">
            <label for="todoTitleAdd" class="form-label"><?= $_lang["Link"] ?></label>
            <input type="url" data-validmsg="<?= $_lang["valid"] ?>" id="todoTitleAdd" name="link" class="new-todo-item-title form-control" placeholder="<?= $_lang["Link"] ?>" />
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
        <input type="hidden" name="user_id">
        <button type="submit" class="btn btn-primary me-1"><?= $_lang["Update"] ?></button>
        <button type="button" data-red="this" data-action="remove" data-table="stores" class="btn btn-outline-danger ">
            <?= $_lang["delete"] ?>
        </button>
    </div>
</form>