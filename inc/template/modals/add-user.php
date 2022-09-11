<form action="" id="login_table" data-red="this">
    <div class="action-tags">
        <div class="mb-1">
            <label for="todoTitleAddavatar" class="form-label"><?= $_lang["avatar"] ?></label>
            <input type="file" data-validmsg="<?= $_lang["valid"] ?>" id="todoTitleAddavatar" name="avatar" class="new-todo-item-title form-control" placeholder="<?= $_lang["fullname"] ?>" />
        </div>
        <div class="mb-1">
            <label for="todoTitleAdd" class="form-label"><?= $_lang["fullname"] ?></label>
            <input type="text" data-validmsg="<?= $_lang["valid"] ?>" id="todoTitleAdd" name="fullname" class="new-todo-item-title form-control" placeholder="<?= $_lang["fullname"] ?>" />
        </div>
        <div class="mb-1">
            <label for="todoTitleAddemail" class="form-label"><?= $_lang["email"] ?></label>
            <input type="email" data-validmsg="<?= $_lang["valid"] ?>" id="todoTitleAddemail" name="email" class="new-todo-item-title form-control" placeholder="<?= $_lang["email"] ?>" />
        </div>
        <div class="mb-1">
            <label for="todoTitleAddphone" class="form-label"><?= $_lang["phone"] ?></label>
            <input type="number" data-validmsg="<?= $_lang["valid"] ?>" id="todoTitleAddphone" name="phone" class="new-todo-item-title form-control" placeholder="<?= $_lang["phone"] ?>" />
        </div>
        <div class="mb-1">
            <label class="form-label" for="basic-default"><?= $_lang["AvailableBalance"] ?></label>
            <div class="input-group">
                <input data-validmsg="<?= $_lang["valid"] ?>" data-validmax="<?= $_lang["validMax"] ?>" data-validmin="<?= $_lang["validMin"] ?>" type="number" class="form-control" name="money" id="basic-default2" placeholder="0">
                <span class="input-group-text"><?= $_lang["currency"] ?></span>
            </div>
        </div>
        <div class="mb-1 position-relative">
            <label for="task-assigned" class="form-label d-block"><?= $_lang["Gender"] ?></label>
            <select class="form-select" id="task-assigned" data-select name="gender">
                <option value="Male">
                    <?= $_lang["Male"] ?>
                </option>
                <option value="Female">
                    <?= $_lang["Female"] ?>
                </option>
            </select>
        </div>
        <div class="mb-1 position-relative">
            <label for="task-assigned2" class="form-label d-block"><?= $_lang["role"] ?></label>
            <select class="form-select" id="task-assigned2" data-select name="role">
                <? $variable = roles(false);
                foreach ($variable as $k => $v) { ?>
                    <option data-icon="<?= $v["icon"] ?>" data-color="<?= $v["color"] ?>" value="<?= $k ?>">
                        <?= $v["name"] ?>
                    </option>
                <? } ?>
            </select>
        </div>
        <div class="mb-1">
            <label class="form-label" for="login-password2"><?= $_lang["password"] ?></label>
            <div class="input-group input-group-merge form-password-toggle">
                <input data-validmsg="<?= $_lang["valid"] ?>" value="" type="password" class="form-control form-control-merge" id="login-password2" name="password" tabindex="2" placeholder="············" aria-describedby="login-password">
                <span class="input-group-text cursor-pointer"><svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-eye">
                        <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path>
                        <circle cx="12" cy="12" r="3"></circle>
                    </svg></span>
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
        <input type="hidden" name="date" value="<?= time() ?>">
        <button type="submit" class="btn btn-primary me-1"><?= $_lang["add"] ?></button>
    </div>
</form>