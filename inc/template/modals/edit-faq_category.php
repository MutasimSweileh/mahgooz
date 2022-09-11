<form action="" id="<?= $table ?>_table" data-red="this">
    <div class="action-tags">

        <div class="mb-1">
            <label for="todoTitleAdd" class="form-label"><?= $_lang["title"] ?></label>
            <input type="text" data-validmsg="<?= $_lang["valid"] ?>" id="todoTitleAdd" name="title" class="english new-todo-item-title form-control" placeholder="<?= $_lang["title"] ?>" />
        </div>
        <div class="mb-1">
            <label for="todoTitleAdd" class="form-label"><?= $_lang["title_arabic"] ?></label>
            <input type="text" data-validmsg="<?= $_lang["valid"] ?>" id="todoTitleAdd" name="title_arabic" class="new-todo-item-title form-control" placeholder="<?= $_lang["title_arabic"] ?>" />
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
        <button type="button" data-red="this" data-action="remove" data-table="<?= $table ?>" class="btn btn-outline-danger " >
            <?= $_lang["delete"] ?>
        </button>
    </div>
</form>