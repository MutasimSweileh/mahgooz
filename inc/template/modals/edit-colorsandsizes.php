<?
$jsondata = isv("jsondata");
///print_r($jsondata);
if ($jsondata)
    $jsondata = json_encode($jsondata);
?>
<form action="" id="colorsandsizes">
    <div class="action-tags">

        <div class="mb-1">
            <label for="todoTitleAdd" class="form-label"><?= $_lang["color_title"] ?></label>
            <input type="text" id="todoTitleAdd" data-validmsg="<?= $_lang["valid"] ?>" name="title" class="english new-todo-item-title form-control" />
        </div>
        <div class="mb-1">
            <label for="todoTitleAdd2" class="form-label"><?= $_lang["color_title_arabic"] ?></label>
            <input type="text" id="todoTitleAdd2" data-validmsg="<?= $_lang["valid"] ?>" name="title_arabic" class="new-todo-item-title form-control" />
        </div>

        <div class="mb-1">
            <div class="source-item" data-repeater="sizes" data-undelete="" data-empty2="" name="sizes">
                <div data-repeater-list="sizes">
                    <div class="repeater-wrapper mb-50" data-repeater-item="">
                        <div class="row2">
                            <div class="d-flex product-details-border position-relative pe-0">
                                <div class="w-100 p-lg-1">
                                    <label for="todoTitleAdd3" class="form-label"><?= $_lang["Size"] ?> & <?= $_lang["InStock"] ?></label>
                                    <div class="input-group input-group-merge">

                                        <input type="text" id="todoTitleAdd3" data-validmsg3="<?= $_lang["valid"] ?>" placeholder="<?= $_lang["Size"] ?>" name="size" class="new-todo-item-title form-control" />
                                        <div class="input-group-text p-0">
                                            <input type="text" value="1" placeholder="0" data-TouchSpin min="1" data-validmsg="<?= $_lang["valid"] ?>" id="todoTitleAdd4" name="stock" class="new-todo-item-title form-control" />
                                        </div>
                                    </div>
                                </div>
                                <div class=" d-flex  flex-column align-items-center justify-content-between border-start invoice-product-actions py-50 px-25 ">
                                    <i data-feather="x" data-repeater-delete class="cursor-pointer font-medium-3"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="px-0 mt-1 d-flex justify-content-end">
                    <button type="button" class="btn btn-primary btn-sm btn-add-new waves-effect waves-float waves-light" data-repeater-create="">
                        <i data-feather="plus" class="me-25"></i>
                        <span class="align-middle"><?= $_lang["add"] ?> <?= $_lang["Size"] ?></span>
                    </button>
                </div>

            </div>
        </div>

    </div>
    <div class="my-1">
        <input type="hidden" name="index" value="<?= $index ?>">
        <textarea name="data" class="d-none" cols="30" rows="10"><?= $jsondata ?></textarea>
        <button type="submit" class="btn btn-primary me-1"><?= $_lang["edit"] ?></button>
    </div>
</form>