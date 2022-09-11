<ul class="nav nav-pills mb-2">
    <li class="nav-item">
        <a class="nav-link " data-bs-toggle="tab" href="#faq_category" role="tab" aria-controls="faq_category" aria-selected="true">

            <i class=" mr-50 font-medium-3" data-feather="help-circle"></i>
            <span class="fw-bold"><?= $_lang["faq_category"] ?></span></a>
    </li>
    <li class="nav-item ">
        <a class="nav-link active" data-bs-toggle="tab" href="#FAQ" role="tab" aria-controls="FAQ" aria-selected="false">
            <i class=" mr-50 font-medium-3" data-feather='check-circle'></i>
            <span class="fw-bold"><?= $_lang["FAQ"] ?></span></a>
    </li>

</ul>
<section id="basic-datatable">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="tab-content pt-1">
                    <div class="tab-pane active" id="FAQ" role="tabpanel">
                        <table class="table" data-datatable="true" data-export="true" data-btn="<?= $_lang["AddFAQ"] ?>,add-faq">
                            <thead>
                                <tr>
                                    <th data-hide>#</th>
                                    <th data-id="method"><?= $_lang["question"] ?></th>
                                    <th data-id="code"><?= $_lang["answer"] ?></th>
                                    <th data-id="code"><?= $_lang["category"] ?></th>
                                    <th data-id="status"><?= $_lang["Status"] ?></th>

                                    <th><?= $_lang["Action"] ?></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?
                                $variable = getUser("faq");
                                foreach ($variable as $k => $v) {
                                    $sel = Selaa("faq_category", "where id=" . $v["faq_category"]);
                                ?>
                                    <tr>
                                        <td> <?= $v["id"] ?> </td>
                                        <td><span class=""><?= $v["question" . $clang] ?></span></td>
                                        <td><span class=""><?= limit_str(strip_tags($v["answer" . $clang]), 10) ?></span></td>
                                        <td><?= $sel["title" . $clang] ?></td>
                                        <td><span class="badge rounded-pill badge-light-<?= ($v["active"] ? "success" : "warning") ?>" text-capitalized=""> <?= ($v["active"] ? $_lang["Activated"] : $_lang["inactive"]) ?> </span></td>
                                        <td>
                                            <div class="text-center">
                                                <a href="javascript:;" data-red="this" data-action="remove" data-table="faq" data-index="<?= $k ?>" data-id="<?= $v["id"] ?>" data-bs-toggle="tooltip" data-bs-placement="top" title="<?= $_lang["delete"] ?>" class="item-edit me-1">
                                                    <i data-feather='trash-2' class="font-medium-2 text-body"></i>
                                                </a>
                                                <a href="javascript:;" data-modal="edit-faq" data-index="<?= $k ?>" data-id="<?= $v["id"] ?>" data-bs-toggle="tooltip" data-bs-placement="top" title="<?= $_lang["edit"] ?>" class="item-edit me-1">
                                                    <i data-feather='edit' class="font-medium-2 text-body"></i>
                                                </a>
                                            </div>
                                        </td>
                                    </tr>
                                <? } ?>
                            </tbody>
                        </table>
                    </div>
                    <div class="tab-pane" id="faq_category" role="tabpanel">
                        <table class="table" data-datatable="true" data-export="true" data-btn="<?= $_lang["addcategory"] ?>,#add-faq-category">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th data-id="method"><?= $_lang["title"] ?></th>
                                    <th data-id="code"><?= $_lang["title_arabic"] ?></th>
                                    <th data-id="status"><?= $_lang["Status"] ?></th>

                                    <th><?= $_lang["Action"] ?></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?
                                $variable = getUser("faq_category");
                                foreach ($variable as $k => $v) {
                                ?>
                                    <tr>
                                        <td> <?= $v["id"] ?> </td>
                                        <td><span class=""><?= $v["title"] ?></span></td>
                                        <td><span class="arabic"><?= strip_tags($v["title_arabic"]) ?></span></td>
                                        <td><span class="badge rounded-pill badge-light-<?= ($v["active"] ? "success" : "warning") ?>" text-capitalized=""> <?= ($v["active"] ? $_lang["Activated"] : $_lang["inactive"]) ?> </span></td>
                                        <td>
                                            <div class="text-center">
                                                <a href="javascript:;" data-red="this" data-action="remove" data-table="faq_category" data-index="<?= $k ?>" data-id="<?= $v["id"] ?>" data-bs-toggle="tooltip" data-bs-placement="top" title="<?= $_lang["delete"] ?>" class="item-edit me-1">
                                                    <i data-feather='trash-2' class="font-medium-2 text-body"></i>
                                                </a>
                                                <a href="javascript:;" data-modal="edit-faq_category" data-index="<?= $k ?>" data-id="<?= $v["id"] ?>" data-bs-toggle="tooltip" data-bs-placement="top" title="<?= $_lang["edit"] ?>" class="item-edit me-1">
                                                    <i data-feather='edit' class="font-medium-2 text-body"></i>
                                                </a>
                                            </div>
                                        </td>
                                    </tr>
                                <? } ?>
                            </tbody>
                        </table>
                    </div>

                </div>
            </div>
        </div>
    </div>

</section>
<div class="modal fade" id="add-faq-category" tabindex="-1" aria-labelledby="addNewCardTitle" aria-hidden="true">
    <div class="modal-dialog  modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-transparent">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body px-sm-5 mx-50 pb-5">
                <h1 class="text-center mb-1" id="addNewCardTitle"><?= $_lang["addcategory"] ?></h1>


                <!-- form -->
                <form id="faq_category" data-red="this" class="row gy-1 pt-75">
                    <div class="col-12">
                        <div class="mb-1">
                            <label for="todoTitleAdd" class="form-label"><?= $_lang["title"] ?></label>
                            <input type="text" data-validmsg="<?= $_lang["valid"] ?>" id="todoTitleAdd" name="title" class="new-todo-item-title form-control" placeholder="<?= $_lang["title"] ?>" />
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="mb-1">
                            <label for="todoTitleAdd" class="form-label"><?= $_lang["title_arabic"] ?></label>
                            <input type="text" data-validmsg="<?= $_lang["valid"] ?>" id="todoTitleAdd" name="title_arabic" class="new-todo-item-title form-control" placeholder="<?= $_lang["title_arabic"] ?>" />
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="mb-1">
                            <label for="task-tag" class="form-label d-block"><?= $_lang["Status"] ?></label>
                            <select class="form-select task-tag" id="task-tag" name="active">
                                <option value="1"><?= $_lang["Activated"] ?></option>
                                <option value="0"><?= $_lang["inactive"] ?></option>
                            </select>
                        </div>
                    </div>
                    <div class="col-12 text-center mt-2 pt-50">
                        <button type="submit" class="btn btn-primary me-1"><?= $_lang["add"] ?></button>
                        <button type="reset" class="btn btn-outline-secondary" data-bs-dismiss="modal" aria-label="Close">
                            <?= $_lang["Cancel"] ?>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>