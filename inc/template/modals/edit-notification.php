<form action="" id="notifications_table" data-red="this">
    <div class="action-tags">
        <div class="mb-1 position-relative">
            <label for="task-assigned3" class="form-label d-block"><?= $_lang["user"] ?></label>
            <select class="form-select" data-search="1" id="task-assigned3" data-select name="user_id">
                <? $variable = getUser("login", "where active=1");
                $variable = array_merge([["avatar" => "", "fullname" => $_lang["AllUsers"], "id" => "0"]], $variable);
                foreach ($variable as $k => $v) { ?>
                    <option data-avatar="<?= ($v["avatar"] ? $v["avatar"] : "blank-user.png") ?>" value="<?= $v["id"] ?>">
                        <?= $v["fullname"] ?>
                    </option>
                <? } ?>
            </select>
        </div>

        <div class="mb-1">
            <label for="todoTitleAdd" class="form-label"><?= $_lang["title"] ?></label>
            <input type="text" data-validmsg="<?= $_lang["valid"] ?>" id="todoTitleAdd" name="title" class="english new-todo-item-title form-control" placeholder="<?= $_lang["title"] ?>" />
        </div>
        <div class="mb-1">
            <label for="todoTitleAdd" class="form-label"><?= $_lang["title_arabic"] ?></label>
            <input type="text" data-validmsg="<?= $_lang["valid"] ?>" id="todoTitleAdd" name="title_arabic" class="new-todo-item-title form-control" placeholder="<?= $_lang["title_arabic"] ?>" />
        </div>
        <div class="mb-1">
            <label class="form-label" for="exampleFormControlTextarea1"><?= $_lang["description"] ?></label>
            <textarea class="form-control" name="description" id="exampleFormControlTextarea1" rows="3" placeholder="<?= $_lang["description"] ?>" spellcheck="false"></textarea>
        </div>
        <div class="mb-1">
            <label class="form-label" for="exampleFormControlTextarea1"><?= $_lang["description_arabic"] ?></label>
            <textarea class="form-control" name="description_arabic" id="exampleFormControlTextarea1" rows="3" placeholder="<?= $_lang["description_arabic"] ?>" spellcheck="false"></textarea>
        </div>
        <div class="mb-1">
            <label for="todoTitleAdd" class="form-label"><?= $_lang["Icon"] ?></label>
            <input type="text" id="todoTitleAdd" data-icons name="icon" class="new-todo-item-title form-control" placeholder="<?= $_lang["Icon"] ?>" />
        </div>
        <div class="mb-1">
            <label for="task-tag2" class="form-label d-block"><?= $_lang["type"] ?></label>
            <select class="form-select task-tag" data-select id="task-tag2" name="type">
                <? $variable = ["danger", "success", "secondary", "info", "warning"];
                foreach ($variable as $k => $v) { ?>
                    <option value="<?= $v ?>" data-icon="disc" data-class='bg-light-<?= $v ?> me-0'><?= ucfirst($v) ?></option>
                <? } ?>
            </select>
        </div>
        <div class="mb-1">
            <label for="todoTitleAdd" class="form-label"><?= $_lang["link"] ?></label>
            <input type="url" id="todoTitleAdd" name="link" class="new-todo-item-title form-control" placeholder="<?= $_lang["link"] ?>" />
        </div>
        <div class="mb-1">
            <label for="todoTitleAdd" class="form-label"><?= $_lang["Date"] ?></label>
            <input type="text" id="todoTitleAdd" data-flatpickr="1" name="date" class="new-todo-item-title form-control" placeholder="<?= $_lang["Date"] ?>" />
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
        <button type="button" data-red="this" data-action="remove" data-table="notifications" class="btn btn-outline-danger ">
            <?= $_lang["delete"] ?>
        </button>
    </div>
</form>