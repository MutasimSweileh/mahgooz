<form action="" id="<?= $table ?>_table" data-red="this">
    <div class="action-tags">

        <div class="mb-1">
            <label for="todoTitleAdd" class="form-label"><?= $_lang["question"] ?></label>
            <input type="text" data-validmsg="<?= $_lang["valid"] ?>" id="todoTitleAdd" name="question" class="english new-todo-item-title form-control" placeholder="<?= $_lang["question"] ?>" />
        </div>
        <div class="mb-1">
            <label for="todoTitleAdd" class="form-label"><?= $_lang["question_arabic"] ?></label>
            <input type="text" data-validmsg="<?= $_lang["valid"] ?>" id="todoTitleAdd" name="question_arabic" class=" new-todo-item-title form-control" placeholder="<?= $_lang["question_arabic"] ?>" />
        </div>
        <div class="mb-1">
            <label class="form-label"><?= $_lang["answer"] ?></label>
            <div id="task-desc" data-editorel="answer" name="answer" class="english border-bottom-0" data-placeholder="<?= $_lang["answer"] ?>"></div>
            <div data-editorbar="true" class="d-flex justify-content-end desc-toolbar border-top-0">
                <span class="ql-formats me-0">
                    <button class="ql-bold"></button>
                    <button class="ql-italic"></button>
                    <button class="ql-underline"></button>
                    <button class="ql-link"></button>
                </span>
            </div>
        </div>
        <div class="mb-1">
            <label class="form-label"><?= $_lang["answer_arabic"] ?></label>
            <div id="task-desc" data-editorel="answer_arabic" name="answer_arabic" class="border-bottom-0" data-placeholder="<?= $_lang["answer_arabic"] ?>"></div>
            <div data-editorbar="true" class="d-flex justify-content-end desc-toolbar border-top-0">
                <span class="ql-formats me-0">
                    <button class="ql-bold"></button>
                    <button class="ql-italic"></button>
                    <button class="ql-underline"></button>
                    <button class="ql-link"></button>
                </span>
            </div>
        </div>
        <div class="mb-1">
            <label for="task-tag2" class="form-label d-block"><?= $_lang["category"] ?></label>
            <select class="form-select task-tag" data-add="<?= $_lang["addcategory"] ?>,#add-faq-category" data-search="1" data-select id="task-tag2" name="faq_category">
                <? $variable = getUser('faq_category');
                foreach ($variable as $k => $v) { ?>
                    <option value="<?= $v["id"] ?>"><?= $v["title" . $clang] ?></option>
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
        <button type="button" data-red="this" data-action="remove" data-table="<?= $table ?>" class="btn btn-outline-danger ">
            <?= $_lang["delete"] ?>
        </button>
    </div>
</form>