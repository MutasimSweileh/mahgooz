<form action="" id="payments_table" data-red="this">
    <div class="action-tags">
        <div class="mb-1 position-relative">
            <label for="task-assigned3" class="form-label d-block"><?= $_lang["user"] ?></label>
            <select class="form-select" data-search="1" id="task-assigned3" data-select name="user_id">
                <? $variable = getUser("login", "where active=1");
                foreach ($variable as $k => $v) { ?>
                    <option data-avatar="<?= ($v["avatar"] ? $v["avatar"] : "blank.png") ?>" value="<?= $v["id"] ?>">
                        <?= $v["fullname"] ?>
                    </option>
                <? } ?>
            </select>
        </div>

        <div class="mb-1">
            <label for="todoTitleAdd" class="form-label"><?= $_lang["Paymentcode"] ?></label>
            <input type="text" data-validmsg="<?= $_lang["valid"] ?>" id="todoTitleAdd" name="code" class="new-todo-item-title form-control" placeholder="<?= $_lang["Paymentcode"] ?>" />
        </div>
        <div class="mb-1">
            <label class="form-label" for="basic-default"><?= $_lang["Total"] ?></label>
            <div class="input-group">
                <input data-validmsg="<?= $_lang["valid"] ?>" data-validmax="<?= $_lang["validMax"] ?>" data-validmin="<?= $_lang["validMin"] ?>" type="number" class="form-control" name="total" id="basic-default2" placeholder="0">
                <span class="input-group-text"><?= $_lang["currency"] ?></span>
            </div>
        </div>
        <div class="mb-1">
            <label for="task-due-date" class="form-label"><?= $_lang["Date"] ?></label>
            <input type="date" data-flatpickr data-validmsg="<?= $_lang["valid"] ?>" class="form-control task-due-date" id="task-due-date" name="date" />
        </div>

        <div class="mb-1 position-relative">
            <label for="task-assigned2" class="form-label d-block"><?= $_lang["Status"] ?></label>
            <select class="form-select" id="task-assigned2" data-select name="status">
                <? $variable = payStatus();
                foreach ($variable as $k => $v) { ?>
                    <option data-icon="circle" data-color="<?= $v["class"] ?>" value="<?= $k ?>">
                        <?= $v["title"] ?>
                    </option>
                <? } ?>
            </select>
        </div>


    </div>
    <div class="my-1">
        <input type="hidden" name="id">
        <button type="submit" class="btn btn-primary me-1"><?= $_lang["Update"] ?></button>
        <button type="button" data-red="this" data-action="remove" data-table="payments" class="btn btn-outline-danger " >
            <?= $_lang["delete"] ?>
        </button>
    </div>
</form>