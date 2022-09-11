<form action="" id="coupons_table" data-red="this">
    <div class="action-tags">

        <div class="mb-1">
            <label for="todoTitleAdd" class="form-label"><?= $_lang["Coupon"] ?></label>
            <input type="text" data-validmsg="<?= $_lang["valid"] ?>" id="todoTitleAdd" name="code" class="new-todo-item-title form-control" placeholder="<?= $_lang["Coupon"] ?>" />
        </div>
        <div class="mb-1">
            <label for="todoTitleAddemail" class="form-label"><?= $_lang["discount"] ?></label>
            <input type="text" data-validmsg="<?= $_lang["valid"] ?>" id="todoTitleAddemail" name="cost" class="new-todo-item-title form-control" placeholder="<?= $_lang["discount"] ?>" />
        </div>
        <div class="mb-1">
            <label for="todoTitleAddphone" class="form-label"><?= $_lang["Date"] ?></label>
            <input type="text" data-flatpickr="true" data-nodate="" id="todoTitleAddphone" name="date" class="new-todo-item-title form-control" placeholder="<?= $_lang["Date"] ?>" />
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