<form action="" id="<?= $table ?>_table" data-red="this">
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
            <label for="todoTitleAdd" class="form-label"><?= $_lang["Icon"] ?></label>
            <input type="text" data-validmsg="<?= $_lang["valid"] ?>" id="todoTitleAdd" name="icon" class="new-todo-item-title form-control" placeholder="<?= $_lang["Icon"] ?>" />
        </div>

        <div class="mb-1">
            <label for="task-tag" class="form-label d-block"><?= $_lang["Status"] ?></label>
            <select class="form-select task-tag" id="task-tag" name="active">
                <option value="1"><?= $_lang["Activated"] ?></option>
                <option value="0"><?= $_lang["inactive"] ?></option>
            </select>
        </div>
    </div>
    <div class="source-item" data-repeater="items" data-empty="" name="items">
        <div data-repeater-list="items">

            <div class="repeater-wrapper mb-50" data-repeater-item="">
                <div class="row2">
                    <div class="d-flex product-details-border position-relative pe-0">
                        <div class="w-100 p-lg-1">

                            <div class="mb-1">
                                <label for="todoTitleAdd" class="form-label"><?= $_lang["title"] ?></label>
                                <input type="text" data-validmsg="<?= $_lang["valid"] ?>" id="todoTitleAdd" name="name" class="english new-todo-item-title form-control" placeholder="<?= $_lang["title"] ?>" />
                            </div>
                            <div class="mb-1">
                                <label for="todoTitleAdd" class="form-label"><?= $_lang["title_arabic"] ?></label>
                                <input type="text" data-validmsg="<?= $_lang["valid"] ?>" id="todoTitleAdd" name="name_arabic" class="new-todo-item-title form-control" placeholder="<?= $_lang["title_arabic"] ?>" />
                            </div>
                            <div class="mb-1">
                                <label for="task-tag" class="form-label d-block"><?= $_lang["Status"] ?></label>
                                <select class="form-select task-tag" data-noselect id="task-tag" name="active">
                                    <option value="1"><?= $_lang["Activated"] ?></option>
                                    <option value="0"><?= $_lang["inactive"] ?></option>
                                </select>
                            </div>
                        </div>
                        <div class="
                        d-flex
                        flex-column
                        align-items-center
                        justify-content-between
                        border-start
                        invoice-product-actions
                        py-50
                        px-25
                      ">
                            <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x cursor-pointer font-medium-3" data-repeater-delete="">
                                <line x1="18" y1="6" x2="6" y2="18"></line>
                                <line x1="6" y1="6" x2="18" y2="18"></line>
                            </svg>

                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="px-0 mt-1">
            <button type="button" class="btn btn-primary btn-sm btn-add-new waves-effect waves-float waves-light" data-repeater-create="">
                <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-plus me-25">
                    <line x1="12" y1="5" x2="12" y2="19"></line>
                    <line x1="5" y1="12" x2="19" y2="12"></line>
                </svg>
                <span class="align-middle"><?= $_lang["Add Item"] ?></span>
            </button>
        </div>

    </div>
    <div class="my-1">
        <button type="submit" class="btn btn-primary me-1"><?= $_lang["add"] ?></button>
    </div>
</form>